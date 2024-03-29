<?php declare (strict_types = 1);

namespace Bakery\Test\Controllers;

use Bakery\Controllers\MainController;
use Bakery\Models\PackageCollection;
use PHPUnit\Framework\TestCase;

class MainControllerTest extends TestCase
{
    public function testInstance(): void
    {
        $controller = MainController::mainController();
        $this->assertTrue($controller instanceof MainController);
    }
    public function testAddProduct(): void
    {
        $controller = MainController::mainController();
        $product = $controller->addProduct("test", "test", "1");
        $this->assertSame("test", $product->getName());
        $this->assertSame("test", $product->getCode());
        $this->assertSame((float) 1, $product->getPrice());
        $this->assertTrue($product->getPackages() instanceof PackageCollection);
        $product->destroy();
    }
    public function testAddPackage(): void
    {
        $controller = MainController::mainController();
        $product = $controller->addProduct("test", "test", "1");
        $product = $controller->setPackage("test", "3");
        $found = false;
        foreach ($product->getPackages() as $package) {
            if ($package->getCount() == (int) "3") {
                $found = true;
            }
        }
        $this->assertTrue($found);
        $product->destroy();
    }
    public function testAddToCart(): void
    {
        $controller = MainController::mainController();
        $product = $controller->addProduct("test", "test", "1");
        $cart = $controller->addToCart('test', "5");
        $this->assertSame(5, $cart->getTotalQuantity());
        $this->assertSame(round(5 * $product->getPrice(), 2), $cart->getTotalPrice());
        $found = isset($cart->getItems()[$product->getCode()]) && $cart->getItems()[$product->getCode()] != null;
        $this->assertTrue($found);
        $cart->remove($product->getCode());
        $product->destroy();
    }
    public function testCheckOut(): void
    {
        $controller = MainController::mainController();
        $product = $controller->addProduct("test", "test", "1");
        $product = $controller->setPackage("test", "3");
        $cart = $controller->addToCart('test', "5");
        $checkOutData = $controller->checkOut();
        $this->assertTrue(in_array("1x3", $cart->getItems()[$product->getCode()]['packages']));
        $this->assertTrue(in_array("2x1", $cart->getItems()[$product->getCode()]['packages']));
        $this->assertTrue(is_string($checkOutData));
        $cart->remove($product->getCode());
        $product->destroy();
    }
}
