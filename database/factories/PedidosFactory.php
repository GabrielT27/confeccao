<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
        'cliente_id' => \App\Models\Cliente::factory(), // Cria um cliente para o pedido
        'produto' => fake()->word(),
        'tamanho' => fake()->randomElement(['P', 'M', 'G']),
        'valor_total' => fake()->randomFloat(2, 50, 500),
    ];
    }
}
