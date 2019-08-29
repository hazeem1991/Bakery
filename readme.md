# Bakery 

### Getting Started
This Code is solving the problem of Packaging
When you need to ship your Products in a different packages depends on the count
it is written in php7 and it is using PhpUnit

### Installing
for installation just use composer install 
## How to use ?
For adding products  
```php index.php < products.txt```  
For adding packages to products  
```php index.php < packages.txt```  
For adding item to cart and calculate the Packages  
```php index.php < cart.txt```  
For Windows Use the Get-Content Command  
```Get-Content cart.txt | php index.php```  
To run the test  
``` ./vendor/bin/phpunit --testdox```  
after running the test report will generate in ./test/_reports  

## How it work ?
adding the product will save it in a json file ./src/Data/products_data.json
the index file is like a router that send data to MainController
after adding items to the cart the MainController has a function `checkOut()` call the Cart `checkOut()` int the cart a function called     `packaging`
* a recursive function, sort the packages by count , divide the  product cart quantity to first,the modulo will be divided to the rest of packages
* note that if there is no package suitable to the modulo will be placed in the default package that add in the product creation that is 1
* maybe this is not the best approach , like we can put the rest in the smallest package that fit