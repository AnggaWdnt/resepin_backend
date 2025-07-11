<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\Food;
use Illuminate\Http\Request;

class DailyLogController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->dailyLogs()->with('food')->orderBy('date', 'desc')->get()
        );
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'food_name' => 'required|string|max:255',
        'portion'   => 'required|numeric|min:0.1',
        'date'      => 'required|date',
    ]);

    $log = $request->user()->dailyLogs()->create([
        'food_name' => $validated['food_name'],
        'portion'   => $validated['portion'],
        'date'      => $validated['date'],
    ]);

    return response()->json(['message' => 'Log berhasil ditambahkan', 'log' => $log], 201);
}


    public function update(Request $request, $id)
    {
        $log = DailyLog::find($id);

        if (!$log || $log->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Log tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'portion' => 'required|numeric|min:0.1',
            'date' => 'required|date',
        ]);

        $log->update($validated);

        return response()->json([
            'message' => 'Log berhasil diupdate',
            'log' => $log->load('food')
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $log = DailyLog::find($id);

        if (!$log || $log->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Log tidak ditemukan'], 404);
        }

        $log->delete();

        return response()->json(['message' => 'Log berhasil dihapus']);
    }
}
