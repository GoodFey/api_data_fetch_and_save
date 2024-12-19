<?php

namespace App\Services;

class IncomeService extends ApiClient
{
    public function getIncomes($dateFrom, $dateTo, $page, $apiService, $token)
    {

        return $this->get($apiService, 'api/incomes', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'key' => $token,
        ]);
    }
}
