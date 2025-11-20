<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::redirect('/', '/admin');

Route::get('/api/tower-locations', [MapController::class, 'towerLocations'])->name('api.tower-locations');

// Route::get('/buat-admin', function () {
//     try {
//         // Cek apakah user sudah ada biar tidak duplikat
//         $email = 'admin@gmail.com'; // Ganti dengan email kamu
        
//         $user = User::where('email', $email)->first();
        
//         if ($user) {
//             return "User dengan email ini sudah ada! Password tidak diubah.";
//         }

//         // Buat User Baru
//         User::create([
//             'name' => 'Super Admin',
//             'email' => $email,
//             'password' => Hash::make('password123'), // Password sementara
//             // 'email_verified_at' => now(), // Aktifkan baris ini jika butuh verifikasi email
//         ]);

//         return "Sukses! User admin berhasil dibuat. <br>Email: $email <br>Pass: password123";
        
//     } catch (\Exception $e) {
//         return "Gagal membuat user: " . $e->getMessage();
//     }
// });

// Route::get('/reset-password', function () {
//     // Pastikan email ini SAMA PERSIS dengan yang kamu pakai login
//     $email = 'admin@gmail.com'; 
    
//     $user = User::where('email', $email)->first();
    
//     if (!$user) {
//         return "User tidak ditemukan! Cek apakah emailnya benar?";
//     }

//     // Paksa ubah password
//     $user->password = Hash::make('password123');
//     $user->save();

//     return "<h1>Sukses!</h1> Password untuk <b>$email</b> berhasil di-reset.<br>Silakan login dengan password: <b>password123</b>";
// });

// Route::get('/super-fix', function () {
//     $email = 'admin@gmail.com'; // GANTI dengan email login kamu
//     $passwordBaru = 'password123';

//     try {
//         // 1. Bersihkan Cache (Wajib di Vercel)
//         Artisan::call('config:clear');
//         Artisan::call('cache:clear');
//         Artisan::call('view:clear');
        
//         // 2. Cari User
//         $user = User::where('email', $email)->first();
        
//         if (!$user) {
//             return "<h1>ERROR:</h1> User dengan email <b>$email</b> tidak ditemukan di database Supabase.";
//         }

//         // 3. Paksa Reset Password
//         $user->password = Hash::make($passwordBaru);
//         $user->save();

//         // 4. Tes Login Manual (Simulasi)
//         $loginCheck = Auth::attempt(['email' => $email, 'password' => $passwordBaru]);

//         if ($loginCheck) {
//             return "<h1>BERHASIL! ✅</h1>
//                     1. Cache sudah dibersihkan.<br>
//                     2. Password user <b>$email</b> sudah di-reset menjadi: <b>$passwordBaru</b><br>
//                     3. Tes Login sistem berhasil.<br><br>
//                     Silakan kembali ke halaman login dan masuk sekarang.";
//         } else {
//             return "<h1>GAGAL ❌</h1>
//                     Password sudah direset, tapi Auth::attempt tetap gagal. <br>
//                     Cek apakah kamu menggunakan Guard khusus (bukan 'web')?";
//         }

//     } catch (\Exception $e) {
//         return "Error System: " . $e->getMessage();
//     }
// });