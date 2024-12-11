<?php

namespace App\Services;

class SaleService extends ApiClient
{
    public function getSales($dateFrom, $dateTo, $page)
    {
        return $this->get('api/sales', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page
        ]);
    }
}
