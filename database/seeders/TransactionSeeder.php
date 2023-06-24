<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyer = [1, 1, 2, 2, 3, 3, 3, 4, 4, 4];
        $staff = [1, 2, 3, 4, 1, 2, 3, 4, 1, 2];
        for ($i = 0; $i < 10; $i++) {
            DB::table('transactions')->insert([
                'transaction_date' => now(),
                'total' => mt_rand(1000, 100000),
                'tax' => mt_rand(1000, 100000),
                'grand_total' => mt_rand(1000, 100000),
                'get_point' => rand(1, 15),
                'redeem_point' => 0,
                'staff_id' => $staff[$i],
                'buyer_id' => $buyer[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
