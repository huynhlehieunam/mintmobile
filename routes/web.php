<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['isLoggedIn:admin']], function () {
        Route::group(['prefix' => 'login'], function () {
            Route::get('', function () {
            return App::make( 'App\Http\Controllers\Auth\LoginController')->getLogin(true);
            });
            Route::post('', function (Request $request) {
                return App::make('App\Http\Controllers\Auth\LoginController')->postLogin($request,'admin');
            });
        });
        Route::get('logout', function () {
            return App::make('App\Http\Controllers\Auth\LoginController')->logout('admin');
        });

    });
    Route::group(['middleware' => 'isLoggedOut:admin'], function () {
        Route::get('', 'PageController@getDashboard');
        Route::resource('categories', 'CategoryController')->only('index');
        Route::resource('products', 'ProductController');
        Route::resource('orders','OrderController');
    });

    Route::group(['middleware' => ['onlyAjax']], function () {
        //category
        Route::post('categories','CategoryController@store');
        Route::put('categories/{id}', 'CategoryController@update');
        Route::delete('categories/{id}', 'CategoryController@destroy');
        Route::get('categories/{id}', 'CategoryController@show');
    });
});

Route::group(['prefix' => ''], function () {
    Route::group(['middleware' => ['isLoggedIn:web']], function () {
        Route::group(['prefix' => 'login'], function () {
            Route::get('', function () {
                return App::make('App\Http\Controllers\Auth\LoginController')->getLogin(false);
            });
            Route::post('', function (Request $request) {
                return App::make('App\Http\Controllers\Auth\LoginController')->postLogin($request, 'web');
            });
        });
        Route::get('logout', function () {
            return App::make('App\Http\Controllers\Auth\LoginController')->logout('web');
        });
        Route::group(['middleware' => 'onlyAjax'], function () {
            Route::post('comments/create', 'CommentController@storeAComment');
        });
    });
    Route::get('','PageController@getHomepage');
    Route::get('products/{id}','PageController@getDetails');
    Route::get('categories/{id}', 'PageController@getCategory');
    Route::get('cart/add/{id}', function(Request $request,$id){
        App::make('App\Http\Controllers\CartController')->add($request,$id);
    });
    Route::post('order/','OrderController@store');
    Route::get('cart/', 'PageController@getCart');
    Route::get('complete/', 'PageController@complete');



});

