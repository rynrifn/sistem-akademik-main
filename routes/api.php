<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaApi;

Route::get('/mahasiswa', [MahasiswaApi::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaApi::class, 'show']);
Route::post('/mahasiswa', [MahasiswaApi::class, 'store']);
Route::put('/mahasiswa/{id}', [MahasiswaApi::class, 'update']);
Route::delete('/mahasiswa/{id}', [MahasiswaApi::class, 'destroy']);