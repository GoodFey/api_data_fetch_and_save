<?php

namespace App\Console\Commands\CRUD;

use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\StockController;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class createCompany extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:company {name}';

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
        $isExist = Company::where('name', $name)->first();

        if ($isExist) {
            $this->error("Компания с именем '$name' уже существует.");
            return;
        }
        Company::create(['name' => $name]);

        $this->info("Компания '$name' успешно создана.");
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'Введите название компании!',
        ];
    }
}
