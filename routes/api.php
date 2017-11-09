<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace'=>'Apis', 'middleware'=>'api'], function(){
    Route::group(['prefix' => 'products'], function () {
    	Route::get('get_categories', 'ProductsApisController@get_categories');
    	Route::get('get_units', 'ProductsApisController@get_units');
    	Route::post('add_product', 'ProductsApisController@add_product');
    	Route::post('single_product', 'ProductsApisController@single_product');
    	Route::post('comment', 'ProductsApisController@comment');
    	

    });

     Route::group(['prefix' => 'users'], function () {
    	Route::post('register', 'UsersApisController@register');
    	Route::post('login', 'UsersApisController@login');
    });
   
});	

Route::get('products/add_product',function(){

    return "this function is used to handle api you can only send post request to it";

});

Route::get('products/single_product',function(){

    return "this function is used to handle api you can only send post request to it";

});


Route::get('products/comment',function(){

    return "this function is used to handle api you can only send post request to it";

});


Route::get('users/login',function(){

    return "this function is used to handle api you can only send post request to it";

});

Route::get('users/register',function(){

    return "this function is used to handle api you can only send post request to it";

});

Route::get('bcrypt', function(){
	return bcrypt('123456');
});

