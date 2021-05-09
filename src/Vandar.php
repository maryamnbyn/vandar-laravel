<?php

namespace Vandar;

use Vandar\Drivers\DriverInterface;
use Vandar\Drivers\RestDriver;
use function Couchbase\defaultDecoder;

class Vandar
{
    private $redirectUrl = "https://ipg.vandar.io/";
    private $api;
    private $driver;
    private $token;

    function __construct($api, DriverInterface $driver = null)
    {
        if (is_null($driver)) {
            $this->driver = new RestDriver();
        }
        $this->driver = $driver;
        $this->api = $api;
    }


    public function request($amount, $callback, $mobile = null, $factorNumber = null, $description = null)
    {
        $inputs = [
            'api_key' => $this->api,
            'amount' => $amount,
            'callback_url' => $callback,
            'mobile_number' => $mobile,
            'factorNumber' => $factorNumber,
            'description' => $description,
        ];
        $result = $this->driver->request("api/v3/send", $inputs);
        if (isset($result['token'])) {
            $this->token = $result['token'];
        }
        return $result;
    }

    public function verify($token)
    {
        return $this->driver->request("api/v3/verify", [
            'api_key' => $this->api,
            'token' => $token,
        ]);
    }

    public function redirect($token = null)
    {
        header('Location: ' . $this->redirectUrl($token));
        die();
    }



    public function redirectUrl($token = null)
    {
        return $this->redirectUrl . 'v3/' . ($this->token ?? $token);
    }



    public function enableTest()
    {
        $this->redirectUrl .= "test/";
        $this->driver->enableTest();
    }


    public function requestInfo($token)
    {
        $inputs = [
             'api_key' => $this->api,
             'token' => $token,
        ];
        $result = $this->driver->request("api/ipg/2step/transaction", $inputs);
        $res =  json_encode($result,true );

        return json_decode($res,true ) ;
    }
}