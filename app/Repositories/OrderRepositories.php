<?php

namespace App\Repositories;

use App\Models\Income;
use App\Models\Order;

class OrderRepositories
{
    public function save(array $data, $account, &$countAddedRecord): void
    {
        foreach ($data as $item) {
            $item['account_id'] = $account;

            if (Order::isExist($item)) {
                continue;
            }
            Order::create($item);
            $countAddedRecord++;
        }
        dump("Сохранено записей: {$countAddedRecord}");
    }
}
