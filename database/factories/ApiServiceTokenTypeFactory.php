<?php

namespace Database\Factories;

use App\Models\ApiService;
use App\Models\TokenType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class ApiServiceTokenTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'api_service_id' => ApiServiceFactory::new(),
            'token_type_id' => TokenTypeFactory::new(),
        ];
    }
}
