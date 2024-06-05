<?php

namespace App\Services;

use App\Services\Interfaces\CurrencyServiceInterface;
use GuzzleHttp\Client;

class CurrencyService implements CurrencyServiceInterface
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.exchangerate-api.com/v4/latest/',
        ]);
    }

    public function getExchangeRates(): array
    {
        $response = $this->client->get('UAH');
        $data = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() === 200) {
            return $data;
        }

        return [];
    }
}
