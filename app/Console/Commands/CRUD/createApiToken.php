<?php

namespace App\Console\Commands\CRUD;

use App\Models\Account;
use App\Models\ApiService;
use App\Models\ApiServiceTokenType;
use App\Models\ApiToken;
use App\Models\TokenType;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use function Laravel\Prompts\search;
use function Laravel\Prompts\text;


class createApiToken extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:api_token';

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
            label: 'Поиск по аккаунтам',
            options: fn(string $value) => strlen($value) > 0
                ? Account::whereLike('name', "%{$value}%")->pluck('name', 'id')->all()
                : []
        );
        $apiService = search(
            label: 'Поиск по API сервисам',
            options: fn(string $value) => strlen($value) > 0
                ? ApiService::whereLike('name', "%{$value}%")->pluck('name', 'id')->all()
                : [],
        );
        $tokenType = search(
            label: 'Поиск по типам Токенов',
            options: fn(string $value) => strlen($value) > 0
                ? TokenType::whereLike('name', "%{$value}%")->pluck('name', 'id')->all()
                : [],
            validate: fn(string $value) => ApiServiceTokenType::isTokenAllowedForService($apiService, $value)
                ? null
                : 'Ошибка: для данного сервиса выбранный тип токена - запрещен!'
        );
        $tokenValue = text(
            label: 'Введите данные токена',
        );

        ApiToken::create([
            'account_id' => $account,
            'api_service_id' => $apiService,
            'token_type_id' => $tokenType,
            'token_value' => $tokenValue,
        ]);

        $this->info('API Токен успешно создан, поздравляю!');


    }


}
