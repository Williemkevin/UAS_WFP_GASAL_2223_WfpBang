<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ["John","Sarah","Mike","Lisa","Robert","Emily","David","Jennifer","Andrew","Laura"];
        $username = ["johnsmith", "sarahjones", "mikedavis", "lisawilson", "robertbrown", "emilythomas", "davidmiller", "jenniferlee", "andrewrobinson", "laurawhite"];
        $email  = [
            "john.smith@example.com", "sarah.jones@email.com", "mike.davis@example.com", "lisa.wilson@email.com",
            "robert.brown@example.com", "emily.thomas@email.com", "david.miller@example.com",
            "jennifer.lee@email.com", "andrew.robinson@example.com", "laura.white@email.com"
        ];
        $role = ['owner', 'staff', 'staff', 'staff', 'staff', 'buyer', 'buyer', 'buyer', 'buyer', 'buyer'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $name[$i],
                'username' => $username[$i],
                'email' => $email[$i],
                'password' => $username[$i],
                'role' => $role[$i],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
