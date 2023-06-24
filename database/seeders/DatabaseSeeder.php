<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BuyerSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(OwnerSeeder::class);

        $this->call(CategoriesSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductHasCategoriesSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(ProductsHasTransactionsSeeder::class);
        $this->call(WishlistSeeder::class);
    }
}
