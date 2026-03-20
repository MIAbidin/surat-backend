<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\TemplateSuratController;
use Illuminate\Support\Facades\Route;

// ── Public ─────────────────────────────────────────────────────
Route::post('/auth/login', [AuthController::class, 'login']);

// ── Protected ──────────────────────────────────────────────────
Route::middleware(['auth:sanctum', 'user.aktif'])->group(function () {

    // Auth
    Route::get('/auth/me',      [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Jenis surat — semua user login bisa akses (untuk form pengajuan)
    Route::get('/jenis-surat',      [JenisSuratController::class, 'index']);
    Route::get('/jenis-surat/{jenis_surat}', [JenisSuratController::class, 'show']);

    // ── Admin only ─────────────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        // Jenis surat — CRUD (index khusus admin = semua termasuk nonaktif)
        Route::get('/jenis-surat',   [JenisSuratController::class, 'indexAdmin']);
        Route::post('/jenis-surat',  [JenisSuratController::class, 'store']);
        Route::put('/jenis-surat/{jenis_surat}',    [JenisSuratController::class, 'update']);
        Route::delete('/jenis-surat/{jenis_surat}', [JenisSuratController::class, 'destroy']);

        // Template surat — CRUD
        Route::apiResource('template-surat', TemplateSuratController::class);
    });

    // ── TU ─────────────────────────────────────────────────────
    Route::middleware('role:tu')->prefix('tu')->group(function () {
        // akan diisi fase 4
    });

    // ── Pejabat ────────────────────────────────────────────────
    Route::middleware('role:kaprodi,wadek,dekan')->prefix('pejabat')->group(function () {
        // akan diisi fase 5
    });

    // ── Pemohon ────────────────────────────────────────────────
    Route::middleware('role:mahasiswa,dosen')->prefix('pemohon')->group(function () {
        // akan diisi fase 3
    });
});