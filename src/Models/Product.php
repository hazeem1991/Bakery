<?php declare (strict_types = 1);

namespace Backery\Models;

class Product
{
    private $name;
    private $code;
    private $price;
    private $packages;
    public function __construct(string $name, string $code, float $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->code = $code;
        $this->packages = new PackageCollection(new Package(1));
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getPrice(): string
    {
        return $this->price;
    }
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }
    public function setCode(string $code): Product
    {
        $this->code = $code;
        return $this;
    }
    public function setPrice(string $price): Product
    {
        $this->price = $price;
        return $this;
    }
    public function addPackage(int $count): PackageCollection
    {
        $package = new Package($count);
        $this->packages->append($package);
        return $this->packages;
    }
    public function getPackages(): PackageCollection
    {
        return $this->packages;
    }
}
