<?php declare (strict_types = 1);

namespace Backery\Controllers;

use Backery\Models\Product;

class MainController
{
    private static $mainController;
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
    public function addtoCart(string $product_code, int $product_count): MainController
    {
        return $this;
    }
    public function addProduct(string $name, string $code, string $price): MainController
    {
        $product = new Product($name, $code, (float) $price);
        $product->save();
        return $this;
    }
    public function setPackeges(): MainController
    {
        return $this;
    }
    public function checkOut()
    {

    }
    public static function mainController(): MainController
    {
        if (!self::$mainController) {
            self::$mainController = new self();
        }

        return self::$mainController;
    }
}
