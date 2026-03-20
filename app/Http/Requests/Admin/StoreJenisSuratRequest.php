<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenisSuratRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama'          => 'required|string|max:100',
            'kode'          => 'required|string|max:20|unique:jenis_surat,kode',
            'deskripsi'     => 'nullable|string',
            'role_pemohon'  => 'required|in:mahasiswa,dosen,semua',
            'penandatangan' => 'required|in:kaprodi,wadek,dekan',
            'sla_hari'      => 'required|integer|min:1|max:30',
            'persyaratan'   => 'nullable|array',
            'persyaratan.*' => 'string',
            'field_form'    => 'nullable|array',
            'is_aktif'      => 'boolean',
        ];
    }
}