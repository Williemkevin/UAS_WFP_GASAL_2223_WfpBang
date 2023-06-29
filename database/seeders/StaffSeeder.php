<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            "Rina Setiawan",
            "Ahmad Abdullah",
            "Siti Nurhayati",
            "Hendra Pratama"
        ];
        $birthdate = [
            "1995-08-12",
            "1990-04-05",
            "1988-11-30",
            "1993-07-18"
        ];
        $phone = [
            "0812345678",
            "0876543210",
            "08225556677",
            "08989898989"
        ];
        $address = [
            "Jl. Gajah Mada No. 15, Jakarta",
            "Jl. Diponegoro No. 8, Bandung",
            "Jl. Ahmad Yani No. 7, Surabaya",
            "Jl. Malioboro No. 10, Yogyakarta"
        ];
        $gender = ['male', 'female', 'male', 'female'];
        $user = [2, 3, 4, 5];
        for ($i = 0; $i < 4; $i++) {
            DB::table('staffs')->insert([
                // 'name' => $name[$i],
                'birthdate' => $birthdate[$i],
                'phone' => $phone[$i],
                'address' => $address[$i],
                'gender' => $gender[$i],
                'hired' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => $user[$i]
            ]);
        }
    }
}
