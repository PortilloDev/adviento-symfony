<?php

namespace App\Shared\Infrastructure\ThirdPartyServices\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;
class ExternalApiService
{
    public function __construct(private HttpClientInterface $client,)
    {
    }

    public function fetchData(): array
    {
        // Ejemplo de llamada a una API gratuita (por ejemplo, datos meteorológicos)
        $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => 'Madrid,ES',
                'appid' => 'TU_API_KEY',
            ],
        ]);

        return $response->toArray();
    }
}