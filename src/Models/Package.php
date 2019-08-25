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
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}
