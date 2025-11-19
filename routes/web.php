<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::redirect('/', '/admin');

Route::get('/api/tower-locations', [MapController::class, 'towerLocations'])->name('api.tower-locations');

Route::get('/buat-admin', function () {
    try {
        // Cek apakah user sudah ada biar tidak duplikat
        $email = 'admin@sistem-inventaris.com'; // Ganti dengan email kamu
        
        $user = User::where('email', $email)->first();
        
        if ($user) {
            return "User dengan email ini sudah ada! Password tidak diubah.";
        }

        // Buat User Baru
        User::create([
            'name' => 'Super Admin',
            'email' => $email,
            'password' => Hash::make('password123'), // Password sementara
            // 'email_verified_at' => now(), // Aktifkan baris ini jika butuh verifikasi email
        ]);

        return "Sukses! User admin berhasil dibuat. <br>Email: $email <br>Pass: password123";
        
    } catch (\Exception $e) {
        return "Gagal membuat user: " . $e->getMessage();
    }
});