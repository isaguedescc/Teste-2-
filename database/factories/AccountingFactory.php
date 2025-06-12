<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accounting>
 */
class AccountingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // Gera um ID de usuário fictício
            'company_id' => \App\Models\Company::factory(), // Gera um ID de empresa fictícia
            'description' => $this->faker->sentence(), // Gera uma frase fictícia
            'type' => $this->faker->randomElement(['Entrada', 'Saída']), // Seleciona aleatoriamente 'Entrada' ou 'Saída'
            'value' => $this->faker->randomFloat(2, 10, 1000), 
            'date' => $this->faker->date(), // Gera uma data fictícia
            'competence_month' => $this->faker->date(), // Gera uma data fictícia'
            'amount' => $this->faker->randomFloat(2, 10, 1000), // Gera um float com 2 casas decimais entre 10 e 1000
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(), // Gera uma data fictícia
        ];
    }
}
