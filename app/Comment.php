<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function getThreeLatestComment($id_product)
    {
        return DB::table('comments')->select()->where('product_id',$id_product)->orderBy('id','desc')->limit(3)->get();
    }
}
