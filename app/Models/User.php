<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'nim', 'nidn', 'role',
        'unit_kerja_id', 'foto_ttd', 'is_aktif',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_aktif'          => 'boolean',
    ];

    // Relasi ke unit kerja
    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    // Helper: cek role
    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isTU(): bool        { return $this->role === 'tu'; }
    public function isMahasiswa(): bool { return $this->role === 'mahasiswa'; }
    public function isDosen(): bool     { return $this->role === 'dosen'; }
    public function isPejabat(): bool
    {
        return in_array($this->role, ['kaprodi', 'wadek', 'dekan']);
    }

    // Ambil URL foto TTD
    public function getFotoTtdUrlAttribute(): ?string
    {
        return $this->foto_ttd
            ? asset('storage/' . $this->foto_ttd)
            : null;
    }
}