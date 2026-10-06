<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BukuController;

// Route untuk CORS Preflight (OPTIONS)
Route::options('/{any}', function () {
    return response()->json([], 200);
})->where('any', '.*');

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', function (Request $request) {
        return response()->json(['status' => 'success', 'data' => $request->user()]);
    });
    Route::apiResource('products', ProductController::class);
    Route::apiResource('books', BukuController::class);
});