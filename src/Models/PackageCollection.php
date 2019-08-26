<?php declare (strict_types = 1);

namespace Bakery\Models;

class PackageCollection extends \ArrayObject
{
    public function addPackage(Package $package): bool
    {
        if (!$this->search($package)) {
            $this->append($package);
            return true;
        } else {
            return false;
        }
    }
    private function search(Package $newPackage): bool
    {
        foreach ($this as $package) {
            if ($newPackage->getCount() == $package->getCount()) {
                return true;
            }
        }
        return false;
    }
}
