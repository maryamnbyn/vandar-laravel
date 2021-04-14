##vandar-laravel Latest Stable Version Total Downloads CircleCI Build License

laravel library for **vandar gateway**

###step 1, Installation
run the command below:
```shell script
composer require maryamnbyn/vandar-laravel
```

###step 2, add configuration

add this to ``config/services.php``
```php
'vandar' => [
   'api' => 'your api key',
   'test' => false
];
```

**Note**: you can find your api in **vandar dashboard**.

###Usage

Before you begin, add this code to the top of the class

```php
use Vandar\Laravel\Facade\Vandar;
```
Then, you most send payment request like the code below
```php
$result = Vandar::request($amount,$callback, $mobile = null, $factorNumber = null, $description = null);
```

and save ``$result['token']`` for verify payment. now you can redirect user to gateway.

```php
Vandar::redirect();
```
or
```php
Vandar::redirectUrl();
``` 

After user made payment, vandar redirect user to ``$callback`` with a **token** in url. you can verify payment by pass **token** to verify method like this:

```php
$token = $_GET['token'];

$result = Vandar::verify($token);
```

you can read more about responses and _API_  [here](https://vandarpay.github.io/docs/). <br>

bug report, `if you find a bug add issue`