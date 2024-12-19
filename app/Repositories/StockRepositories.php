<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Stock;

class StockRepositories
{
    public static function save(array $data, $account, &$countAddedRecord): void
    {
        foreach ($data as $item) {
            $item['account_id'] = $account;

            if (Stock::isExist($item)) {
                continue;
            }
            Stock::create($item);
            $countAddedRecord++;
        }
        dump("Сохранено записей: {$countAddedRecord}");
    }
}
