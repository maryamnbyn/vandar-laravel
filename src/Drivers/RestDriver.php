<?php

namespace Vandar\Drivers;

class RestDriver implements DriverInterface
{
    protected $baseUrl = "https://ipg.vandar.io/";

    public function request($uri, $inputs)
    {
        $result = $this->restCall($uri, $inputs);
        return json_decode($result, true);
    }

    private function restCall($uri, $data)
    {
        if ($uri == 'api/ipg/2step/transaction') {
            $url = 'https://vandar.io/api/ipg/2step/transaction' ;
        }else{
            $url = $this->baseUrl . $uri;

        }
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
             json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
             'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    public function setAddress($url)
    {
        $this->baseUrl = $url;
    }

    public function enableTest()
    {
        $this->baseUrl = "https://vandar.io/ipg/test/";
    }
}