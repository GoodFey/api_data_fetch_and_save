<?php

namespace App\Services;

class OrderService extends ApiClient
{
    public function getOrders($dateFrom, $dateTo, $page)
    {
        return $this->get('api/orders', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page
        ]);
    }
}
