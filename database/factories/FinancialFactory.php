<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Financial>
 */
class FinancialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
            'description' => $this->faker->sentence(),
            'value' => $this->faker->randomFloat(2, 10, 1000),
            'date' => $this->faker->date(),
            'competence_month' => $this->faker->date('Y-m-01'),
        ];
    }
}
