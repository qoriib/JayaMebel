<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stok = fake()->numberBetween(0, 50);

        return [
            'nama_produk' => fake()->words(3, true),
            'deskripsi' => fake()->paragraph(),
            'gambar' => null,
            'stok' => $stok,
            'stok_status' => $stok > 0 ? 'tersedia' : 'tidak',
            'harga' => fake()->numberBetween(500_000, 5_000_000),
        ];
    }
}
