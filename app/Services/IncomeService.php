<?php

namespace App\Services;

class IncomeService extends ApiClient
{
    public function getIncomes($dateFrom, $dateTo, $page)
    {

        return $this->get('api/incomes', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page
        ]);
    }
}
