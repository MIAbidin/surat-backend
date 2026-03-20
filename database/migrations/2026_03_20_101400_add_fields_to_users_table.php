<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable()->unique()->after('name');
            $table->string('nidn')->nullable()->unique()->after('nim');
            $table->enum('role', [
                'mahasiswa', 'dosen', 'tu', 'kaprodi', 'wadek', 'dekan', 'admin'
            ])->default('mahasiswa')->after('nidn');
            $table->foreignId('unit_kerja_id')
                  ->nullable()
                  ->constrained('unit_kerja')
                  ->nullOnDelete()
                  ->after('role');
            $table->string('foto_ttd')->nullable()->after('unit_kerja_id');
            $table->boolean('is_aktif')->default(true)->after('foto_ttd');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('unit_kerja_id');
            $table->dropColumn(['nim', 'nidn', 'role', 'foto_ttd', 'is_aktif']);
        });
    }
};