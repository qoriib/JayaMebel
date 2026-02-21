<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed 20 produk furnitur realistis khas toko mebel Indonesia.
     */
    public function run(): void
    {
        $products = [
            [
                'nama_produk' => 'Kursi Tamu Minimalis Set 3+1+1',
                'deskripsi' => 'Set kursi tamu elegan dengan desain minimalis modern. Terdiri dari sofa 3 dudukan dan 2 sofa 1 dudukan. Rangka kayu solid jati, bahan fabric premium anti-noda dengan busa high-density 10 cm. Cocok untuk ruang tamu ukuran 4×4 meter.',
                'stok' => 5,
                'harga' => 4_500_000,
            ],
            [
                'nama_produk' => 'Sofa L-Shape Modern 240 cm',
                'deskripsi' => 'Sofa sudut elegan berukuran 240×160 cm dengan desain kontemporer. Rangka kayu pinus solid, pelapis kulit sintetis premium tahan lama. Dilengkapi bantal sofa dan sandaran kepala yang dapat dilepas-pasang.',
                'stok' => 3,
                'harga' => 7_800_000,
            ],
            [
                'nama_produk' => 'Meja Makan 6 Kursi Kayu Jati',
                'deskripsi' => 'Set meja makan 6 kursi berbahan kayu jati solid pilihan. Meja berukuran 180×80 cm dengan ketebalan papan 5 cm. Kursi dengan dudukan empuk berlapis fabric. Finishing natural dengan lapisan politur anti-gores.',
                'stok' => 4,
                'harga' => 8_500_000,
            ],
            [
                'nama_produk' => 'Meja Makan 4 Kursi Minimalis',
                'deskripsi' => 'Set meja makan 4 kursi desain minimalis modern. Meja berukuran 120×70 cm, material kayu mahoni solid. Kursi dengan kaki besi powder-coat hitam dan dudukan kayu. Ideal untuk ruang makan berukuran sedang.',
                'stok' => 6,
                'harga' => 5_200_000,
            ],
            [
                'nama_produk' => 'Lemari Pakaian 4 Pintu Kaca',
                'deskripsi' => 'Lemari pakaian 4 pintu dengan kombinasi panel kayu dan cermin. Ukuran 200×55×200 cm, dilengkapi rak baju, gantungan baju, dan laci penyimpanan dalam. Material MDF lapis HPL tahan lama.',
                'stok' => 7,
                'harga' => 3_800_000,
            ],
            [
                'nama_produk' => 'Lemari Pakaian 3 Pintu Sliding',
                'deskripsi' => 'Lemari pakaian pintu geser 3 panel dengan rel premium anti-macet. Ukuran 180×45×200 cm, hemat ruang untuk kamar tidur kecil. Satu panel cermin, interior rak susun dan gantungan pakaian.',
                'stok' => 8,
                'harga' => 2_900_000,
            ],
            [
                'nama_produk' => 'Tempat Tidur Queen 160×200 cm',
                'deskripsi' => 'Ranjang kayu mahoni solid desain minimalis dengan headboard berlapis fabric. Ukuran 160×200 cm cocok untuk kasur queen. Dilengkapi laci penyimpanan di bawah matras. Finishing cat duco putih.',
                'stok' => 5,
                'harga' => 4_200_000,
            ],
            [
                'nama_produk' => 'Tempat Tidur King 180×200 cm',
                'deskripsi' => 'Ranjang kayu solid premium ukuran 180×200 cm dengan headboard tinggi bertekstur. Material kayu jati pilihan, finishing politur natural. Dilengkapi storage drawer di bagian bawah dan rel laci full-extension.',
                'stok' => 3,
                'harga' => 5_600_000,
            ],
            [
                'nama_produk' => 'Meja Kerja L-Shape Kayu Mahoni',
                'deskripsi' => 'Meja kerja sudut L berukuran 140×120 cm berbahan kayu mahoni pilihan. Dilengkapi rak monitor, kabinet samping 2 laci, dan cable management. Cocok untuk home office maupun ruang kerja profesional.',
                'stok' => 10,
                'harga' => 2_400_000,
            ],
            [
                'nama_produk' => 'Meja Belajar Anak Serbaguna',
                'deskripsi' => 'Meja belajar anak ukuran 100×60 cm dengan rak buku samping 3 tingkat. Material kayu MDF lapis melamin anti-gores, finishing cat cerah aman anak (non-toxic). Dilengkapi pengait tas dan papan tulis kecil.',
                'stok' => 12,
                'harga' => 1_200_000,
            ],
            [
                'nama_produk' => 'Rak Buku 5 Susun Kayu Jati',
                'deskripsi' => 'Rak buku 5 tingkat berbahan kayu jati solid ukuran 80×30×180 cm. Finishing politur natural, tahan beban hingga 20 kg per rak. Cocok untuk ruang baca, kamar tidur, atau sudut ruang tamu.',
                'stok' => 15,
                'harga' => 900_000,
            ],
            [
                'nama_produk' => 'Bufet TV Minimalis 150 cm',
                'deskripsi' => 'Bufet TV desain minimalis Scandinavian dengan kaki kayu solid. Panjang 150 cm, 3 pintu dengan pegangan tersembunyi. Tahan untuk TV hingga 65 inci. Material kayu MDF lapis veneer oak natural.',
                'stok' => 9,
                'harga' => 1_800_000,
            ],
            [
                'nama_produk' => 'Meja Kopi Bundar Kayu Trembesi',
                'deskripsi' => 'Meja kopi dari kayu trembesi solid dengan serat kayu alami yang unik. Diameter 80 cm, tinggi 45 cm. Permukaan halus, finishing epoxy clear coat tahan air dan panas gelas. Karakter serat kayu setiap unit berbeda.',
                'stok' => 11,
                'harga' => 1_100_000,
            ],
            [
                'nama_produk' => 'Nakas Kayu Minimalis',
                'deskripsi' => 'Nakas (meja samping ranjang) desain minimalis ukuran 45×35×50 cm. Dilengkapi 2 laci dengan rel halus soft-close. Material kayu mahoni pilihan, cocok dipadukan dengan ranjang ukuran single, queen, maupun king.',
                'stok' => 20,
                'harga' => 650_000,
            ],
            [
                'nama_produk' => 'Meja Rias Lengkap dengan Cermin',
                'deskripsi' => 'Set meja rias dengan cermin oval besar ukuran 60×80 cm. Dilengkapi lampu LED strip di sekeliling cermin, 3 laci meja, dan kursi rias berlapis beludru. Finishing cat duco putih glossy.',
                'stok' => 6,
                'harga' => 1_900_000,
            ],
            [
                'nama_produk' => 'Rak Sepatu 4 Susun Kayu',
                'deskripsi' => 'Rak sepatu 4 tingkat dari kayu pinus solid ukuran 80×30×100 cm. Kapasitas 16 pasang sepatu, finishing cat putih bersih. Ringan dan mudah dipindah, cocok untuk lorong masuk, kamar, atau balkon.',
                'stok' => 25,
                'harga' => 450_000,
            ],
            [
                'nama_produk' => 'Dipan Minimalis Kayu Mahoni',
                'deskripsi' => 'Dipan/ranjang tanpa headboard desain simpel ukuran 120×200 cm. Kayu mahoni solid, finishing cat natural. Cocok untuk kamar anak, kos-kosan, atau kamar tamu. Mudah dirakit dengan baut pengunci tersembunyi.',
                'stok' => 8,
                'harga' => 1_500_000,
            ],
            [
                'nama_produk' => 'Lemari Dapur Bawah 180 cm',
                'deskripsi' => 'Kabinet dapur bawah (base cabinet) ukuran 180×60×85 cm. Dilengkapi 4 pintu dan 2 laci wide, engsel soft-close. Material kayu MDF lapis HPL motif kayu, bisa dikombinasikan dengan kitchen set lainnya.',
                'stok' => 4,
                'harga' => 3_600_000,
            ],
            [
                'nama_produk' => 'Meja Tamu Kayu Jati Oval',
                'deskripsi' => 'Meja tamu oval premium dari kayu jati solid berukuran 130×70 cm. Serat kayu alami menonjol dengan finishing wax oil. Empat kaki silinder berbalut aksen tembaga untuk kesan mewah yang hangat.',
                'stok' => 4,
                'harga' => 3_200_000,
            ],
            [
                'nama_produk' => 'Kursi Makan Kayu Jati Set 4',
                'deskripsi' => 'Set 4 kursi makan berbahan kayu jati solid. Desain klasik modern dengan sandaran berlapis fabric premium anti-noda. Kaki kursi kokoh dengan dudukan ergonomis. Cocok dipadukan dengan meja makan kayu apa pun.',
                'stok' => 7,
                'harga' => 2_800_000,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'nama_produk' => $product['nama_produk'],
                'deskripsi' => $product['deskripsi'],
                'gambar' => null,
                'stok' => $product['stok'],
                'stok_status' => $product['stok'] > 0 ? 'tersedia' : 'tidak',
                'harga' => $product['harga'],
            ]);
        }
    }
}
