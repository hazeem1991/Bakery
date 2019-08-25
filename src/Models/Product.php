<?php declare (strict_types = 1);

namespace Backery\Models;

class Product implements \JsonSerializable 
{
    private $name;
    private $code;
    private $price;
    private $packages;
    const DATA_FILE='src/Data/'."products_data.txt";
    public function __construct(string $name, string $code, float $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->code = $code;
        $this->packages = new PackageCollection();
        $this->packages->addPackage(new Package(1));
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
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        $temp=get_object_vars($this->packages);
        $vars['packages']=[];
        foreach ($temp as $key => $package) {
            $vars['packages'][]=$package->jsonSerialize();
            
        }
        return $vars;
    }
    public function save()
    {
        if(!is_file(self::DATA_FILE)){
            file_put_contents(self::DATA_FILE,'');
        }
        $product_array=json_decode(file_get_contents(self::DATA_FILE),true);
        $product_array[$this->code]=$this->jsonSerialize();
        file_put_contents(self::DATA_FILE,json_encode($product_array));
    }
}
