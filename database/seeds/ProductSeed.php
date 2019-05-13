<?php

use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::all()->each(function($category){
            $category->products()->saveMany(factory('App\Product',20)->make());
        });
    }
}
