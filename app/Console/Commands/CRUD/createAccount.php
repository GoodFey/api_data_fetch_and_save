<?php

namespace App\Console\Commands\CRUD;

use App\Models\Account;
use App\Models\Company;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class createAccount extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:account {name} {company}';

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
        $data = $this->arguments();

        if (Account::isExist($data['name'])) {
            $this->error("Аккаунт с таким именем уже существует.");
            return;
        } elseif (!Company::isExist($data['company'])) {
            $this->error("Компания к которой должен относиться этот аккаунт не найдена!");
            return;
        }
        Account::store($data);
        $this->info("Аккаунт успешно создан.");
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'Введите название аккаунта!',
            'company' => 'Введите название компании к которой этот аккаунт относится!'
        ];
    }
}
