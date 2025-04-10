<?php

use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KueController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route  kategori
Route::resource('kategori', KategoriController::class)->except(['store']);
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');

// Route  dashboard dan kue
Route::get('/dashboard', [KueController::class, 'index'])->name('dashboard');
Route::resource('kue', KueController::class);
Route::post('/kue', [KueController::class, 'store'])->name('kue.store')->middleware('auth');

// Route  pelanggan
Route::resource('pelanggan', controller: PelangganController::class);
Route::post('pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');

// Route  transaksi
Route::resource('transaksi', controller: TransaksiController::class);
Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}/detail', [DetailTransaksiController::class, 'showDetailTransaksi'])->name('transaksi.detail');
Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

// Route::resource('transaksi', controller: DetailTransaksiController::class);


require __DIR__.'/auth.php';
