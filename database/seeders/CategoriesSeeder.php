<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            "Pakaian Wanita",
            "Pakaian Pria",
            "Aksesoris",
            "Celana Panjang",
            "Celana Pendek",
            "Perhiasan",
            "Perawatan Kulit",
            "Pencerahan Kulit",
            "Parfum",
            "Kosmetik Mata"
        ];

        $deskripsi = [
            "Koleksi terbaru pakaian wanita trendy",
            "Pakaian pria fashion untuk segala kesempatan",
            "Celana Panjang stylish untuk melengkapi penampilan",
            "Celana Pendek dengan desain modern dan fungsional",
            "Produk makeup untuk tampilan yang sempurna",
            "Perhiasan elegan untuk mempercantik diri",
            "Produk perawatan kulit untuk mendapatkan kulit yang sehat",
            "Pencerahan kulit untuk kulit yang indah dan berkilau",
            "Wangi parfum yang memikat",
            "Kosmetik mata untuk tampilan mata yang menawan"
        ];
        for ($i = 0; $i < 10; $i++) {
            DB::table('categories')->insert([
                'category_name' => $category[$i],
                'description' => $deskripsi[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
