<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            // 🍚 Karbohidrat (category_id = 1)
            ['name' => 'Nasi Putih', 'calories' => 200, 'category_id' => 1],
            ['name' => 'Roti Gandum', 'calories' => 150, 'category_id' => 1],
            ['name' => 'Mie Goreng', 'calories' => 400, 'category_id' => 1],
            ['name' => 'Kentang Rebus', 'calories' => 80, 'category_id' => 1],
            ['name' => 'Jagung Manis', 'calories' => 96, 'category_id' => 1],

            // 🍗 Protein (category_id = 2)
            ['name' => 'Ayam Panggang', 'calories' => 250, 'category_id' => 2],
            ['name' => 'Telur Rebus', 'calories' => 70, 'category_id' => 2],
            ['name' => 'Daging Sapi Lada Hitam', 'calories' => 300, 'category_id' => 2],
            ['name' => 'Ikan Salmon', 'calories' => 350, 'category_id' => 2],
            ['name' => 'Tempe Goreng', 'calories' => 150, 'category_id' => 2],

            // 🥦 Sayur (category_id = 3)
            ['name' => 'Brokoli Rebus', 'calories' => 55, 'category_id' => 3],
            ['name' => 'Bayam Tumis', 'calories' => 40, 'category_id' => 3],
            ['name' => 'Wortel Kukus', 'calories' => 30, 'category_id' => 3],
            ['name' => 'Kangkung Cah Bawang Putih', 'calories' => 45, 'category_id' => 3],
            ['name' => 'Sawi Putih', 'calories' => 20, 'category_id' => 3],

            // 🍎 Buah (category_id = 4)
            ['name' => 'Apel Merah', 'calories' => 80, 'category_id' => 4],
            ['name' => 'Pisang Ambon', 'calories' => 90, 'category_id' => 4],
            ['name' => 'Mangga Harum Manis', 'calories' => 60, 'category_id' => 4],
            ['name' => 'Semangka Merah', 'calories' => 30, 'category_id' => 4],
            ['name' => 'Anggur Hijau', 'calories' => 50, 'category_id' => 4],

            // 🍹 Minuman Manis (category_id = 5)
            ['name' => 'Teh Manis', 'calories' => 90, 'category_id' => 5],
            ['name' => 'Es Kopi Susu', 'calories' => 180, 'category_id' => 5],
            ['name' => 'Jus Alpukat', 'calories' => 150, 'category_id' => 5],
            ['name' => 'Soda Lemon', 'calories' => 120, 'category_id' => 5],
            ['name' => 'Cokelat Panas', 'calories' => 200, 'category_id' => 5],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
