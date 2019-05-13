<?php
namespace App\Cart;
use App\Cart\CartItem;

class Cart{
    public $list;
    // [CartItem = {Product [id,name,price,image],Int Quantity}]
    public function __construct($cart = null)
    {
      if($cart){
          $this->list = $cart->list;
      }else{
          $this->list = [];
      }
    }
    public function add(CartItem $item)
    {
        if(array_key_exists($item->id,$this->list)){
            $this->list[$item->id]->quantity += $item->quantity;
        }else{
            $this->list[$item->id] = $item;
        }
    }
}
