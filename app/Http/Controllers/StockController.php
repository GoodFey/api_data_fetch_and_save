<?php

namespace App\Http\Controllers;

use App\Repositories\StockRepositories;
use App\Services\StockService;
use App\Traits\DataVerification;
use Illuminate\Http\Request;

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

    public function fetchAndStoreStocks($page = 1)
    {
        $dateFrom = now()->format('Y-m-d');


        $responce = $this->stockService->getStocks($dateFrom, $page);

//        self::getNullableField($responce);
////        self::getMinMaxValue($responce);

        $this->stockRepository->save($responce['data']);
        dump("Сохранение прошло успешно для Stock: page - {$page}");

        if ($responce['meta']['last_page'] > $page++) {
            $this->fetchAndStoreStocks($page);
        }
    }
}
