<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateSurat extends Model
{
    protected $table = 'template_surat';

    protected $fillable = [
        'jenis_surat_id',
        'konten_html',
        'variabel_list',
        'is_aktif',
    ];

    protected $casts = [
        'variabel_list' => 'array',
        'is_aktif'      => 'boolean',
    ];

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }
}