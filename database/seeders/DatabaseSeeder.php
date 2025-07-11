<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder kategori dan makanan
        $this->call([
            CategorySeeder::class,
            FoodSeeder::class,
        ]);

        // (Opsional) User dummy untuk testing login API
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
