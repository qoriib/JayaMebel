<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->admin()
            ->create([
                'nama' => 'Admin Demo',
                'email' => 'admin@jayamebel.id',
            ]);

        $cashiers = User::factory()
            ->cashier()
            ->count(3)
            ->create();

        $products = Product::factory()
            ->count(15)
            ->create();

        $cashiers->each(function (User $cashier) use ($products): void {
            Sale::factory()
                ->count(4)
                ->for($cashier, 'cashier')
                ->create()
                ->each(function (Sale $sale) use ($products): void {
                    $details = SaleDetail::factory()
                        ->count(fake()->numberBetween(1, 3))
                        ->state(function () use ($products): array {
                            $product = $products->random();
                            $qty = fake()->numberBetween(1, 5);

                            return [
                                'product_id' => $product->id,
                                'jumlah' => $qty,
                                'subtotal' => $qty * $product->harga,
                            ];
                        })
                        ->for($sale)
                        ->create();

                    $sale->update([
                        'total_harga' => $details->sum('subtotal'),
                    ]);
                });
        });
    }
}
