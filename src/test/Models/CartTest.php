<?php declare (strict_types = 1);

namespace Bakery\Test\Models;

use Bakery\Models\Cart;
use PHPUnit\Framework\TestCase;
use Bakery\Models\Product;

class CartTest extends TestCase
{
    public function testAddToCart(): void
    {
        $product = new Product("test", "test", 1);
        $cart = Cart::getCart()->addProductToCart($product, 5);
        $this->assertSame(5, $cart->getTotalQuantity());
        $this->assertSame(round(5*$product->getPrice(),2), $cart->getTotalPrice());
        $found = isset($cart->getItems()[$product->getCode()]) && $cart->getItems()[$product->getCode()] != null;
        $cart->remove($product->getCode());
        $this->assertTrue($found);
    }
}
