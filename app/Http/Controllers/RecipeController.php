<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        return response()->json(Recipe::with('user')->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'bahan' => 'required|array',
            'langkah_langkah' => 'required|array',
        ]);

        $recipe = Recipe::create(array_merge(
            $validated,
            ['user_id' => $request->user()->id]
        ));

        return response()->json([
            'message' => 'Resep berhasil ditambahkan',
            'data' => $recipe
        ], 201);
    }

    public function show($id)
{
    $recipe = Recipe::find($id);
    if (!$recipe) {
        return response()->json(['message' => 'Resep tidak ditemukan'], 404);
    }
    return response()->json($recipe); 
}


    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        if (!$recipe) {
            return response()->json(['message' => 'Resep tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'bahan' => 'required|array',
            'langkah_langkah' => 'required|array',
        ]);

        $recipe->update($validated);

        return response()->json([
            'message' => 'Resep berhasil diupdate',
            'data' => $recipe
        ]);
    }

    public function destroy($id)
{
    $recipe = Recipe::find($id);
    if (!$recipe) {
        return response()->json(['message' => 'Resep tidak ditemukan'], 404);
    }
    $recipe->delete();

    return response()->json(['message' => 'Resep berhasil dihapus']);
}

}
