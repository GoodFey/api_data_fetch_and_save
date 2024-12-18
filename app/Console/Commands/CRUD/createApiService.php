<?php

namespace App\Console\Commands\CRUD;

use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\StockController;
use App\Models\ApiService;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class createApiService extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:api_service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');


        if (ApiService::isExist($name)) {
            $this->error("API сервис с именем '$name' уже существует.");
            return;
        }
        ApiService::create(['name' => $name]);

        $this->info("API сервис '$name' успешно создан.");
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'Введите имя API сервиса!',
        ];
    }
}
