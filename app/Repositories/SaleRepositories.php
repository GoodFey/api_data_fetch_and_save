<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Sale;


class SaleRepositories
{
    public static function save(array $data, $account, &$countAddedRecord): void
    {
        foreach ($data as $item) {
            $item['account_id'] = $account;

//            dump(Order::isExist($item));
            if (Sale::isExist($item)) {

                continue;
            }
            Sale::create($item);
            $countAddedRecord++;
        }
        dump("Сохранено записей: {$countAddedRecord}");
    }
}
