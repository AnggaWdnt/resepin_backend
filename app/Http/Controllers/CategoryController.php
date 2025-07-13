<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * ✅ Ambil semua kategori makanan
     */
    public function index()
    {
        // Ambil semua kategori dengan field id & name
        $categories = Category::select('id', 'name')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar kategori berhasil diambil',
            'data'    => $categories, // 🚨 PASTIKAN ini array
        ], 200);
    }
}
