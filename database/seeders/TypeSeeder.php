<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_name = ["balita", "anak", "remaja", "pria", "wanita"];

        $description = [
            "Produk khusus untuk balita yang memberikan nutrisi dan perlindungan yang dibutuhkan.",
            "Pilihan produk yang menyenangkan dan bermanfaat untuk anak-anak dalam masa pertumbuhan.",
            "Produk yang sesuai dengan kebutuhan remaja, baik dalam perawatan diri maupun gaya fashion.",
            "Pilihan produk yang dirancang khusus untuk kebutuhan pria, termasuk perawatan kulit, wangi-wangian, dan pakaian.",
            "Produk yang dirancang khusus untuk kebutuhan wanita, termasuk perawatan kulit, kosmetik, aksesoris, dan pakaian."
        ];
        for ($i = 0; $i < 5; $i++) {
            DB::table('types')->insert([
                'type_name' => $type_name[$i],
                'description' => $description[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
