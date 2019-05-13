<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.master', function ($view) {
            $categories = \App\Category::all('id', 'name');
            $ads = \App\Ad::getLatestAds();
            //dd( $ads);
            return $view->with(compact('categories','ads'));
        });
    }
}
