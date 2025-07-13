<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * ✅ Cek total kalori user hari ini + status sehat/kurang/kelebihan
     */
    public function checkKaloriSehat(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Hitung total kalori semua log hari ini
        $totalKalori = $user->dailyLogs()
            ->whereDate('created_at', now()->toDateString())
            ->sum('kalori');

        // Tentukan status
        $status = 'approve';
        $message = 'Kalori kamu hari ini sudah sehat 🎉';

        if ($totalKalori < 1500) {
            $status = 'kurang';
            $message = 'Kalori kamu masih kurang 😅';
        } elseif ($totalKalori > 2500) {
            $status = 'kelebihan';
            $message = 'Kalori kamu kelebihan 🚨';
        }

        return response()->json([
            'status'        => $status,
            'total_kalori'  => $totalKalori,
            'message'       => $message
        ]);
    }
}
