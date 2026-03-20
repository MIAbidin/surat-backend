<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJenisSuratRequest;
use App\Http\Requests\Admin\UpdateJenisSuratRequest;
use App\Models\JenisSurat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    // GET /api/jenis-surat — untuk semua user login (dropdown pengajuan)
    public function index(Request $request): JsonResponse
    {
        $query = JenisSurat::with('template')->aktif();

        // Filter berdasarkan role pemohon yang login
        if ($request->user()) {
            $role = $request->user()->role;
            if (in_array($role, ['mahasiswa', 'dosen'])) {
                $query->untukRole($role);
            }
        }

        return response()->json($query->orderBy('nama')->get());
    }

    // GET /api/jenis-surat/{id}
    public function show(JenisSurat $jenisSurat): JsonResponse
    {
        return response()->json($jenisSurat->load('template'));
    }

    // POST /api/admin/jenis-surat
    public function store(StoreJenisSuratRequest $request): JsonResponse
    {
        $jenisSurat = JenisSurat::create($request->validated());

        return response()->json([
            'message' => 'Jenis surat berhasil ditambahkan.',
            'data'    => $jenisSurat,
        ], 201);
    }

    // PUT /api/admin/jenis-surat/{id}
    public function update(UpdateJenisSuratRequest $request, JenisSurat $jenisSurat): JsonResponse
    {
        $jenisSurat->update($request->validated());

        return response()->json([
            'message' => 'Jenis surat berhasil diperbarui.',
            'data'    => $jenisSurat->fresh('template'),
        ]);
    }

    // DELETE /api/admin/jenis-surat/{id}
    public function destroy(JenisSurat $jenisSurat): JsonResponse
    {
        // Soft delete — nonaktifkan saja, jangan hapus
        $jenisSurat->update(['is_aktif' => false]);

        return response()->json(['message' => 'Jenis surat dinonaktifkan.']);
    }

    // GET /api/admin/jenis-surat — semua termasuk nonaktif (untuk admin)
    public function indexAdmin(): JsonResponse
    {
        $data = JenisSurat::with('template')
                          ->orderBy('role_pemohon')
                          ->orderBy('nama')
                          ->get();

        return response()->json($data);
    }
}