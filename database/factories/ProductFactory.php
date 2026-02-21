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
        $namaOptions = [
            'Kursi Tamu Minimalis',
            'Sofa 3 Dudukan Fabric',
            'Meja Makan 4 Kursi',
            'Lemari Pakaian 2 Pintu',
            'Tempat Tidur Single 120 cm',
            'Tempat Tidur Queen 160 cm',
            'Meja Kerja Kayu Mahoni',
            'Meja Belajar Anak',
            'Rak Buku 4 Susun',
            'Bufet TV 120 cm',
            'Meja Kopi Kayu Solid',
            'Nakas Kayu Minimalis',
            'Lemari Dapur 120 cm',
            'Kursi Makan Kayu Jati',
            'Dipan Minimalis Kayu',
            'Rak Sepatu 3 Susun',
            'Meja Rias dengan Cermin',
            'Sofa 2 Dudukan Modern',
            'Meja Tamu Oval Kayu',
            'Lemari Pakaian Sliding',
        ];

        $deskripsiOptions = [
            'Terbuat dari kayu mahoni solid pilihan, finishing politur natural tahan lama. Cocok untuk hunian minimalis modern.',
            'Dibuat dari kayu jati grade A dengan konstruksi kokoh dan sambungan mortise-and-tenon. Tahan hingga puluhan tahun.',
            'Material MDF lapis HPL premium anti-gores dan anti-lembab. Tersedia dalam berbagai pilihan finishing warna.',
            'Rangka kayu solid dengan pelapis fabric tebal, nyaman untuk penggunaan harian. Mudah dibersihkan.',
            'Desain simpel dan fungsional cocok untuk kamar berukuran sedang. Finishing cat duco putih bersih.',
            'Kayu pinus pilihan dengan finishing wax oil, menonjolkan serat kayu alami yang indah.',
        ];

        $stok = fake()->numberBetween(0, 30);

        return [
            'nama_produk' => fake()->randomElement($namaOptions),
            'deskripsi' => fake()->randomElement($deskripsiOptions),
            'gambar' => null,
            'stok' => $stok,
            'stok_status' => $stok > 0 ? 'tersedia' : 'tidak',
            'harga' => fake()->randomElement([
                450_000, 650_000, 900_000, 1_100_000, 1_200_000,
                1_500_000, 1_800_000, 1_900_000, 2_400_000, 2_800_000,
                2_900_000, 3_200_000, 3_600_000, 3_800_000, 4_200_000,
                4_500_000, 5_200_000, 5_600_000, 7_800_000, 8_500_000,
            ]),
        ];
    }
}
