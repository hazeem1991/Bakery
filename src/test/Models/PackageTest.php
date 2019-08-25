<?php declare(strict_types=1);

namespace Backery\Test\Models;

use PHPUnit\Framework\TestCase;
use Backery\Models\Package;

class PackageTest extends TestCase
{
    public function testAddPackage():void
    {
        $package = new Package(5);
        $this->assertSame(5,$package->getCount());
    }
}