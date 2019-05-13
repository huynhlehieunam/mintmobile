<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public static function getLatestAds($number = 3)
    {
        $ads  = DB::table('ads')->select()->limit($number)->get()->toArray();
        return $ads;
    }
}
