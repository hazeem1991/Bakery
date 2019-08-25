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
    public function addProduct(string $name, string $code, string $price): Product
    {
        $product = new Product($name, $code, (float) $price);
        $product->save();
        return $product;
    }
    public function setPackage(string $product_code,string $count): Product
    {
        $product = Product::getProduct($product_code);
        $product->addPackage((int)$count);
        $product->save();
        return $product;
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
