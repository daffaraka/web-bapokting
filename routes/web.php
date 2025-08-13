<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UPTDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontpage\FrontPageController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\HargaMonitoringController;
use App\Http\Controllers\JenisKomoditasController;
use App\Http\Controllers\PerkembanganHargaController;
use App\Models\JenisKomoditas;

Route::get('/', [FrontPageController::class, 'index'])->name('frontpage');




require __DIR__ . '/auth.php';



Route::view('layout', 'dashboard.layouts.layout');
Route::view('base-layout', 'dashboard.layouts.base-view');

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('komoditas', KomoditasController::class)->parameters(['komoditas' => 'komoditas']);
    Route::resource('jenis-komoditas', JenisKomoditasController::class)->parameters(['jenis-komoditas' => 'jenis-komoditas']);
    Route::resource('pasar', PasarController::class);
    Route::resource('uptd', UPTDController::class);
    Route::resource('user', UserController::class);
    Route::resource('harga-monitoring', HargaMonitoringController::class);

    Route::resource('perkembangan-harga', PerkembanganHargaController::class);

    Route::resource('berita',BeritaController::class);
});
