<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use App\Order;
use Auth;

class OrderController extends Controller
{
    function store(Request $request){
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart')->list;
            $order = new Order();
            if(Auth::check()){
                $order->user_id = Auth::user()->id;
            }else{

                $order->name = $request->name;
                $order->email = $request->email;
                $order->phone = $request->phone;
                $order->address = $request->address;
            };
            $order->save();
            foreach($cart as $key=>$value){
                $orderdetail  = new OrderDetail();
                $orderdetail->product_id = $key;
                $orderdetail->order_id = $order->id;
                $orderdetail->save();
            }
            $request->session()->forget('cart');

            return redirect('complete');
        }else{
            return back()->with('error','No items in cart.');
        };


    }

    function index(){
        return view('backend.order-process')->with('pageTitle','Xử lý đơn hàng.');
    }
}
