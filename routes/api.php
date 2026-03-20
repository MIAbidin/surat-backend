<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// ── Public routes (tanpa auth) ─────────────────────────
Route::post('/auth/login', [AuthController::class, 'login']);

// ── Protected routes (butuh login) ────────────────────
Route::middleware(['auth:sanctum', 'user.aktif'])->group(function () {

    // Auth
    Route::get('/auth/me',      [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // ── Admin only ─────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // akan diisi di fase berikutnya
    });

    // ── TU only ────────────────────────────────────────
    Route::middleware('role:tu')->prefix('tu')->group(function () {
        // akan diisi di fase berikutnya
    });

    // ── Pejabat only ───────────────────────────────────
    Route::middleware('role:kaprodi,wadek,dekan')->prefix('pejabat')->group(function () {
        // akan diisi di fase berikutnya
    });

    // ── Pemohon (mahasiswa & dosen) ────────────────────
    Route::middleware('role:mahasiswa,dosen')->prefix('pemohon')->group(function () {
        // akan diisi di fase berikutnya
    });
});