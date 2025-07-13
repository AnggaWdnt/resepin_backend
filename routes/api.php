<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\DashboardController;

/**
 * 🔑 AUTH ROUTES
 * Register & Login (tidak butuh token)
 */
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

/**
 * 🌐 PUBLIC ROUTES
 * Bisa diakses tanpa login
 */
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
Route::get('/foods/{id}', [FoodController::class, 'show'])->name('foods.show');

/**
 * 🔒 PROTECTED ROUTES
 * Hanya untuk user dengan token Sanctum
 */
Route::middleware('auth:sanctum')->group(function () {

    // 👤 User Profile
    Route::get('/user', [AuthController::class, 'user'])->name('auth.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // 🍽️ FOODS CRUD (kecuali index & show sudah publik)
    Route::apiResource('foods', FoodController::class)
        ->except(['index', 'show'])
        ->names('foods');

    // 📖 RECIPES CRUD
    Route::apiResource('recipes', RecipeController::class)
        ->names('recipes');

    // 📝 DAILY LOGS CRUD
    Route::apiResource('daily-logs', DailyLogController::class)
        ->names('dailyLogs');

    // ✅ KALORI STATUS
    Route::get('/kalori/check', [DashboardController::class, 'checkKaloriSehat'])
        ->name('kalori.check');
});
