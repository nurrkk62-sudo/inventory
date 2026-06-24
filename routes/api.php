<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
Route::delete('/v1/items/{id}', [ItemController::class, 'destroy']);
Route::delete('/v1/categories/{id}', [CategoryController::class, 'destroy']);

// Rute Publik (Otomatis menjadi api/v1/register)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rute Terproteksi Token
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('categories', CategoryController::class)->except(['destroy']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('role:admin');

    Route::apiResource('items', ItemController::class)->except(['destroy']);
    Route::delete('items/{item}', [ItemController::class, 'destroy'])->middleware('role:admin');

    Route::prefix('v1')->middleware([
    'auth:sanctum',
    'throttle:60,1'
])->group(function () {

});

});