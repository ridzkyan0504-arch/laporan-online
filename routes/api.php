<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanOnlineController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

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

    // ================= FOTO (protected) =================
    // Serve foto dari storage/app/private/public/foto (HANYA untuk user ter-autentikasi)
    Route::get('/foto/{filename}', function ($filename) {
        // cegah path-traversal
        if (Str::contains($filename, ['..', '/', '\\'])) {
            abort(400);
        }

        $path = storage_path('app/private/public/foto/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        // Response::file akan otomatis mengatur Content-Type
        return Response::file($path);
    });
});