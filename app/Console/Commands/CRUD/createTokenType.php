<?php

namespace App\Console\Commands\CRUD;

use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\StockController;
use App\Models\Company;
use App\Models\TokenType;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class createTokenType extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:token_type {name}{type}';

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
        $type = $this->argument('type');


        if (TokenType::isExist($name)) {
            $this->error("Токен с именем '$name' уже существует.");
            return;
        }
        TokenType::create(['name' => $name, 'type' => $type]);

        $this->info("Токен '$name' успешно создан.");
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'Введите название токена!',
            'type' => 'Введите тип токена!',
        ];
    }
}
