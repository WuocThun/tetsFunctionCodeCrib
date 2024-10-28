<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//Tải bộ package
use GuzzleHttp\Client;

class VietMapProviders extends ServiceProvider
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getProvinces()
    {
        $response = $this->client->get('https://vapi.vnappmob.com/api/province/');
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getDistricts($provinceId)
    {
        $response = $this->client->get("https://vapi.vnappmob.com/api/province/district/$provinceId");
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWards($districtId)
    {
        $response = $this->client->get("https://vapi.vnappmob.com/province/ward/$districtId");
        return json_decode($response->getBody()->getContents(), true);
    }
}
