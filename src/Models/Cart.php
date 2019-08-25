<?php

namespace Backery\Models;

class Cart
{
    private static $cart;
    public $totalPrice;
    public $totalQuantity;
    public $items;
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
    public function addProductToCart(Product $product, $quantity): Cart
    {
        $this->totalPrice = round($this->totalPrice + ($product->getPrice() * (int) $quantity), 2);
        $this->totalQuantity = $this->totalQuantity + (int)  + $quantity;
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
    public static function newCart(): Cart
    {
        if (!self::$cart) {
            self::$cart = new self();
        }

        return self::$cart;
    }

}
