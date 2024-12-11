<?php

namespace App\Repositories;

use App\Models\Income;

class IncomeRepositories
{
    public function save(array $incomes): void
    {
        foreach ($incomes as $income) {
            Income::create($income);
        }
    }
}
