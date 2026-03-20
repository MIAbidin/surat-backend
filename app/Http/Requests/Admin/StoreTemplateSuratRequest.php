<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateSuratRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'konten_html'    => 'required|string',
            'variabel_list'  => 'nullable|array',
        ];
    }
}