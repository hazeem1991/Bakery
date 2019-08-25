<?php declare (strict_types = 1);

namespace Backery\Test\Controllers;

use Backery\Controllers\MainController;
use Backery\Models\PackageCollection;
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
}
