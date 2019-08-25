<?php declare(strict_types=1);

namespace Bakery\Test\Models;

use PHPUnit\Framework\TestCase;
use Bakery\Models\Package;

class PackageTest extends TestCase
{
    public function testAddPackage():void
    {
        $package = new Package(5);
        $this->assertSame(5,$package->getCount());
    }
}