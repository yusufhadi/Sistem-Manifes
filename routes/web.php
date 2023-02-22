<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TiketPenumpangController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/daftar-manifes-penumpang', [TiketPenumpangController::class, 'index'])->name('manifes-penumpang');
    Route::get('/tiket-penumpang', [TiketPenumpangController::class, 'create'])->name('tiket-penumpang');
    Route::post('/tiket-penumpang', [TiketPenumpangController::class, 'store'])->name('tambah-tiket-penumpang');
    Route::put('/tiket-penumpang/{id}', [TiketPenumpangController::class, 'update'])->name('update-tiket-penumpang');
    Route::get('/tiket-penumpang/delete/{id}', [TiketPenumpangController::class, 'destroy'])->name('delete-tiket-penumpang');
    Route::get('/download-penumpang/{id}', [TiketPenumpangController::class, 'downloadPdf'])->name('download-penumpang');

    Route::get('/daftar-manifes-kendaraan', [KendaraanController::class, 'index'])->name('manifes-kendaraan');
    Route::get('/tiket-kendaraan', [KendaraanController::class, 'create'])->name('kendaraan');
    Route::post('/tiket-kendaraan', [KendaraanController::class, 'store'])->name('tambah-kendaraan');
    Route::put('/tiket-kendaraan/{id}', [KendaraanController::class, 'update'])->name('update-kendaraan');
    Route::get('/tiket-kendaraan/delete/{id}', [KendaraanController::class, 'destroy'])->name('delete-kendaraan');
    Route::get('/download-tiket/{id}', [KendaraanController::class, 'downloadPdf'])->name('download-kendaraan');

    Route::post('/logout', [LoginController::class, 'keluar'])->name('keluar');

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
        Route::post('/jadwal', [JadwalController::class, 'store'])->name('tambah-jadwal');
        Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('update-jadwal');
        Route::get('/jadwal/delete/{id}', [JadwalController::class, 'destroy'])->name('delete-jadwal');

        Route::post('/user', [UserController::class, 'store'])->name('tambah-user');
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('update-user');
        Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('delete-user');
    });
});
