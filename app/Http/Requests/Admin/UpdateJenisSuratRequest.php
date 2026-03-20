<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisSuratRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('jenis_surat');
        return [
            'nama'          => 'sometimes|required|string|max:100',
            'kode'          => "sometimes|required|string|max:20|unique:jenis_surat,kode,{$id}",
            'deskripsi'     => 'nullable|string',
            'role_pemohon'  => 'sometimes|required|in:mahasiswa,dosen,semua',
            'penandatangan' => 'sometimes|required|in:kaprodi,wadek,dekan',
            'sla_hari'      => 'sometimes|required|integer|min:1|max:30',
            'persyaratan'   => 'nullable|array',
            'field_form'    => 'nullable|array',
            'is_aktif'      => 'boolean',
        ];
    }
}