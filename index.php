<?php declare (strict_types = 1);
header('Content-Type: text/html; charset=utf-8');
require_once "./vendor/autoload.php";
use Backery\Controllers\MainController;
function trim_line(string $string): string
{
    $string = rtrim(trim($string));
    return $string;
}
if (STDIN) {
    // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //     $first_line = substr(trim_line(fgets(STDIN)), 3);
    // } else {
    //     $first_line = trim_line(fgets(STDIN));
    // }
    $first_line = trim_line(fgets(STDIN));
    switch ($first_line) {
        case 'products':
            echo "creating products";
            while (($input = fgets(STDIN)) !== false) {
                $input = explode(" ", trim_line($input));
                MainController::mainController()->addProduct($input[0], $input[1], $input[2]);
            }
            echo "products added";
            break;
        case 'packages':
            echo "addd packages";
            while (($input = fgets(STDIN)) !== false) {
                $input = explode(" ", trim_line($input));
                MainController::mainController()->setPackage($input[0], $input[1]);
            }
            echo "packages added";
            break;
        default:
            throw new Exception("Error Processing File", 1);
            break;
    }

}
