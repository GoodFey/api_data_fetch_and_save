<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    public static function get($apiService, $endpoint, array $params)
    {
        $params['limit'] = 500;

        $response = Http::retry(5, 2000, function ($exception, $request) {
            // Проверяем, является ли ошибка ошибкой 429 (Too Many Requests)
            return $exception instanceof \Illuminate\Http\Client\RequestException && $exception->getCode() === 429;
        })->get("{$apiService}{$endpoint}", $params);


        if ($response->successful()) {
            return $response->json();
        }
    }
}
