<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(), 
            'email' => $this->faker->unique()->safeEmail(), 
            'phone' => $this->faker->phoneNumber(), 
            'address' => $this->faker->address(), 
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
        ];
    }
}
