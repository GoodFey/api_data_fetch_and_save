<?php

namespace App\Repositories;

use App\Models\Stock;

class StockRepositories
{
    public function save(array $incomes): void
    {
        foreach ($incomes as $income) {
            Stock::create($income);
        }
    }
}
