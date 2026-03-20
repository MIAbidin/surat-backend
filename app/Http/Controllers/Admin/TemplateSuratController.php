<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTemplateSuratRequest;
use App\Models\TemplateSurat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            TemplateSurat::with('jenisSurat')->get()
        );
    }

    public function show(TemplateSurat $templateSurat): JsonResponse
    {
        return response()->json($templateSurat->load('jenisSurat'));
    }

    public function store(StoreTemplateSuratRequest $request): JsonResponse
    {
        // Nonaktifkan template lama untuk jenis surat yang sama
        TemplateSurat::where('jenis_surat_id', $request->jenis_surat_id)
                     ->update(['is_aktif' => false]);

        // Ekstrak variabel dari konten HTML
        preg_match_all('/\{\{(\w+)\}\}/', $request->konten_html, $matches);
        $variabelList = array_unique($matches[1]);

        $template = TemplateSurat::create([
            ...$request->validated(),
            'variabel_list' => $variabelList,
            'is_aktif'      => true,
        ]);

        return response()->json([
            'message' => 'Template berhasil disimpan.',
            'data'    => $template,
        ], 201);
    }

    public function update(Request $request, TemplateSurat $templateSurat): JsonResponse
    {
        $request->validate(['konten_html' => 'required|string']);

        preg_match_all('/\{\{(\w+)\}\}/', $request->konten_html, $matches);

        $templateSurat->update([
            'konten_html'   => $request->konten_html,
            'variabel_list' => array_unique($matches[1]),
        ]);

        return response()->json([
            'message' => 'Template berhasil diperbarui.',
            'data'    => $templateSurat,
        ]);
    }

    public function destroy(TemplateSurat $templateSurat): JsonResponse
    {
        $templateSurat->delete();
        return response()->json(['message' => 'Template dihapus.']);
    }
}