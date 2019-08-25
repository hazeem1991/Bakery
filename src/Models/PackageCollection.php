<?php declare (strict_types = 1);

namespace Backery\Models;

class PackageCollection extends \ArrayObject
{
    public function addPackage(Package $package):bool
    {
        if(!$this->search($package)){
            $this->append($package);
            return true;
        }else{
            return false;
        }
    }
    private function search(Package $package):bool
    {
        return false;
    }
}
