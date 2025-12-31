<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\PenilaianLayananController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/anggota', function () {
    return view('anggota');
   });
Route::get('/ketua', function () {
    return view('ketua');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

//kategori pengaduan
Route::resource('kategori', KategoriController::class);
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

//Data Pengaduan
// Pengaduan (semua user bisa lihat, tambah, edit sesuai kebutuhan)
Route::resource('pengaduan', PengaduanController::class)
    ->except(['destroy']);
// HAPUS PENGADUAN — ADMIN ONLY
Route::delete('pengaduan/{pengaduan}', 
    [PengaduanController::class, 'destroy']
)->middleware('checkrole:admin')
 ->name('pengaduan.destroy');
// Tambahan routes untuk upload file - ROUTE BARU 
Route::get('pengaduan/{pengaduan}/show', [PengaduanController::class, 'show'])->name('pengaduan.show'); 
Route::post('pengaduan/{pengaduan}/upload-files', [PengaduanController::class, 'uploadFiles'])->name('pengaduan.upload-files'); 
Route::delete('pengaduan/{pengaduan}/files/{file}', [PengaduanController::class, 'deleteFile'])->name('pengaduan.delete-file'); 

//Tindak Lanjut
Route::resource('tindaklanjut', TindakLanjutController::class);
// Tambahan routes untuk upload file - ROUTE BARU 
Route::get('tindaklanjut/{tindaklanjut}/show', [TindakLanjutController::class, 'show'])->name('tindaklanjut.show'); 
Route::post('tindaklanjut/{tindaklanjut}/upload-files', [TindakLanjutController::class, 'uploadFiles'])->name('tindaklanjut.upload-files'); 
Route::delete('tindaklanjut/{tindaklanjut}/files/{file}', [TindakLanjutController::class, 'deleteFile'])->name('tindaklanjut.delete-file'); 

//Penilaian Layanan
Route::resource('penilaianlayanan', PenilaianLayananController::class);

//user
Route::resource('user', UserController::class);

//warga
Route::resource('warga', WargaController::class);

// Tambahan routes untuk upload file - ROUTE BARU 
Route::get('warga/{warga}/show', [WargaController::class, 'show'])->name('warga.show'); 
Route::post('warga/{warga}/upload-files', [WargaController::class, 'uploadFiles'])->name('warga.upload-files'); 
Route::delete('warga/{warga}/files/{file}', [WargaController::class, 'deleteFile'])->name('warga.delete-file'); 

//Route::resource('auth', AuthController::class);
Route::get('auth', [AuthController::class, 'index'])->name('auth');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

//middleware role admin untuk user
Route::group(['middleware' => ['checkrole:admin']], function () {
  Route::get('user', [UserController::class, 'index'])->name('user.index');
});

//register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

//auto dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');