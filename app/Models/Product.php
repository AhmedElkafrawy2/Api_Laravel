<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'category_id', 'image', 'description', 'unit_id', 'user_id', 'status'
    ];

    public $timestamps = true;

    function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id');
    }

}
