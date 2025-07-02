<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiDanTranskripController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AuthController;

/* Beranda atau redirect ke data mahasiswa (atau bisa dashboard sesuai kebutuhan) */
Route::get('/', [MahasiswaController::class, 'index']);

/* Dashboard (hanya satu route bernama "dashboard") */
Route::get('/dashboard', [AdminController::class, 'index'])
      ->name('dashboard');

/* CRUD Resource untuk Mahasiswa & Mata Kuliah */
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('matakuliah', MataKuliahController::class);

/* Nilai dan Transkrip */
Route::get('/nilaidantranskrip', [NilaiDanTranskripController::class, 'index'])->name('nilaidantranskrip.index');
Route::get('/nilaidantranskrip/permahasiswa', [NilaiDanTranskripController::class, 'perMahasiswa'])->name('nilaidantranskrip.permahasiswa');
Route::get('/nilaidantranskrip/export-pdf/{id}', [NilaiDanTranskripController::class, 'exportPDF'])->name('nilaidantranskrip.exportpdf');

Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
Route::post('/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');
Route::post('/pengaturan/akademik', [PengaturanController::class, 'updateTahunAkademik'])->name('pengaturan.akademik');
Route::post('/pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
Route::post('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
