<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\SaleRepositories;
use App\Services\SaleService;
use App\Traits\DataVerification;

class SaleController extends Controller
{
    use DataVerification;

    protected SaleService $saleService;
    protected SaleRepositories $saleRepository;

    public function __construct(SaleService $saleService, SaleRepositories $saleRepository)
    {
        $this->saleService = $saleService;
        $this->saleRepository = $saleRepository;
    }

    public function fetchAndStore($account, $page = 1, $dateFrom = '2024-12-01', $countAddedRecord = 0)
    {
        $dateTo = now()->format('Y-m-d');

        $response = $this->saleService->getSales($dateFrom, $dateTo, $page);

//        self::getNullableField($response);
//        self::getMinMaxValue($response);

        $this->saleRepository->save($response['data'], $account, $countAddedRecord);

        if ($response['meta']['last_page'] > $page++) {
            $this->fetchAndStore(account:$account, page: $page, countAddedRecord: $countAddedRecord);
        } else {
            dump("Загрузка и сохранение данных для Sales завершены.\nВсего сохранено записей {$countAddedRecord}");
        }
    }
}
