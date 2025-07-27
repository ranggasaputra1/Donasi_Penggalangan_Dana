<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'role' => 0,
            'email' => 'admin@gmail.com',
            'phone_number' => '62',
            'password' => bcrypt('admin1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Donatur',
            'role' => 1,
            'email' => 'donatur@gmail.com',
            'phone_number' => '62',
            'password' => bcrypt('donatur1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Penggalang Dana',
            'role' => 2,
            'email' => 'penggalangdana@gmail.com',
            'phone_number' => '62',
            'password' => bcrypt('penggalangdana1234'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
