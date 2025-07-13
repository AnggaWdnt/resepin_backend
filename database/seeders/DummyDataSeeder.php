<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Food;
use App\Models\DailyLog;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ User dummy
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // password: password
        ]);

        {
            $this->call([
                DummyDataSeeder::class,
            ]);
        }


        // ✅ Categories dummy
        $minuman = Category::create(['name' => 'Minuman', 'description' => 'Kategori minuman']);
        $makanan = Category::create(['name' => 'Makanan', 'description' => 'Kategori makanan']);

        // ✅ Foods dummy
        $nasiGoreng = Food::create(['name' => 'Nasi Goreng', 'description' => 'Nasi dengan bumbu goreng', 'category_id' => $makanan->id]);
        $tehManis   = Food::create(['name' => 'Teh Manis', 'description' => 'Teh dengan gula', 'category_id' => $minuman->id]);
        $ayamBakar  = Food::create(['name' => 'Ayam Bakar', 'description' => 'Ayam dipanggang dengan bumbu', 'category_id' => $makanan->id]);

        // ✅ Daily Logs dummy
        DailyLog::create([
            'user_id'   => $user->id,
            'food_name' => 'Nasi Goreng',
            'portion'   => 250,
            'date'      => now()->toDateString(),
        ]);

        DailyLog::create([
            'user_id'   => $user->id,
            'food_name' => 'Teh Manis',
            'portion'   => 200,
            'date'      => now()->subDay()->toDateString(),
        ]);

        DailyLog::create([
            'user_id'   => $user->id,
            'food_name' => 'Ayam Bakar',
            'portion'   => 150,
            'date'      => now()->subDays(2)->toDateString(),
        ]);
    }
}
