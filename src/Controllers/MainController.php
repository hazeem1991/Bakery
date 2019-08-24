<?php declare(strict_types=1);

namespace Backery\Controllers;

class MainController
{
    public function addtoCart(string $product_code, int $product_count):MainController
    {
        return $this;
    }
    public function initProducts(string $product_code, int $product_count):MainController
    {
        return $this;
    }
    public function setPackeges():MainController
    {
        return $this;
    }
    public function checkOut()
    {
        
    }
}
