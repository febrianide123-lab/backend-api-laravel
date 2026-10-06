<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BukuController;

// ==========================================
// PUBLIC ROUTES (Bisa diakses tanpa login)
// ==========================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ==========================================
// PROTECTED ROUTES (Harus login untuk akses)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    });

    // Product Routes (Terlindungi)
    Route::apiResource('products', ProductController::class);
    
    // Buku Routes (Terlindungi)
    Route::apiResource('books', BukuController::class);
});