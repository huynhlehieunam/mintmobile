<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Cart\Cart;
use \App\Cart\CartItem;
use \App\Product;
use Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request,$id,$quantity=1)
    {
        if($request->session()->has('cart')){
            $cart = new Cart( $request->session()->get('cart'));
        }else{
            $cart = new Cart();
        };
        $product = Product::select('id','name','price','image')->where('id','=',$id)->get()->toArray();
        //dd($product);
        $item = new CartItem($product,1);

        $cart->add($item);

        //dd($cart);

        $request->session()->put('cart',$cart);

        return back()->with('msg','Data saved!');
    }

}
