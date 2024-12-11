<?php

namespace App\Services;

class StockService extends ApiClient
{
    public function getStocks($dateFrom, $page)
    {
        return $this->get('api/stocks', [
            'dateFrom' => $dateFrom,
            'page' => $page
        ]);
    }
}
