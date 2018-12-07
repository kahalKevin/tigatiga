<?php

namespace App\Helpers;

use GuzzleHttp\Client as HttpRequest;
use Illuminate\Support\Facades\Cache;

class RajaOngkir
{
    public static function getProvince($query = [])
    {
        if (Cache::has('rajaongkir:province')) {
            return Cache::get('rajaongkir:province');
        }

        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") . "/province";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('GET', $url, [
            'query' => $query,
            'headers' => [
                'key' => $key
            ]
        ]);

        $res = json_decode($res->getBody());

        Cache::put('rajaongkir:province', 
            $res,
            180
        );

        return $res;
    }

    public static function getCity($query = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") . "/city";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('GET', $url, [
            'query' => $query,
            'headers' => [
                'key' => $key
            ]
        ]);

        return json_decode($res->getBody(), true);
    }

    public static function calculateCost($form_params = [])
    {
        // city id origin 153
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") . "/cost";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('POST', $url, [
            'form_params' => $form_params,
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
                'key' => $key
            ]
        ]);

        return json_decode($res->getBody(), true);
    }

    public static function getStatusDelivery($form_params = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") . "/waybill";
        $key = getenv("RAJAONGKIR_API_KEY");

        $res = $client->request('POST', $url, [
            'form_params' => $form_params,
            'headers' => [
                'content-type' => 'application/x-www-form-urlencoded',
                'key' => $key
            ]
        ]);

        return json_decode($res->getBody(), true); 
    }
}
