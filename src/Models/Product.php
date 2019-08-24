<?php declare(strict_types=1);

namespace Backery\Models\Product;

class Product
{
    private $name;
    private $code;
    private $price;
    public function __construct(string $name,string $code,float $price)
    {
        $this->name=$name;
        $this->price=$price;
        $this->code=$code;
    }
    public function getName():string
    {
        return $this->name;
    }
    public function getCode():string
    {
        return $this->code;
    }
    public function getPrice():string
    {
        return $this->price;
    }
    public function setName(string $name):Product
    {
        $this->name=$name;
        return $this;
    }
    public function setCode(string $code):Product
    {
        $this->code=$code;
        return $this;
    }
    public function setPrice(string $price):Product
    {
        $this->price=$price;
        return $this;
    }
}
