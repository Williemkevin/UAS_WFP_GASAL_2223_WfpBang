<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            'name' => "Bagas Suryanto",
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1
        ]);
    }
}
