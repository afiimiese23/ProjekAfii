<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/anggota', function () {
    return view('anggota');
   });
Route::get('/ketua', function () {
    return view('ketua');
});

Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

//kategori pengaduan
Route::resource('kategori', KategoriController::class);
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

//user
Route::resource('user', UserController::class);

//p10 warga
Route::resource('warga', WargaController::class);
