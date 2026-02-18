<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleDetail>
 */
class SaleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jumlah = fake()->numberBetween(1, 5);
        $unitPrice = fake()->numberBetween(200_000, 3_000_000);

        return [
            'sale_id' => Sale::factory(),
            'product_id' => Product::factory(),
            'jumlah' => $jumlah,
            'subtotal' => $jumlah * $unitPrice,
        ];
    }
}
