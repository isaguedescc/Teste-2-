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
            'company_id' => Company::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'value' => $this->faker->randomFloat(2, 10, 1000),
            'due_date' => $this->faker->date(),
            'competence_month' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'paid', 'cancelled']),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date()
        ];
    }
}
