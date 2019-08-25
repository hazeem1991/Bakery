<?php

namespace Backery\Models;

class Cart
{
    private static $cart;
    private $totalPrice;
    private $totalQuantity;
    private $items;
    private function __construct()
    {
        $this->items = [];
        // Hide the constructor
    }
    private function __clone()
    {
        // Disable cloning
    }

    private function __wakeup()
    {
        // Disable unserialize
    }
    public function addProductToCart(Product $product, int $quantity): Cart
    {
        $this->totalPrice = round($this->totalPrice + ($product->getPrice() * (int) $quantity), 2);
        $this->totalQuantity = $this->totalQuantity +  $quantity;
        $this->items[$product->getCode()] = [
            'product_info' => [
                'price' => $product->getPrice(),
                'name' => $product->getName(),
                'code' => $product->getCode(),
            ],
            'quantity' => $quantity,
            'product_price' => round(($product->getPrice() * (int) $quantity), 2),
        ];
        return $this;
    }
    public function getTotalPrice():float
    {
        return $this->totalPrice;
    }
    public function getTotalQuantity():int
    {
        return $this->totalQuantity;
    }
    public function getItems():array
    {
        return $this->items;
    }
    public function remove($code):array
    {
        $product_info=$this->items[$code];
        $this->totalQuantity= $this->totalQuantity -$product_info['quantity'] ;
        $this->totalPrice= round($this->totalPrice -$product_info['product_price'],2);
        unset($this->items[$code]);
        return $this->items;
    }
    public static function newCart(): Cart
    {
        if (!self::$cart) {
            self::$cart = new self();
        }

        return self::$cart;
    }

}
