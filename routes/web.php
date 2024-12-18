<?php

use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\StockController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/incomes', [IncomeController::class, 'fetchAndStore']);
Route::get('/stocks', [StockController::class, 'fetchAndStore']);
Route::get('/sales', [SaleController::class, 'fetchAndStore']);
Route::get('/orders', [OrderController::class, 'fetchAndStore']);
