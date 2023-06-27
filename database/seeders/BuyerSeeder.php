<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            "Budi Santoso",
            "Linda Sari",
            "Rahmat Hidayat",
            "Dewi Rahayu",
            "Hendro Wijaya"
        ];

        $birthdate = [
            "1987-02-10",
            "1992-06-15",
            "1985-11-23",
            "1990-09-05",
            "1988-04-30"
        ];

        $phone = [
            "08123456789",
            "087654321",
            "08215554466",
            "08987654321",
            "0812345678"
        ];

        $address = [
            "Jl. Merdeka No. 10, Jakarta",
            "Jl. Sudirman No. 25, Bandung",
            "Jl. A. Yani No. 7, Surabaya",
            "Jl. Pahlawan No. 15, Yogyakarta",
            "Jl. Ahmad Dahlan No. 8, Semarang"
        ];


        $gender = ['male', 'female', 'male', 'female', 'male'];
        $balance = [100000, 0, 20000, 50000, 60000];
        $point = [5, 6, 7, 2, 1];
        $user = [6, 7, 8, 9, 10];

        for ($i = 0; $i < 4; $i++) {
            DB::table('buyers')->insert([
                // 'name' => $name[$i],
                'birthdate' => $birthdate[$i],
                'phone' => $phone[$i],
                'address' => $address[$i],
                'gender' => $gender[$i],
                'balance' => $balance[$i],
                'point' => $point[$i],
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => $user[$i]
            ]);
        }
    }
}
