<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

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

//warga
Route::resource('warga', WargaController::class);

// Tambahan routes untuk upload file - ROUTE BARU 
Route::get('warga/{warga}/show', [WargaController::class, 'show'])->name('warga.show'); 
Route::post('warga/{warga}/upload-files', [WargaController::class, 'uploadFiles'])->name('warga.upload-files'); 
Route::delete('warga/{warga}/files/{file}', [WargaController::class, 'deleteFile'])->name('warga.delete-file'); 

//p13
//Route::resource('auth', AuthController::class);
Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

//Route::group(['middleware' => ['checkrole:admin']], function () {
//  Route::get('user', [UserController::class, 'index'])->name('user.index');
//});