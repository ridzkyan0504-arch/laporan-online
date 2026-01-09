<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanOnlineController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ================= AUTH =================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ================= AUTHENTICATED =================
Route::middleware('auth:sanctum')->group(function () {

    // auth
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // laporan (SEMUA USER LOGIN)
    Route::get('/laporan-online', [LaporanOnlineController::class, 'index']);
    Route::post('/laporan-online', [LaporanOnlineController::class, 'store']);
    Route::get('/laporan-online/{id}', [LaporanOnlineController::class, 'show']);

    // ================= ADMIN ONLY =================
        Route::put('/laporan-online/{id}', [LaporanOnlineController::class, 'update']);
        Route::delete('/laporan-online/{id}', [LaporanOnlineController::class, 'destroy']);
    });
