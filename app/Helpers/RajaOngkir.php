<?php

namespace App\Helpers;

use GuzzleHttp\Client as HttpRequest;

class RajaOngkir 
{   
    public static function getProvince($query = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/province";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('GET', $url, [
            $query,
            'headers' => [
                'key' => $key
            ]
        ]);

        return $res->getBody();
    }

    public static function getCity($query = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/city";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('GET', $url, [
            $query,
            'headers' => [
                'key' => $key
            ]
        ]);

        return $res->getBody();
    }

    public static function calculateCost($form_params = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/cost";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('POST', $url, [
            $form_params,
            'headers' => [
                'key' => $key
            ]
        ]);

        return $res->getBody();
    }

    public static function getStatusDelivery($form_params = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/waybill";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('POST', $url, [
            $form_params,
            'headers' => [
                'key' => $key
            ]
        ]);

        return $res->getBody();
    }
}
