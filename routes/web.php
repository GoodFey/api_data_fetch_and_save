<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use \App\Http\Controllers\StockController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/incomes', [IncomeController::class, 'fetchAndStoreIncomes']);
Route::get('/stocks', [StockController::class, 'fetchAndStoreStocks']);
Route::get('/sales', [SaleController::class, 'fetchAndStoreSales']);
Route::get('/orders', [OrderController::class, 'fetchAndStoreOrders']);
