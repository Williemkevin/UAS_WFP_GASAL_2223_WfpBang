<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_name = [
            // Produk untuk tipe "balita"
            "Sepatu Bayi Lucu",
            "Baju Bayi Polos",
            "Mainan Gigitan Bayi",
            "Selimut Bayi Hangat",
            "Topi Bayi Imut",
            "Baju Renang Bayi",
            "Celana Pendek Bayi",
            "Set Pakaian Bayi",
            "Tas Gendong Bayi",
            "Kaus Kaki Bayi",

            // Produk untuk tipe "anak"
            "Baju Anak Perempuan",
            "Sepatu Anak Keren",
            "Mainan Edukatif Anak",
            "Ransel Anak Lucu",
            "Celana Jeans Anak",
            "Jaket Anak Sporty",
            "Pakaian Olahraga Anak",
            "Set Pakaian Sekolah",
            "Sepeda Anak",
            "Kacamata Anak Stylish",

            // Produk untuk tipe "remaja"
            "Tas Ransel Remaja",
            "Kemeja Remaja Modern",
            "Sepatu Sneakers Trendy",
            "Jeans Slim Fit",
            "Pakaian Renang Remaja",
            "Topi Snapback Kekinian",
            "Aksesoris Gaya Remaja",
            "Perhiasan Fashion Remaja",
            "Kaos Polos Remaja",
            "Tas Selempang Remaja",

            // Produk untuk tipe "pria"
            "Kemeja Pria Formal",
            "Sepatu Pria Casual",
            "Celana Panjang Pria",
            "Jaket Kulit Pria",
            "Kaos Polos Pria",
            "Topi Pria Stylish",
            "Jam Tangan Pria",
            "Dompet Kulit Pria",
            "Parfum Pria",
            "Kacamata Fashion Pria",

            // Produk untuk tipe "wanita"
            "Dress Wanita Elegan",
            "Sepatu Wanita High Heels",
            "Tas Wanita Trendy",
            "Makeup Set lengkap",
            "Perhiasan Cantik Wanita",
            "Rok Wanita Modis",
            "Blouse Wanita Fashion",
            "Pakaian Renang Wanita",
            "Jam Tangan Wanita",
            "Pashmina Stylish"
        ];

        $image_url = [
            // URL gambar untuk produk tipe "balita"
            "https://example.com/sepatu_bayi.jpg",
            "https://example.com/baju_bayi.jpg",
            "https://example.com/mainan_bayi.jpg",
            "https://example.com/selimut_bayi.jpg",
            "https://example.com/topi_bayi.jpg",
            "https://example.com/baju_renang_bayi.jpg",
            "https://example.com/celana_bayi.jpg",
            "https://example.com/set_pakaian_bayi.jpg",
            "https://example.com/tas_gendong_bayi.jpg",
            "https://example.com/kaus_kaki_bayi.jpg",

            // URL gambar untuk produk tipe "anak"
            "https://example.com/baju_anak_perempuan.jpg",
            "https://example.com/sepatu_anak.jpg",
            "https://example.com/mainan_edukatif_anak.jpg",
            "https://example.com/ransel_anak.jpg",
            "https://example.com/celana_jeans_anak.jpg",
            "https://example.com/jaket_anak.jpg",
            "https://example.com/pakaian_olahraga_anak.jpg",
            "https://example.com/set_pakaian_sekolah.jpg",
            "https://example.com/sepeda_anak.jpg",
            "https://example.com/kacamata_anak.jpg",

            // URL gambar untuk produk tipe "remaja"
            "https://example.com/tas_remasl.jpg",
            "https://example.com/kemeja_remaja.jpg",
            "https://example.com/sepatu_sneakers_remaja.jpg",
            "https://example.com/jeans_remaja.jpg",
            "https://example.com/pakaian_renang_remaja.jpg",
            "https://example.com/topi_snapback_remaja.jpg",
            "https://example.com/aksesoris_remaja.jpg",
            "https://example.com/perhiasan_remaja.jpg",
            "https://example.com/kaos_polos_remaja.jpg",
            "https://example.com/tas_selempang_remaja.jpg",

            // URL gambar untuk produk tipe "pria"
            "https://example.com/kemeja_pria.jpg",
            "https://example.com/sepatu_pria.jpg",
            "https://example.com/celana_pria.jpg",
            "https://example.com/jaket_kulit_pria.jpg",
            "https://example.com/kaos_polos_pria.jpg",
            "https://example.com/topi_pria.jpg",
            "https://example.com/jam_tangan_pria.jpg",
            "https://example.com/dompet_pria.jpg",
            "https://example.com/parfum_pria.jpg",
            "https://example.com/kacamata_pria.jpg",

            // URL gambar untuk produk tipe "wanita"
            "https://example.com/dress_wanita.jpg",
            "https://example.com/sepatu_wanita.jpg",
            "https://example.com/tas_wanita.jpg",
            "https://example.com/makeup_set.jpg",
            "https://example.com/perhiasan_wanita.jpg",
            "https://example.com/rok_wanita.jpg",
            "https://example.com/blouse_wanita.jpg",
            "https://example.com/pakaian_renang_wanita.jpg",
            "https://example.com/jam_tangan_wanita.jpg",
            "https://example.com/pashmina_wanita.jpg"
        ];

        $dimension = ['pcs'];
        $type_id = [1, 1, 1, 1, 1, 1, 11, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5];
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'product_name' => $product_name[$i],
                'image_url' => $image_url[$i],
                'price' => mt_rand(1000, 100000),
                'stock' => rand(1, 99),
                'dimension' => $dimension[0],
                'type_id' => $type_id[$i]
            ]);
        }
    }
}
