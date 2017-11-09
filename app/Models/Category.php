<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public $timestamps = true;

    function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }
}
