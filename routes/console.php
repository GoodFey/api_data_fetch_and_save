<?php

use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\StockController;
use App\Models\Company;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Console\PromptsForMissingInput;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Группа команд для получения данных по расписанию - дважды в день

Artisan::command('incomes:fetch-today', function () {
    $controller = app(IncomeController::class);
    $todayDate = now()->format('Y-m-d');
    $controller->fetchAndStore(dateFrom: $todayDate, account: 1);
    Log::info("Данные для Incomes за {$todayDate} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);

Artisan::command('orders:fetch-today', function () {
    $controller = app(OrderController::class);
    $todayDate = now()->format('Y-m-d');
    $controller->fetchAndStore(dateFrom: $todayDate, account: 1);
    Log::info("Данные для Orders за {$todayDate} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);

Artisan::command('sales:fetch-today', function () {
    $controller = app(SaleController::class);
    $todayDate = now()->format('Y-m-d');
    $controller->fetchAndStore(dateFrom: $todayDate, account: 1);
    Log::info("Данные для Sale за {$todayDate} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);

Artisan::command('stock:fetch-today', function () {
    $controller = app(StockController::class);
    $todayDate = now()->format('Y-m-d');
    $controller->fetchAndStore(dateFrom: $todayDate, account: 1);
    Log::info("Данные для Stock за {$todayDate} успешно сохранены!");
})->schedule()->twiceDaily(8, 16);




