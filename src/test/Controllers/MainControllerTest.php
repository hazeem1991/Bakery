<?php declare(strict_types=1);

namespace Backery\Test\Controllers;

use PHPUnit\Framework\TestCase;
use Backery\Controllers\MainController;
use Backery\Models\PackageCollection;

class MainControllerTest extends TestCase
{
    public function testInstance():void
    {
        $controller=MainController::mainController();
        $this->assertTrue($controller instanceof MainController);
    }
    public function testAddProduct():void
    {
        $controller=MainController::mainController();
        $product = $controller->addProduct("test","test","1");
        $this->assertSame("test",$product->getName());
        $this->assertSame("test",$product->getCode());
        $this->assertSame((float)1,$product->getPrice());
        $this->assertTrue($product->getPackages() instanceof PackageCollection);
        $product->destroy();
    }
}