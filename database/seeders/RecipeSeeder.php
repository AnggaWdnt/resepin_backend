<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama sebagai pembuat resep
        $user = User::first();

        if (!$user) {
            // Kalau belum ada user, buat dummy user
            $user = User::factory()->create([
                'name' => 'User Dummy',
                'email' => 'dummy@example.com',
                'password' => bcrypt('password'), // password = password
            ]);
        }

        // Tambahkan beberapa resep dummy
        Recipe::create([
            'judul' => 'Nasi Goreng Spesial',
            'deskripsi' => 'Nasi goreng dengan telur, ayam, dan sayuran.',
            'bahan' => [
                '2 piring nasi putih',
                '2 butir telur',
                '100 gram ayam suwir',
                '1 sdm kecap manis',
                '2 siung bawang putih (cincang)',
                '1 batang daun bawang (iris)'
            ],
            'langkah_langkah' => [
                'Tumis bawang putih hingga harum.',
                'Masukkan ayam suwir, aduk rata.',
                'Masukkan telur, orak-arik sampai matang.',
                'Masukkan nasi, kecap manis, dan bumbu lainnya.',
                'Aduk rata, masak hingga panas merata.',
                'Taburi daun bawang sebelum disajikan.'
            ],
            'user_id' => $user->id,
        ]);

        Recipe::create([
            'judul' => 'Sate Ayam Bumbu Kacang',
            'deskripsi' => 'Sate ayam dengan bumbu kacang gurih.',
            'bahan' => [
                '500 gram daging ayam fillet (potong dadu)',
                '10 tusuk sate',
                '100 gram kacang tanah (goreng dan haluskan)',
                '3 siung bawang putih',
                '2 sdm kecap manis',
                '1 sdm air jeruk nipis'
            ],
            'langkah_langkah' => [
                'Rendam ayam dengan kecap dan air jeruk selama 30 menit.',
                'Tumis bawang putih hingga harum, lalu campur dengan kacang tanah.',
                'Tusuk ayam ke tusuk sate.',
                'Bakar sate hingga matang sambil dioles bumbu kacang.',
                'Sajikan dengan lontong atau nasi.'
            ],
            'user_id' => $user->id,
        ]);

        Recipe::create([
            'judul' => 'Smoothie Pisang Stroberi',
            'deskripsi' => 'Minuman sehat dengan pisang, stroberi, dan yogurt.',
            'bahan' => [
                '1 buah pisang matang',
                '5 buah stroberi segar',
                '200 ml yogurt plain',
                '1 sdm madu (opsional)',
                'Beberapa es batu'
            ],
            'langkah_langkah' => [
                'Masukkan semua bahan ke blender.',
                'Blender hingga halus dan creamy.',
                'Tuang ke gelas dan sajikan dingin.'
            ],
            'user_id' => $user->id,
        ]);

        echo "✅ Dummy resep berhasil ditambahkan!\n";
    }
}
