<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TiketPenumpangController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('dashboard');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('tambah-jadwal');
Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('update-jadwal');
Route::get('/jadwal/delete/{id}', [JadwalController::class, 'destroy'])->name('delete-jadwal');

Route::get('/daftar-manifes-penumpang', [TiketPenumpangController::class, 'index'])->name('manifes-penumpang');
Route::get('/tiket-penumpang', [TiketPenumpangController::class, 'create'])->name('tiket-penumpang');
Route::post('/tiket-penumpang', [TiketPenumpangController::class, 'store'])->name('tambah-tiket-penumpang');
Route::put('/tiket-penumpang/{id}', [TiketPenumpangController::class, 'update'])->name('update-tiket-penumpang');
Route::get('/tiket-penumpang/delete/{id}', [TiketPenumpangController::class, 'destroy'])->name('delete-tiket-penumpang');

Route::get('/daftar-manifes-kendaraan', [KendaraanController::class, 'index'])->name('manifes-kendaraan');
Route::get('/tiket-kendaraan', [KendaraanController::class, 'create'])->name('kendaraan');
Route::post('/tiket-kendaraan', [KendaraanController::class, 'store'])->name('tambah-kendaraan');
Route::put('/tiket-kendaraan/{id}', [KendaraanController::class, 'update'])->name('update-kendaraan');
Route::get('/tiket-kendaraan/delete/{id}', [KendaraanController::class, 'destroy'])->name('delete-kendaraan');
