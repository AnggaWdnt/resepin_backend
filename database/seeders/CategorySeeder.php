<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Karbohidrat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Protein', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sayur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Buah', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Minuman Manis', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
