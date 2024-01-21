<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MahasiswaController::class, 'welcome'])->name('welcome');

Route::get('/detailJenisAlat/{id}', [MahasiswaController::class, 'detailJenisAlat'])->name('detailJenisAlat');

Route::get('/detailAlat/{id}', [MahasiswaController::class, 'detailAlat'])->name('detailAlat');
Route::get('/pinjamAlat/{id}', [MahasiswaController::class, 'pinjamAlat'])->name('pinjamAlat');

Route::get('/changeJamMulai/{alat}/{date}', [MahasiswaController::class, 'changeJamMulai'])->name('changeJamMulai');
Route::get('/changeJamSelesai/{alat}/{date}/{jamMulai}', [MahasiswaController::class, 'changeJamSelesai'])->name('changeJamSelesai');

Route::post('/simpanPinjamAlat', [MahasiswaController::class, 'simpanPinjamAlat'])->name('simpanPinjamAlat');

Route::middleware(['auth'])->group(function () {
  Route::get('/home', [AdminController::class, 'home'])->name('home');

  Route::get('/tambahJenisAlat', [AdminController::class, 'tambahJenisAlat'])->name('tambahJenisAlat');
  Route::post('/simpanTambahJenisAlat', [AdminController::class, 'simpanTambahJenisAlat'])->name('simpanTambahJenisAlat');

  Route::get('/ubahJenisAlat/{id}', [AdminController::class, 'ubahJenisAlat'])->name('ubahJenisAlat');
  Route::post('/ubahGambarJenisAlat', [AdminController::class, 'ubahGambarJenisAlat'])->name('ubahGambarJenisAlat');
  Route::post('/simpanUbahJenisAlat', [AdminController::class, 'simpanUbahJenisAlat'])->name('simpanUbahJenisAlat');

  Route::post('/tambahAlat', [AdminController::class, 'tambahAlat'])->name('tambahAlat');

  Route::get('/hapusRiwayat/{id}', [AdminController::class, 'hapusRiwayat'])->name('hapusRiwayat');
  Route::get('/hapusAlat/{id}', [AdminController::class, 'hapusAlat'])->name('hapusAlat');
  Route::get('/hapusJenisAlat/{id}', [AdminController::class, 'hapusJenisAlat'])->name('hapusJenisAlat');


  Route::get('/changeJamSelesaiAdmin/{alat}/{date}/{jamMulai}', [AdminController::class, 'changeJamSelesaiAdmin'])->name('changeJamSelesaiAdmin');
  Route::post('/simpanPinjamAlatAdmin', [AdminController::class, 'simpanPinjamAlatAdmin'])->name('simpanPinjamAlatAdmin');
});

Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
