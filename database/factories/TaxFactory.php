<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
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
            'value' => $this->faker->randomFloat(2, 10, 1000), // Decimal with 2 places, between 10 and 1000
            'due_date' => $this->faker->date(),
            'competence_month' => $this->faker->date('Y-m-01'), // First day of a month
            'status' => $this->faker->randomElement(['paid', 'pending', 'overdue']),
        ];
    }
}
