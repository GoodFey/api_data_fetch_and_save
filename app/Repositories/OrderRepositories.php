<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepositories
{
    public function save(array $orders): void
    {
        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
