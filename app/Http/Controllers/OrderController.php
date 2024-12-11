<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepositories;
use App\Services\OrderService;

use App\Traits\DataVerification;
use Illuminate\Http\Request;

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

    public function fetchAndStoreOrders($page = 1)
    {
        $dateFrom = '2019-01-01';
        $dateTo = now()->format('Y-m-d');


        $responce = $this->orderService->getOrders($dateFrom, $dateTo, $page);

//        self::getNullableField($responce);
//        self::getMinMaxValue($responce);

        $this->orderRepository->save($responce['data']);
        dump("Сохранение прошло успешно для Order: page - {$page}");
//
        if ($responce['meta']['last_page'] > $page++) {
            $this->fetchAndStoreOrders($page);
        }
    }
}
