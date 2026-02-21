<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Seed 13 transaksi penjualan realistis milik 3 kasir selama ~2,5 bulan terakhir.
     *
     * Setiap transaksi merepresentasikan skenario pembelian furnitur yang wajar,
     * dengan subtotal dihitung dari harga produk aktual di database.
     */
    public function run(): void
    {
        $cashiers = User::where('role', 'kasir')->get()->keyBy('email');
        $products = Product::all()->keyBy('nama_produk');

        /** @var array<int, array{cashier: string, tanggal: \Carbon\Carbon, items: array<int, array{produk: string, jumlah: int}>}> $salesData */
        $salesData = [
            // --- Transaksi Dewi Rahayu ---
            [
                'cashier' => 'dewi@jayamebel.id',
                'tanggal' => now()->subDays(75),
                'items' => [
                    ['produk' => 'Kursi Tamu Minimalis Set 3+1+1', 'jumlah' => 1],
                    ['produk' => 'Meja Kopi Bundar Kayu Trembesi', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'dewi@jayamebel.id',
                'tanggal' => now()->subDays(60),
                'items' => [
                    ['produk' => 'Meja Makan 4 Kursi Minimalis', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'dewi@jayamebel.id',
                'tanggal' => now()->subDays(50),
                'items' => [
                    ['produk' => 'Tempat Tidur Queen 160×200 cm', 'jumlah' => 1],
                    ['produk' => 'Nakas Kayu Minimalis', 'jumlah' => 2],
                ],
            ],
            [
                'cashier' => 'dewi@jayamebel.id',
                'tanggal' => now()->subDays(35),
                'items' => [
                    ['produk' => 'Lemari Pakaian 3 Pintu Sliding', 'jumlah' => 1],
                    ['produk' => 'Meja Rias Lengkap dengan Cermin', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'dewi@jayamebel.id',
                'tanggal' => now()->subDays(15),
                'items' => [
                    ['produk' => 'Sofa L-Shape Modern 240 cm', 'jumlah' => 1],
                    ['produk' => 'Bufet TV Minimalis 150 cm', 'jumlah' => 1],
                ],
            ],

            // --- Transaksi Ahmad Fauzi ---
            [
                'cashier' => 'ahmad@jayamebel.id',
                'tanggal' => now()->subDays(70),
                'items' => [
                    ['produk' => 'Meja Kerja L-Shape Kayu Mahoni', 'jumlah' => 1],
                    ['produk' => 'Rak Buku 5 Susun Kayu Jati', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'ahmad@jayamebel.id',
                'tanggal' => now()->subDays(55),
                'items' => [
                    ['produk' => 'Rak Buku 5 Susun Kayu Jati', 'jumlah' => 2],
                    ['produk' => 'Rak Sepatu 4 Susun Kayu', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'ahmad@jayamebel.id',
                'tanggal' => now()->subDays(40),
                'items' => [
                    ['produk' => 'Meja Makan 6 Kursi Kayu Jati', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'ahmad@jayamebel.id',
                'tanggal' => now()->subDays(20),
                'items' => [
                    ['produk' => 'Tempat Tidur King 180×200 cm', 'jumlah' => 1],
                    ['produk' => 'Nakas Kayu Minimalis', 'jumlah' => 2],
                    ['produk' => 'Lemari Pakaian 4 Pintu Kaca', 'jumlah' => 1],
                ],
            ],

            // --- Transaksi Siti Nurhaliza ---
            [
                'cashier' => 'siti@jayamebel.id',
                'tanggal' => now()->subDays(65),
                'items' => [
                    ['produk' => 'Meja Belajar Anak Serbaguna', 'jumlah' => 1],
                    ['produk' => 'Rak Buku 5 Susun Kayu Jati', 'jumlah' => 1],
                    ['produk' => 'Dipan Minimalis Kayu Mahoni', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'siti@jayamebel.id',
                'tanggal' => now()->subDays(45),
                'items' => [
                    ['produk' => 'Dipan Minimalis Kayu Mahoni', 'jumlah' => 1],
                    ['produk' => 'Lemari Pakaian 3 Pintu Sliding', 'jumlah' => 1],
                ],
            ],
            [
                'cashier' => 'siti@jayamebel.id',
                'tanggal' => now()->subDays(30),
                'items' => [
                    ['produk' => 'Kursi Makan Kayu Jati Set 4', 'jumlah' => 2],
                ],
            ],
            [
                'cashier' => 'siti@jayamebel.id',
                'tanggal' => now()->subDays(10),
                'items' => [
                    ['produk' => 'Lemari Dapur Bawah 180 cm', 'jumlah' => 1],
                    ['produk' => 'Meja Tamu Kayu Jati Oval', 'jumlah' => 1],
                ],
            ],
        ];

        foreach ($salesData as $saleData) {
            $cashier = $cashiers[$saleData['cashier']];
            $totalHarga = 0;
            $detailsToInsert = [];

            foreach ($saleData['items'] as $item) {
                $product = $products[$item['produk']];
                $subtotal = $product->harga * $item['jumlah'];
                $totalHarga += $subtotal;

                $detailsToInsert[] = [
                    'product_id' => $product->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ];
            }

            $sale = Sale::create([
                'user_id' => $cashier->id,
                'total_harga' => $totalHarga,
                'tanggal_penjualan' => $saleData['tanggal'],
            ]);

            foreach ($detailsToInsert as $detail) {
                $sale->details()->create($detail);
            }
        }
    }
}
