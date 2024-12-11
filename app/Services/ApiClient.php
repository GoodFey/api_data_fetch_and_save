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

        $response = Http::get("{$this->baseUrl}{$endpoint}", $params);

        return $response->json();
    }
}
