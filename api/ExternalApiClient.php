<?php

namespace app\api;

class ExternalApiClient
{
    public static function validateIsbn($isbn)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://brasilapi.com.br/api/isbn/v1/'.$isbn);
        
        return $response->getStatusCode() === 200;
    }
}