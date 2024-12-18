<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\ApiServiceTokenType;
use App\Models\Company;
use App\Models\TokenType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ApiServiceTokenTypeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Account::factory(10)->create();
        ApiServiceTokenType::factory(4)->create();
    }
}
