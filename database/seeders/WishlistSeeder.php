<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('wishlists')->insert([
                'product_id' => rand(1, 30),
                'buyer_id' => rand(6, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
