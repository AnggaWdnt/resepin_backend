<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DailyLogController extends Controller
{
    /**
     * ✅ Menampilkan semua log harian milik user
     */
    public function index(Request $request)
    {
        try {
            $logs = $request->user()
                            ->dailyLogs()
                            ->with('food') // ambil relasi food biar ada data makanan
                            ->latest()
                            ->get();

            return response()->json([
                'status' => 'success',
                'data'   => $logs
            ]);
        } catch (\Exception $e) {
            Log::error("🔥 DailyLogController@index error: " . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal memuat log harian.'
            ], 500);
        }
    }

    /**
     * ✅ Menyimpan log harian baru (dengan auto match food & auto detect unit)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'food_name' => 'required|string|max:255', // user wajib input nama makanan
                'calories'  => 'nullable|numeric|min:0',  // opsional, kalau makanan tidak ada di DB
                'portion'   => 'required|numeric|min:1',
                'unit'      => 'nullable|string|max:10', // user boleh input unit (gram/ml/pcs)
                'photo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = $request->user();

            // 🔥 Auto match nama makanan ke database
            $food = Food::where('name', 'like', '%' . $validated['food_name'] . '%')->first();

            if ($food) {
                // Jika ada di database
                $foodId = $food->id;
                $foodName = $food->name;
                $kaloriPerPorsi = $food->calories;

                // ✅ Ambil unit dari DB kalau ada, kalau tidak tebak
                $unit = $food->unit ?? $this->guessUnitFromName($foodName);
            } else {
                // Jika tidak ada → pastikan kalori diisi
                if (empty($validated['calories'])) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Kalori wajib diisi karena makanan tidak ada di database.'
                    ], 422);
                }
                $foodId = null;
                $foodName = $validated['food_name'];
                $kaloriPerPorsi = $validated['calories'];
                $unit = $validated['unit'] ?? $this->guessUnitFromName($foodName);
            }

            $totalKalori = $kaloriPerPorsi * $validated['portion'];

            // 📸 Upload foto jika ada
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('daily_logs', 'public');
            }

            // 💾 Simpan log harian
            $log = $user->dailyLogs()->create([
                'food_id'    => $foodId,
                'food_name'  => $foodName,
                'portion'    => $validated['portion'],
                'unit'       => $unit,
                'kalori'     => $totalKalori,
                'photo'      => $photoPath,
                'date'       => now()->toDateString(),
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Log harian berhasil ditambahkan',
                'data'    => $log
            ], 201);
        } catch (\Exception $e) {
            Log::error("🔥 DailyLogController@store error: " . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menyimpan log harian. Cek log server.'
            ], 500);
        }
    }

    /**
     * ✅ Menampilkan detail log harian
     */
    public function show(DailyLog $dailyLog)
    {
        try {
            $dailyLog->load('food'); // Tambahkan data food jika ada
            return response()->json([
                'status' => 'success',
                'data'   => $dailyLog
            ]);
        } catch (\Exception $e) {
            Log::error("🔥 DailyLogController@show error: " . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal memuat detail log.'
            ], 500);
        }
    }

    /**
     * ✅ Menghapus log harian
     */
    public function destroy(DailyLog $dailyLog)
    {
        try {
            if ($dailyLog->photo) {
                Storage::disk('public')->delete($dailyLog->photo);
            }

            $dailyLog->delete();

            return response()->json([
                'status'  => 'success',
                'message' => 'Log harian berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error("🔥 DailyLogController@destroy error: " . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menghapus log harian.'
            ], 500);
        }
    }

    /**
     * 🧠 Fungsi bantu untuk tebak unit dari nama makanan/minuman
     */
    private function guessUnitFromName($foodName)
    {
        $name = strtolower($foodName);

        if (str_contains($name, 'soup') || str_contains($name, 'milk') || str_contains($name, 'tea') || str_contains($name, 'coffee') || str_contains($name, 'juice') || str_contains($name, 'water')) {
            return 'ml'; // ✅ minuman atau cairan
        }

        if (str_contains($name, 'slice') || str_contains($name, 'piece') || str_contains($name, 'cup')) {
            return 'pcs'; // ✅ potongan atau cup
        }

        return 'gram'; // ✅ default untuk makanan padat
    }
}
