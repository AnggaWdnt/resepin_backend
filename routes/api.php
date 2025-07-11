<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DailyLogController;
use Illuminate\Support\Facades\Route;

// ✅ Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ✅ Public routes (tanpa login)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/foods', [FoodController::class, 'index']); // 🔥 Tambah filter ?category_id
Route::get('/foods/{id}', [FoodController::class, 'show']);

// ✅ Protected routes (requires login)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ CRUD Foods
    Route::post('/foods', [FoodController::class, 'store']);
    Route::put('/foods/{id}', [FoodController::class, 'update']);
    Route::delete('/foods/{id}', [FoodController::class, 'destroy']);

    // ✅ Recipes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/recipes', [RecipeController::class, 'index']);
        Route::get('/recipes/{id}', [RecipeController::class, 'show']);
        Route::post('/recipes', [RecipeController::class, 'store']);
        Route::put('/recipes/{id}', [RecipeController::class, 'update']);
        Route::delete('/recipes/{id}', [RecipeController::class, 'destroy']);
    });
    

    // ✅ CRUD Daily Logs
    Route::get('/daily-logs', [DailyLogController::class, 'index']);
    Route::post('/daily-logs', [DailyLogController::class, 'store']);
    Route::put('/daily-logs/{id}', [DailyLogController::class, 'update']);
    Route::delete('/daily-logs/{id}', [DailyLogController::class, 'destroy']);
    Route::apiResource('daily-logs', DailyLogController::class);

});
