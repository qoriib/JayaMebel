<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->cashier(),
            'total_harga' => fake()->numberBetween(1_000_000, 10_000_000),
            'tanggal_penjualan' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
