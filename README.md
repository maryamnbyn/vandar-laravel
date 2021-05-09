vandar-laravel
Latest Stable Version Total Downloads CircleCI Build License

laravel library for vandar gateway

Installation

step 1

run this command :
composer require maryamnbyn/vandar-laravel

step 2

add this to config/services.php

 'vandar' => [
        'api' => 'your api key',
        'test' => false
    ]
you can find your api in vandar dashboard.

Usage

Before you begin, add this code to the top of the class

use Vandar\Laravel\Facade\Vandar;
Then, you most send payment request like this

$result = Vandar::request($amount,$callback, $mobile = null, $factorNumber = null, $description = null);
and save $result['token'] for verify payment.
now you can redirect user to gateway

Vandar::redirect();
//or 
Vandar::redirectUrl();
After user made payment, vandar redirect user to $callback with a token in url. you can verify payment by pass token to verify method like this

$token=$_GET['token'];
$result = Vandar::verify($token);

for get info of transaction you can make requestInfo method and send token for that then you can get information:
$result = Vandar::requestInfo($token);

you can read more about responses and api here.
bug report

if you find a bug add issue