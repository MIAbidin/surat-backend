<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)
                    ->with('unitKerja')
                    ->first();

        // Validasi kredensial
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah.'
            ], 401);
        }

        // Cek status aktif
        if (!$user->is_aktif) {
            return response()->json([
                'message' => 'Akun Anda tidak aktif. Hubungi administrator.'
            ], 403);
        }

        // Hapus token lama (opsional — satu session saja)
        $user->tokens()->delete();

        // Buat token baru
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'token'   => $token,
            'user'    => [
                'id'          => $user->id,
                'name'        => $user->name,
                'email'       => $user->email,
                'nim'         => $user->nim,
                'nidn'        => $user->nidn,
                'role'        => $user->role,
                'unit_kerja'  => $user->unitKerja,
                'foto_ttd_url'=> $user->foto_ttd_url,
            ],
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user()->load('unitKerja');

        return response()->json([
            'id'          => $user->id,
            'name'        => $user->name,
            'email'       => $user->email,
            'nim'         => $user->nim,
            'nidn'        => $user->nidn,
            'role'        => $user->role,
            'unit_kerja'  => $user->unitKerja,
            'foto_ttd_url'=> $user->foto_ttd_url,
            'is_aktif'    => $user->is_aktif,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil.']);
    }
}