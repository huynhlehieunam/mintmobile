<?php
namespace App\Cart;

use \App\Product;

class CartItem
{
    public $id;
    public $product; //array [id,name,price,image]
    public $quantity; //int
    public function __construct($product, $quantity)
    {
        $product = $product[0];
        $this->id = $product['id'];
        $this->product = $product;
        $this->quantity = $quantity;
    }
}
