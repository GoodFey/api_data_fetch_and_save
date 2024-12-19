<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\StockRepositories;
use App\Services\StockService;
use App\Traits\DataVerification;

class StockController extends Controller
{
    use DataVerification;

    protected StockService $stockService;
    protected StockRepositories $stockRepository;

    public function __construct(StockService $stockService, StockRepositories $stockRepository)
    {
        $this->stockService = $stockService;
        $this->stockRepository = $stockRepository;
    }

    public function fetchAndStore($account, $page = 1, $countAddedRecord = 0, $dateFrom = null)
    {
        $dateFrom = now()->format('Y-m-d');


        $response = $this->stockService->getStocks($dateFrom, $page);

//        self::getNullableField($response);
//        self::getMinMaxValue($response);

        $this->stockRepository->save($response['data'], $account, $countAddedRecord);

        if ($response['meta']['last_page'] > $page++) {
            $this->fetchAndStore(account: $account, page: $page, countAddedRecord: $countAddedRecord);
        } else {
            dump("Загрузка и сохранение данных для Stocks завершены.\nВсего сохранено записей {$countAddedRecord}");
        }
    }
}
