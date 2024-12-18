<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\StockController;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\search;
use function Laravel\Prompts\select;

class fetch extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch';

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

        $api_options = select(
            label: 'Выберите сервис для загрузки?',
            options: [
                1 => 'Income',
                2 => 'Order',
                3 => 'Sale',
                4 => 'Stock',
            ],
        );

        $account = search(
            label: 'Поиск по аккаунтам',
            options: fn(string $value) => strlen($value) > 0
                ? Account::whereLike('name', "%{$value}%")->pluck('name', 'id')->all()
                : []
        );

        $dateFrom = select(
            label: 'Выберете день начиная с которого пойдет загрузка.',
            options: [
                now()->format('Y-m-d') => 'Сегодня',
                Carbon::yesterday()->format('Y-m-d') => 'Вчера',
                Carbon::now()->subWeek()->format('Y-m-d') => 'Неделю назад',
                Carbon::now()->subYear()->format('Y-m-d') => 'Год назад',
            ],
        );

        $services = [
            '1' => IncomeController::class,
            '2' => OrderController::class,
            '3' => SaleController::class,
            '4' => StockController::class,
        ];

        $controller = app($services[$api_options]);
        $controller->fetchAndStore(account: $account, dateFrom: $dateFrom);

    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'service' => 'По какому API сервису получить данные? Доступные сервисы: Income, Order, Sale, Stock',
        ];
    }
}
