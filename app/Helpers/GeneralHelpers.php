<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\User;
class GeneralHelpers
{
    static function create_usercodes($userid, $length=3, $vcode = false)
    {
        $letters = "12345678";
        $time = time();
        $uniqid = substr($time, -4);
        $code = "";
        for ($i = 0; $i <$length; $i++)
        {
            $iletter = rand(0,  strlen($letters)-1);
            $code .= substr($letters, $iletter, 1);
        }
        if($vcode == false)
            return $userid . $code;
        else
            return $uniqid.$code;
    }


    static function send_email($data, $view)
    {
        $is_sent = Mail::send($view, $data, function ($m) use($data){
            $m->from(config('constants.generals.company_email'), 'Mallaky');
            $m->to($data['email'], config('constants.generals.company_email'))
                ->subject($data['subject']);
        });
        return $is_sent;
    }

    static function validate_user_data($type, $column, $data, $token = NULL)  //type >> register or edit
    {
        $rules = [];
        if($type == 'register') {
            if ($column == 'email') {
                $rules = array('email' => 'unique:users,email');
            }elseif ($column == 'phone') {
                $rules = array('phone' => 'unique:users,phone');
            }elseif ($column == 'firebasetoken') {
                $rules = array('firebasetoken' => 'unique:users,firebasetoken');
            }
        }
        else if($type == 'edit_profile')
        {
            $user = User::whereToken($token)->first();
            $userid = $user->id;

            if($column == 'email') {
                $rules = array('email' => 'unique:users,email,' . $userid);
            }elseif($column == 'phone') {
                $rules = array('phone' => 'unique:users,phone,' . $userid);
            } elseif ($column == 'firebasetoken') {
                $rules = array('firebasetoken' => 'unique:users,firebasetoken,'. $userid);
            }
        }

        $validator = Validator::make([$column=>$data], $rules);
        if ($validator->fails())
        {
            if($column == 'email')
                $user = User::whereEmail($data)->first(); //registered with facebook
            else if($column == 'phone')
                $user = User::wherePhone($data)->first();
            else if($column == 'firebasetoken')
                $user = User::whereFirebasetoken($data)->first(); //registered with
            if($user)
            {
                return config('constants.generals.duplicated'); //email already exist for another user
            }
            else
            {
                return config('constants.generals.success');
            }
        }
        else
        {
            return config('constants.generals.success');
        }
    }


    static function save_image($image, $folder, $type='api')
    {
        $code = uniqid();
        $path = "assets/images/$folder/";

        if($type == 'api')
        {
            $my_img = str_replace('data:image/png;base64,','', $image);
            $my_img = str_replace('data:image/jpeg;base64,','', $image);
            file_put_contents($path.$code.".png", base64_decode($my_img));
        }
        else
        {
            $image->move($path, substr(time(), -4).$code.'.png');
        }
        $image_path = asset("assets/images/$folder/" .$code.".png");
        return $image_path;
    }
}