<?php

namespace App\Http\Controllers\Apis;
use Illuminate\Http\Request;

use App\Helpers\GeneralHelpers;
use App\Models\City, App\User;
class UsersApisController extends Controller
{
    //OK
    function register(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if(isset($data['name'], $data['phone'], $data['password'], $data["image"], $data['city']))
        {
            $name = $data['name'];
            $phone = $data['phone'];
            $password = $data['password'];
            $image = $data["image"];
            $city = $data['city'];
            $city = City::find($city);
            if(!$city)
                return response()->json(['status'=>config('constants.generals.not_found')]);

            $token = GeneralHelpers::create_usercodes("", 10, true);

            $is_valid_phone = GeneralHelpers::validate_user_data('register', 'phone', $phone,
                1 , $token);
  
            if($is_valid_phone != config('constants.generals.success'))
                return response()->json(['status'=>$is_valid_phone]);

            $path = null;
            if(isset($data['image']))
            {
                $image = $data['image'];
                $path = GeneralHelpers::save_image($image, "users");
            }
            $user = User::create(['name'=>$name, 'password'=>$password, 
                'phone'=>$phone, 'image'=>$path,
                'token'=>$token, 'city_id'=>$data['city']]);

            if($user) {
                return $this->return_user_data($user);
            }
        }
        else
        {
            return response()->json(['status'=>config('constants.generals.fill_all_fields')]);
        }
    }

    //OK
    function login(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $phone = isset($data['phone'])? $data['phone']: null;
        $password = isset($data['password'])? ($data['password']): null;      

        if ((is_null($password)  && is_null($phone))) 
        {
            return response()->json(['status' => config('constants.generals.fill_all_fields')]);
        } 
        elseif ($phone) 
        {
            $user = User::where(['phone' => $phone, 'password' => $password])->first();
        }

        return $this->return_user_data($user);
        
    }


    function return_user_data($user)
    {
        $response = !isset($user)? response()->json(['status'=>config('constants.generals.not_found')]):
            response()->json(['status'=>config('constants.generals.success'),
				'user'=>[
					'user_id'=>$user->id,
					'name'=>is_null($user->name)?'':$user->name,
					'token'=>is_null($user->token)? '':$user->token,
					'image'=>is_null($user->image)?'':$user->image,
					'phone'=>is_null($user->phone)? '': $user->phone,
				    'city'=>is_null($user->city)? '':$user->city->name,                  
                ]
            ]);
        return $response;
    } 
}