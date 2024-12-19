<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\IncomeRepositories;
use App\Repositories\OrderRepositories;
use App\Repositories\SaleRepositories;
use App\Repositories\StockRepositories;
use App\Services\ApiClient;

class ApiController extends Controller
{

    public static function fetchAndStore($account, $apiService, $token, $dateFrom, $api_endpoint, $page = 1, $countAddedRecord = 0)
    {

        $dateTo = now()->format('Y-m-d');

        $params = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'key' => $token,
        ];

        $endpointRepoMap = [
            'api/incomes' => IncomeRepositories::class,
            'api/orders' => OrderRepositories::class,
            'api/sales' => SaleRepositories::class,
            'api/stocks' => StockRepositories::class
        ];

        $response = ApiClient::get($apiService, $api_endpoint, $params);

        app($endpointRepoMap[$api_endpoint])::save($response['data'], $account, $countAddedRecord);

        if ($response['meta']['last_page'] > $page++) {
            self::fetchAndStore($account, $apiService, $token, $dateFrom, $api_endpoint, $page, $countAddedRecord);
        } else {
            dump("Загрузка и сохранение данных для Incomes завершены.\nВсего сохранено записей {$countAddedRecord}");
        }
    }
}
