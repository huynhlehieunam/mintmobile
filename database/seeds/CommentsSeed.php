<?php

use Illuminate\Database\Seeder;

class CommentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::all()->each(function ($category) {
            $category->comments()->saveMany(factory('App\Comment', 20)->make());
        });
    }
}
