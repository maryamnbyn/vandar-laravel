# Vandar Laravel Packge


[Vandar](https://vandar.io/) is an easy way to manage your payment over the internet. It's safe, fast and to be honest its easy to use specially with Laravel.
This is the **Latest Stable Version** with CircleCI Build License

  

## How To Install 

### Step 1
Make sure that you have composer and just simply use this command line to install vendor-laravel package.

`composer require maryamnbyn/vandar-laravel`

  
### Step 2
Simply add config to **config/services.php** 
```
'vandar' => [

	'api' => 'your api key',

	'test' => false

]
```

 #### You can find your api in Vendor dashboard 

  

## How To Use 

  
### Step 1
Simply add this code to you controller or what ever you want to:

  `use Vandar\Laravel\Facade\Vandar;`


### Step 2
Simply use below code as a **Sample** to send payment request.

  `$result = Vandar::request($amount,$callback, $mobile = null, $factorNumber = null, $description = null);`

### Step 3
Now You can simply check the token to verify payment.

` $result['token']`

### Step 4
Its time to  redirect user to gateway

  `Vandar::redirect();`

**OR**

`Vandar::redirectUrl()`;


### Step 5
After user made payment, vandar redirect user to $callback with a token in url. you can verify payment by pass token to verify method like this

`$token=$_GET['token'];`

and verify it simply like this

`$result = Vandar::verify($token);`

### THATS IT 🎉

you can read more about responses and [API in our documents](https://vandarpay.github.io/docs/).