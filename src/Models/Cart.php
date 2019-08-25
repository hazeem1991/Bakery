<?php

namespace Bakery\Models;

class Cart
{
    private static $cart;
    private $totalPrice;
    private $totalQuantity;
    private $checkOutData;
    private $items;
    private function __construct()
    {
        $this->items = [];
        // Hide the constructor
    }
    private function __clone()
    {
        // Disable cloning
    }

    private function __wakeup()
    {
        // Disable unserialize
    }
    public function addProductToCart(Product $product, int $quantity): Cart
    {
        $this->totalPrice = round($this->totalPrice + ($product->getPrice() * (int) $quantity), 2);
        $this->totalQuantity = $this->totalQuantity + $quantity;
        $this->items[$product->getCode()] = [
            'product_info' => [
                'price' => $product->getPrice(),
                'name' => $product->getName(),
                'code' => $product->getCode(),
            ],
            'quantity' => $quantity+(isset($this->items[$product->getCode()])==true?$this->items[$product->getCode()]['quantity']:0),
            'product_price' => round(($product->getPrice() * (int) $quantity), 2)+(isset($this->items[$product->getCode()])==true?$this->items[$product->getCode()]['product_price']:0),
        ];
        return $this;
    }
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
    public function getTotalQuantity(): int
    {
        return $this->totalQuantity;
    }
    public function getItems(): array
    {
        return $this->items;
    }
    /**
     * This function will implement the algorithm of dividing the quantity of the product to packages
     * this function will call a recursive function, sort the packages by count , divide the  product cart quantity to first,the modulo will be divided to the rest of packages
     * note that if there is no package suitable to the modulo will be placed in the default package that add in the product creation that is 1
     * maybe this is not the best approach , like we can put the rest in the smallest package that fit
     */
    public function checkOut(): Cart
    {
        foreach ($this->items as $key => &$product_info) {
            $packages = Product::getProduct($key)->getPackages();
            $quantity = $product_info['quantity'];
            $this->packaging($packages, $quantity, $product_info);

        }
        return $this;
    }
    private function packaging(PackageCollection $packages, int $quantity, array &$product_info): void
    {
        if (!$packages->count() == 0 && $quantity != 0) {
            $packages_to = [];
            foreach ($packages as $key => $package) {
                $packages_to[$key] = $package->getCount();
            }
            arsort($packages_to);
            reset($packages_to); //Ensure that we're at the first element
            $first_package_count = $packages_to[key($packages_to)];
            $modulo = $quantity % (int) $first_package_count;
            /**
             * note in this block if the package_count equal to zero that mean the package to big for the rest of the quantity so
             * this package will skip and continue
             */
            $package_count = ($quantity - $modulo) / (int) $first_package_count;
            unset($packages{key($packages_to)});
            $quantity = $quantity - ($package_count * $first_package_count);
            if ($package_count != 0) {
                $product_info['packages'][] = $package_count . "x" . $first_package_count;
            }
            $this->packaging($packages, $quantity, $product_info);
        }
    }
    public function remove($code): array
    {
        $product_info = $this->items[$code];
        $this->totalQuantity = $this->totalQuantity - $product_info['quantity'];
        $this->totalPrice = round($this->totalPrice - $product_info['product_price'], 2);
        unset($this->items[$code]);
        return $this->items;
    }
    public static function getCart(): Cart
    {
        if (!self::$cart) {
            self::$cart = new self();
        }

        return self::$cart;
    }
    public function __toString()
    {
        $string = "Total Price : " . $this->totalPrice . "\n";
        $string .= "Total Quantity : " . $this->totalQuantity . "\n";
        $string .= "Items\n";
        foreach ($this->items as $key => $item) {
            $string .= "\t Item Name " . $item['product_info']['name'] . "\n";
            $string .= "\t Item code " . $item['product_info']['code'] . "\n";
            $string .= "\t Unit Price " . $item['product_info']['price'] . "\n";
            $string .= "\t Item Quantity " . $item['quantity'] . "\n";
            $string .= "\t Item TotalPrice " . $item['product_price'] . "\n";
            $string .= "\t Packages\n";
            if (isset($item['packages'])) {
                foreach ($item['packages'] as $key => $package) {
                    $string .= "\t\t" . $package."\n";
                }
            }

        }
        return $string;
    }

}
