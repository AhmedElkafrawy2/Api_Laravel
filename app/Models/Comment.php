<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'content'
    ];
    public $timestamps = true;

    function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
