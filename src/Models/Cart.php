<?php

namespace Backery\Models\Cart;

class Cart extends \ArrayOject
{
    private static $cart;
    private function __construct()
    {
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

    public static function newCart(): Cart
    {
        if (!self::$cart) {
            self::$cart = new self();
        }

        return self::$cart;
    }
    
}
