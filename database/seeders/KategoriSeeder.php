<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            'nama_kategori' => 'Pendidikan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => 'Sosial',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => 'Kesehatan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
