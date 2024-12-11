<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Repositories\IncomeRepositories;
use App\Services\IncomeService;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    protected IncomeService $incomeService;
    protected IncomeRepositories $incomeRepository;
    public function __construct(IncomeService $incomeService, IncomeRepositories $incomeRepository)
    {
        $this->incomeService = $incomeService;
        $this->incomeRepository = $incomeRepository;
    }

    public function fetchAndStoreIncomes($page=1)
    {
        $dateFrom = "2019-10-10";
        $dateTo = now()->format('Y-m-d');


        $responce = $this->incomeService->getIncomes($dateFrom, $dateTo, $page);

        $this->incomeRepository->save($responce['data']);
        dump("Сохранение прошло успешно для Income: page - {$page}");

        if ($responce['meta']['last_page'] > $page++) {
            $this->fetchAndStoreIncomes($page);
        }
    }
}
