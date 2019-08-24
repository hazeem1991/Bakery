<?php declare (strict_types = 1);

namespace Backery\Models;

class PackageCollection extends \ArrayObject
{
    protected function append(Package $package):bool
    {
        if(!$this->search()){
            parent::append($package);
            return true;
        }else{
            return false;
        }
    }
    private function search(Package $package):bool
    {
        return true;
    }
}
