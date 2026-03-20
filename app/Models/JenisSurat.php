<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'role_pemohon',
        'penandatangan',
        'sla_hari',
        'persyaratan',
        'field_form',
        'is_aktif',
    ];

    protected $casts = [
        'persyaratan' => 'array',
        'field_form'  => 'array',
        'is_aktif'    => 'boolean',
    ];

    // Relasi ke template
    public function template(): HasOne
    {
        return $this->hasOne(TemplateSurat::class)->where('is_aktif', true);
    }

    public function templates(): HasMany
    {
        return $this->hasMany(TemplateSurat::class);
    }

    public function permohonan(): HasMany
    {
        return $this->hasMany(Permohonan::class);
    }

    // Scope: hanya yang aktif
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    // Scope: filter berdasarkan role pemohon
    public function scopeUntukRole($query, string $role)
    {
        return $query->where(function ($q) use ($role) {
            $q->where('role_pemohon', $role)
              ->orWhere('role_pemohon', 'semua');
        });
    }
}