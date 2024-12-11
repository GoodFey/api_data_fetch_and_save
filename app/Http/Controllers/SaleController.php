<?php

namespace App\Http\Controllers;

use App\Repositories\SaleRepositories;
use App\Services\SaleService;

use App\Traits\DataVerification;
use Illuminate\Http\Request;

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

    public function fetchAndStoreSales($page = 1)
    {
        $dateFrom = '2019-01-01';
        $dateTo = now()->format('Y-m-d');


        $responce = $this->saleService->getSales($dateFrom, $dateTo, $page);

//        self::getNullableField($responce);
//        self::getMinMaxValue($responce);

        $this->saleRepository->save($responce['data']);
        dump("Сохранение прошло успешно для Sale: page - {$page}");

        if ($responce['meta']['last_page'] > $page++) {
            $this->fetchAndStoreSales($page);
        }
    }
}
