<?php

use App\Http\Controllers\API\ApiController;
use App\Models\Account;
use App\Models\ApiService;
use App\Models\ApiToken;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

// Группа команд для получения данных по расписанию - дважды в день

Artisan::command('incomes:fetch-today', function () {
    $dateFrom = now()->format('Y-m-d');
    $account = Account::find(1)->id;
    $apiService = ApiService::find(1);
    $token = ApiToken::find(1)->token_value;
    $apiService = ApiService::find(1)->value;
    $api_endpoint = 'api/incomes';

    ApiController::fetchAndStore(account: $account, apiService: $apiService, token: $token, dateFrom: $dateFrom,
        api_endpoint: $api_endpoint);

    Log::info("Данные для Incomes за {$dateFrom} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);


Artisan::command('orders:fetch-today', function () {
    $dateFrom = now()->format('Y-m-d');
    $account = Account::find(1)->id;
    $apiService = ApiService::find(1);
    $token = ApiToken::find(1)->token_value;
    $apiService = ApiService::find(1)->value;
    $api_endpoint = 'api/orders';

    ApiController::fetchAndStore(account: $account, apiService: $apiService, token: $token, dateFrom: $dateFrom,
        api_endpoint: $api_endpoint);

    Log::info("Данные для orders за {$dateFrom} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);


Artisan::command('sales:fetch-today', function () {
    $dateFrom = now()->format('Y-m-d');
    $account = Account::find(1)->id;
    $apiService = ApiService::find(1);
    $token = ApiToken::find(1)->token_value;
    $apiService = ApiService::find(1)->value;
    $api_endpoint = 'api/sales';

    ApiController::fetchAndStore(account: $account, apiService: $apiService, token: $token, dateFrom: $dateFrom,
        api_endpoint: $api_endpoint);

    Log::info("Данные для sales за {$dateFrom} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);

Artisan::command('stocks:fetch-today', function () {
    $dateFrom = now()->format('Y-m-d');
    $account = Account::find(1)->id;
    $apiService = ApiService::find(1);
    $token = ApiToken::find(1)->token_value;
    $apiService = ApiService::find(1)->value;
    $api_endpoint = 'api/stocks';

    ApiController::fetchAndStore(account: $account, apiService: $apiService, token: $token, dateFrom: $dateFrom,
        api_endpoint: $api_endpoint);

    Log::info("Данные для stocks за {$dateFrom} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);
