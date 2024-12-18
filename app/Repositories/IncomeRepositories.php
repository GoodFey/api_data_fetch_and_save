<?php

namespace App\Repositories;

use App\Models\Income;

class IncomeRepositories
{
    public function save(array $incomes, $account, &$countAddedRecord): void
    {
        foreach ($incomes as $income) {
            $income['account_id'] = $account;

            if (Income::isExist($income)) {
                continue;
            }
            Income::create($income);
            $countAddedRecord++;
        }
        dump("Сохранено записей: {$countAddedRecord}");
    }
}
