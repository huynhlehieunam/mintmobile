<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Session;
use DB;

class PageController extends Controller
{
    public function getDashboard()
    {
        $pageTitle = 'Dashboard';
        return view('backend.index')->with(compact('pageTitle'));
    }
    public function getHomepage()
    {
        $latestProducts = \App\Product::topLatestProducts();
        //dd($latestProduct);
        $mostViewsProducts = \App\Product::topMostViewsProducts();
        return view('frontend.home')->with(compact('latestProducts','mostViewsProducts'));
    }
    public function getDetails($id)
    {
        $product = \App\Product::findOrFail($id);
        $comments = \App\Comment::getThreeLatestComment($id);
        //dd($comments);
        return view('frontend.details')->with(compact('product','comments'));
    }
    public function getCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::select('*')->where('category_id',$id)->paginate(12);
        //dd($category);
        return view('frontend.category')->with(compact('category','products'));
    }
    public function getCart(){
        //dd(Session::get('cart'));

        return view('frontend.cart');
    }
    public function complete()
    {
        //dd(Session::get('cart'));

        return view('frontend.complete');
    }
}
