<?php declare (strict_types = 1);

namespace Bakery\Test\Models;

use Bakery\Models\Cart;
use Bakery\Models\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddToCart(): void
    {
        $product = new Product("test", "test", 1);
        $cart = Cart::getCart()->addProductToCart($product, 5);
        $this->assertSame(5, $cart->getTotalQuantity());
        $this->assertSame(round(5 * $product->getPrice(), 2), $cart->getTotalPrice());
        $found = isset($cart->getItems()[$product->getCode()]) && $cart->getItems()[$product->getCode()] != null;
        $cart->remove($product->getCode());
        $this->assertTrue($found);
    }
    public function testCheckOut(): void
    {
        $product = new Product("test", "test", 1);
        $product->addPackage(3);
        $product->save();
        $cart = Cart::getCart()->addProductToCart($product, 5);
        $cart->checkOut();
        $this->assertTrue(in_array("1x3", $cart->getItems()[$product->getCode()]['packages']));
        $this->assertTrue(in_array("2x1", $cart->getItems()[$product->getCode()]['packages']));
        $cart->remove($product->getCode());
        $product->destroy();
    }
}
