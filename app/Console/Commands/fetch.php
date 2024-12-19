<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\ApiController;
use App\Models\Account;
use App\Models\ApiService;
use App\Models\ApiToken;
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
        $account = search(
            label: 'Выберите аккаунт',
            options: fn(string $value) => strlen($value) > 0
                ? Account::whereLike('name', "%{$value}%")->pluck('name', 'id')->all()
                : []
        );
        $apiService = search(
            label: 'Выберите API сервис',
            options: fn(string $value) => strlen($value) > 0
                ? ApiService::whereLike('name', "%{$value}%")->pluck('name', 'id')->all()
                : []
        );
        $token = search(
            label: 'Выберите токен',
            options: fn(string $value) => strlen($value) > 0
                ? ApiToken::getTokenByService($apiService)
                : []
        );

        $apiEndpointSelect = select(
            label: 'Выберите эндпоинт для загрузки.',
            options: [
                1 => 'Income',
                2 => 'Order',
                3 => 'Sale',
                4 => 'Stock',
            ],
        );

        $dateFrom = select(
            label: 'Выберете день начиная с которого пойдет загрузка.',
            options: [
                now()->format('Y-m-d') => 'Today',
                Carbon::yesterday()->format('Y-m-d') => 'Yesterday',
                Carbon::now()->subWeek()->format('Y-m-d') => 'Week',
                Carbon::now()->subMonth()->format('Y-m-d') => 'Month',
                Carbon::now()->subYear()->format('Y-m-d') => 'Year',
            ],
        );

        $api_endpoint = [
            '1' => 'api/incomes',
            '2' => 'api/orders',
            '3' => 'api/sales',
            '4' => 'api/stocks',
        ];

        $apiService = ApiService::find($apiService)->value;



        ApiController::fetchAndStore(account: $account, apiService: $apiService, token: $token, dateFrom: $dateFrom,
            api_endpoint: $api_endpoint[$apiEndpointSelect]);
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
