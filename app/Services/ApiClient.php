<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {

        $this->baseUrl = config('services.api.base_url');
        $this->apiKey = config('services.api.key');
    }

    public function get(string $endpoint, array $params = [])
    {
        $params['key'] = $this->apiKey;
        $params['limit'] = 500;

        $response = Http::retry(5, 2000, function ($exception, $request) {
            // Проверяем, является ли ошибка ошибкой 429 (Too Many Requests)
            return $exception instanceof \Illuminate\Http\Client\RequestException && $exception->getCode() === 429;
        })->get("{$this->baseUrl}{$endpoint}", $params);


        if ($response->successful()) {

            return $response->json();
        }
    }
}
