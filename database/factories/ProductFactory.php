<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "price" => rand(1000000,50000000),
        "condition" => rand(0,1),
        "image" => "iPhone8_plus_RED.jpg",
        "promotion"=> "0% trả góp",
        "accessories" => "Sạc, pin, hướng dẫn, ...",
        "descript" => $faker->randomHtml(2,3),
        "views" => rand(1000,10000)
    ];
});
