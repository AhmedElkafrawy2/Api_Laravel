<?php

namespace App\Http\Controllers\Apis;
use App\Models\Category;
use App\User, App\Models\Product, App\Models\Comment;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;


class ProductsApisController extends Controller
{
	function get_categories()
	{
		$categories = Category::select("id", "name", "icon")->get()->toArray();

		return response()->json(['status'=>config('constants.generals.success'), 
			'categories'=>$categories]);

	}

	function get_units()
	{
        $units = config('constants.units');
        $units_response = [];
        foreach ($units as $name=>$id) {
        	$units_response[] = ['id'=>$id, 'name'=>$name];
        }
		return response()->json(['status'=>config('constants.generals.success'), 
			'units'=>$units_response]);

	}

	function add_product(Request $request)
	{
		$content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        if(isset($data['name'], $data['description'], $data['price'],
            $data['unit'], $data['image'],  $data['token'], $data['category']))
        {
        	$units = config('constants.units');
        	if(!is_numeric($data['price']) || !in_array($data['unit'], array_values($units)))
        		return response()->json(['status'=>config('constants.generals.invalid_type')]);

        	$user = User::whereToken($data['token'])->first();
        	if(!$user)
        		return response()->json(['status'=>config('constants.generals.not_found')]);


            $path = GeneralHelpers::save_image($data['image'], "products");

        	$product = Product::create(['name'=>$data['name'],
        		'description'=>$data['description'], 'price'=>$data['price'],
        		'unit_id'=>$data['unit'], 'user_id'=>$user->id, 'category_id'=>$data['category'],
        		'image'=>$path]);

        	if($product)
        		return response()->json(['status'=>config('constants.generals.success')]);

        }
        else
        {
    		return response()->json(['status'=>config('constants.generals.fill_all_fields')]);
        }
	}

	function single_product(Request $request)
	{
		$content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        if(isset($data['id']))
        {
        	$product = Product::find($data['id']);
        	if(!$product)
	    		return response()->json(['status'=>config('constants.generals.not_found')]);

	    	$product_response = 
    		[
    			'user_phone'=>isset($product->user)? $product->user->phone:"",
    			'user_email'=>isset($product->user)? $product->user->email:"",
    			'user_name'=>isset($product->user)? $product->user->name:"",
    		];

	    	$comments = $product->comments;
	    	$comments_response = [];
	    	foreach ($comments as $comment) {
	    		$comments_response[] = [
	    			'comment_id'=>$comment->id,
	    			'content'=>$comment->content,
	    			'created_at'=>strtotime($comment->created_at),
	    			'user_id'=>$comment->user_id,
	    			'user_name'=>isset($comment->user)? $comment->user->name: "",
	    			'user_image'=>isset($comment->user)? $comment->user->image: "",
	    		];
	    	}

	    	
	    	return response()->json([
	    		'status'=>config('constants.generals.success'),
	    		'product'=>$product_response, 'comments'=>$comments_response]);
        }
        else
        {
    		return response()->json(['status'=>config('constants.generals.fill_all_fields')]);
        }
	}

	function comment(Request $request)
	{
		$content = $request->getContent();
        $data = json_decode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        if(isset($data['token'], $data['product_id'], $data['content']))
        {	
        	$user = User::whereToken($data['token'])->first();
        	$product = Product::find($data['product_id']);
        	if(!$user || !$product)
	    		return response()->json(['status'=>config('constants.generals.not_found')]);

        	$comment = Comment::create([
        		'user_id'=>$user->id, 
        		'product_id'=>$data['product_id'],
        		'content'=>$data['content']]
    		);

    		if($comment)
    			return response()->json(['status'=>config('constants.generals.success')]);

        }
        else
        {
    		return response()->json(['status'=>config('constants.generals.fill_all_fields')]);
        }
	}


}