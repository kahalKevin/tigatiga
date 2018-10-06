<?php

namespace App\Helpers;

use GuzzleHttp\Client as HttpRequest;

class RajaOngkir 
{   
    public static function getProvince($query = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/province";

        $res = $client->request('GET', $url, [
            $query
        ]);

        return $res->getBody();
    }

    public static function getCity($query = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/city";

        $res = $client->request('GET', $url, [
            $query
        ]);

        return $res->getBody();
    }

    public static function calculateCost($form_params = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/cost";

        $res = $client->request('POST', $url, [
            $form_params
        ]);

        return $res->getBody();
    }

    public static function getStatusDelivery($form_params = [])
    {
        $client = new HttpRequest;
        $url = getenv("RAJAONGKIR_URL") + "/waybill";

        $res = $client->request('POST', $url, [
            $form_params
        ]);

        return $res->getBody();
    }
}
