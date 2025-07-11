<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            // Karbohidrat (category_id = 1)
            ['name' => 'Nasi Putih', 'calories' => 200, 'category_id' => 1],
            ['name' => 'Roti Gandum', 'calories' => 150, 'category_id' => 1],

            // Protein (category_id = 2)
            ['name' => 'Ayam Panggang', 'calories' => 250, 'category_id' => 2],
            ['name' => 'Tahu Goreng', 'calories' => 120, 'category_id' => 2],

            // Sayur (category_id = 3)
            ['name' => 'Brokoli Rebus', 'calories' => 55, 'category_id' => 3],

            // Buah (category_id = 4)
            ['name' => 'Apel Merah', 'calories' => 80, 'category_id' => 4],

            // Minuman Manis (category_id = 5)
            ['name' => 'Teh Manis', 'calories' => 90, 'category_id' => 5],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
