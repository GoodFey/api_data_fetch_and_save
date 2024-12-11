<?php

namespace App\Repositories;

use App\Models\Sale;


class SaleRepositories
{
    public function save(array $incomes): void
    {
        foreach ($incomes as $income) {
            Sale::create($income);
        }
    }
}
