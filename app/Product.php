<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public static function topLatestProducts($sl = 8){
        return self::select('id','name','price','image')->orderBy('id','desc')->limit($sl)->get();
    }
    public static function topMostViewsProducts($sl = 8)
    {
        return self::select('id', 'name', 'price', 'image')->orderBy('views', 'desc')->limit($sl)->get();
    }

}
