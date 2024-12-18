<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepositories;
use App\Services\OrderService;
use App\Traits\DataVerification;

class OrderController extends Controller
{
    use DataVerification;

    protected OrderService $orderService;
    protected OrderRepositories $orderRepository;

    public function __construct(OrderService $orderService, OrderRepositories $orderRepository)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function fetchAndStore($account, $page = 1, $dateFrom = '2024-12-01', $countAddedRecord = 0)
    {

        $dateTo = now()->format('Y-m-d');

        $response = $this->orderService->getOrders($dateFrom, $dateTo, $page);

//        self::getNullableField($response);
//        self::getMinMaxValue($response);

        $this->orderRepository->save($response['data'], $account, $countAddedRecord);

        if ($response['meta']['last_page'] > $page++) {
            $this->fetchAndStore(account: $account, page: $page, countAddedRecord: $countAddedRecord);
        } else {
            dump("Загрузка и сохранение данных для Incomes завершены.\nВсего сохранено записей {$countAddedRecord}");
        }
    }
}
