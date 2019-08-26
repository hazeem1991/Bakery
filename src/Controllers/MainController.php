<?php declare (strict_types = 1);

namespace Bakery\Controllers;

use Bakery\Models\Cart;
use Bakery\Models\Product;

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
    public function addToCart(string $product_code, string $quantity): Cart
    {
        $product = Product::getProduct($product_code);
        $cart = Cart::getCart()->addProductToCart($product, (int) $quantity);
        return $cart;
    }
    public function addProduct(string $name, string $code, string $price): Product
    {
        $product = new Product($name, $code, (float) $price);
        $product->save();
        return $product;
    }
    public function setPackage(string $product_code, string $count): Product
    {
        $product = Product::getProduct($product_code);
        $product->addPackage((int) $count);
        $product->save();
        return $product;
    }
    public function checkOut(): string
    {
        $cart = Cart::getCart()->checkOut();
        return $cart->__toString();
    }
    public static function mainController(): MainController
    {
        if (!self::$mainController) {
            self::$mainController = new self();
        }

        return self::$mainController;
    }
}
