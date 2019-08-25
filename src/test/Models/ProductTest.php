<?php declare(strict_types=1);

namespace Backery\Test\Models;

use PHPUnit\Framework\TestCase;
use Backery\Models\Product;
use Backery\Models\PackageCollection;

class ProductTest extends TestCase
{
    public function testAddProduct():void
    {
        $product = new Product("test","test",1);
        $this->assertSame("test",$product->getName());
        $this->assertSame("test",$product->getCode());
        $this->assertSame((float)1,$product->getPrice());
        $this->assertTrue($product->getPackages() instanceof PackageCollection);
    }
    public function testSaveProduct():void
    {
        $product = new Product("test","test",1);
        $this->assertTrue($product ->save());
        $this->assertTrue($product ->destroy());
    }
    public function testAddPackages()
    {
        $product = new Product("test","test",1);
        $product->addPackage(5);
        $this->assertTrue($product->getPackages() instanceof PackageCollection);
    }
}