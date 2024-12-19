<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\IncomeRepositories;
use App\Services\IncomeService;

class IncomeController extends Controller
{
    protected IncomeService $incomeService;
    protected IncomeRepositories $incomeRepository;

    public function __construct(IncomeService $incomeService, IncomeRepositories $incomeRepository)
    {
        $this->incomeService = $incomeService;
        $this->incomeRepository = $incomeRepository;
    }

    public function fetchAndStore($account, $page = 1, $dateFrom = "2023-10-10", $countAddedRecord = 0)
    {
        $apiService = "http://89.108.115.241:6969/";
        $token = "E6kUTYrYwZq2tN4QEtyzsbEBk3ie";

        $dateTo = now()->format('Y-m-d');

        $response = $this->incomeService->getIncomes($dateFrom, $dateTo, $page, $apiService, $token);

        $this->incomeRepository->save($response['data'], $account, $countAddedRecord);

        if ($response['meta']['last_page'] > $page++) {
            $this->fetchAndStore(account: $account, page: $page, countAddedRecord: $countAddedRecord);
        } else {
            dump("Загрузка и сохранение данных для Incomes завершены.\nВсего сохранено записей {$countAddedRecord}");
        }
    }
}
