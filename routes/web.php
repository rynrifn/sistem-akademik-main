<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes (dari Laravel Breeze/Jetstream)
require __DIR__ . '/auth.php';

// Proteksi semua halaman yang memerlukan login
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Resources (tanpa show)
    Route::resource('jurusan', JurusanController::class)->except(['show']);
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
    Route::resource('matakuliah', MatakuliahController::class)->except(['show']);

    // ========== EXPORT ROUTES ==========
    
    // Export untuk Mahasiswa
    Route::get('/mahasiswa/export-csv', [MahasiswaController::class, 'exportCsv'])->name('mahasiswa.export-csv');
    Route::get('/mahasiswa/print', [MahasiswaController::class, 'print'])->name('mahasiswa.print');
    
    // Export untuk Jurusan
    Route::get('/jurusan/export-csv', [JurusanController::class, 'exportCsv'])->name('jurusan.export-csv');
    Route::get('/jurusan/print', [JurusanController::class, 'print'])->name('jurusan.print');
    Route::get('/jurusan/export-excel', [JurusanController::class, 'exportExcel'])->name('jurusan.export-excel');
    
    // Export untuk Matakuliah
    Route::get('/matakuliah/export-csv', [MatakuliahController::class, 'exportCsv'])->name('matakuliah.export-csv');
    Route::get('/matakuliah/print', [MatakuliahController::class, 'print'])->name('matakuliah.print');
    Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportExcel'])->name('matakuliah.export-excel');
});