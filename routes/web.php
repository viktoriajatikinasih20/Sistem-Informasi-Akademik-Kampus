<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiDanTranskripController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AuthController;

/* Root diarahkan ke halaman login */
Route::get('/', function () {
    return redirect()->route('login');
});

/* Dashboard */
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

/* Resource CRUD */
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('matakuliah', MataKuliahController::class);

/* Nilai dan Transkrip */
Route::get('/nilaidantranskrip', [NilaiDanTranskripController::class, 'index'])->name('nilaidantranskrip.index');
Route::get('/nilaidantranskrip/permahasiswa', [NilaiDanTranskripController::class, 'perMahasiswa'])->name('nilaidantranskrip.permahasiswa');
Route::get('/nilaidantranskrip/create', [NilaiDanTranskripController::class, 'create'])->name('nilaidantranskrip.create');
Route::post('/nilaidantranskrip', [NilaiDanTranskripController::class, 'store'])->name('nilaidantranskrip.store');
Route::get('/nilaidantranskrip/export-pdf/{id}', [NilaiDanTranskripController::class, 'exportPDF'])->name('nilaidantranskrip.exportpdf');

/* Pengaturan */
Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
Route::post('/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');
Route::post('/pengaturan/akademik', [PengaturanController::class, 'updateTahunAkademik'])->name('pengaturan.akademik');
Route::post('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
Route::post('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');

/* Auth */
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
