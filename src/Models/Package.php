<?php declare(strict_types=1);

namespace Backery\Models;

class Package
{
    private $count;
    public function __construct(int $count)
    {
        $this->count=$count;
    }
    public function getCount():int
    {
        return $this->count;
    }
    public function setCount(int $count):Package
    {
        $this->count=$count;
        return $this;
    }
}
