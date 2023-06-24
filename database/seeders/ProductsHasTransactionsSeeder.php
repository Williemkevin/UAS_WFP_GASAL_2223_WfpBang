<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsHasTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction = [1, 1, 1, 2, 2, 3, 3, 3, 3, 4, 4, 4, 5, 5, 5, 6, 6, 7, 7, 7, 8, 9, 9, 10, 10];
        for ($i = 0; $i < 25; $i++) {
            DB::table('products_has_transactions')->insert([
                'quantity' => rand(1, 10),
                'price' => mt_rand(1000, 100000),
                'product_id' => rand(1, 30),
                'transaction_id' => $transaction[$i]
            ]);
        }
    }
}
