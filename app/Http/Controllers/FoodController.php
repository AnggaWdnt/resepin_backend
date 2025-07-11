<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FoodController extends Controller
{
    // ✅ Ambil semua makanan (opsional filter per kategori)
    public function index(Request $request)
    {
        try {

            $query = Food::with('category');
            if ($request->has('category_id')) {
                Log::info('Filter category_id: ' . $request->category_id);
                $foods = Food::where('category_id', $request->category_id)->get();
            } else {
                $foods = Food::all();
            }

            return response()->json($foods, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching foods: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // ✅ Ambil detail makanan
    public function show($id)
    {
        try {
            $food = Food::find($id);

            if (!$food) {
                return response()->json(['message' => 'Makanan tidak ditemukan'], 404);
            }

            return response()->json($food, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching food detail: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // ✅ Tambah makanan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'calories' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $food = Food::create($validated);
            return response()->json([
                'message' => 'Makanan berhasil ditambahkan',
                'data' => $food
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error adding food: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // ✅ Update makanan
    public function update(Request $request, $id)
    {
        $food = Food::find($id);

        if (!$food) {
            return response()->json(['message' => 'Makanan tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'calories' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $food->update($validated);
            return response()->json([
                'message' => 'Makanan berhasil diupdate',
                'data' => $food
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating food: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // ✅ Hapus makanan
    public function destroy($id)
    {
        $food = Food::find($id);

        if (!$food) {
            return response()->json(['message' => 'Makanan tidak ditemukan'], 404);
        }

        try {
            $food->delete();
            return response()->json(['message' => 'Makanan berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error deleting food: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
