<?php

use App\Models\JenisKomoditas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UPTDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\JenisKomoditasController;
use App\Http\Controllers\HargaMonitoringController;
use App\Http\Controllers\ManajemenBeritaController;
use App\Http\Controllers\Frontpage\BeritaController;
use App\Http\Controllers\PerkembanganHargaController;
use App\Http\Controllers\Frontpage\FrontPageController;



// Base Layout
Route::view('layout', 'dashboard.layouts.layout');
Route::view('base-layout', 'dashboard.layouts.base-view');



// Front page
Route::get('/', [FrontPageController::class, 'index'])->name('frontpage');
Route::get('/berita', [FrontPageController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [FrontPageController::class, 'showBerita'])->name('frontpage.berita.show');
Route::prefix('komoditas')->group(function () {
    Route::get('/', [FrontPageController::class, 'komoditas'])->name('komoditas');
});

Route::get('profil-bapokting', [FrontPageController::class, 'profilBapokting'])->name('profil-bapokting');


// Dashboard
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('komoditas', KomoditasController::class)->parameters(['komoditas' => 'komoditas']);
    Route::resource('jenis-komoditas', JenisKomoditasController::class)->parameters(['jenis-komoditas' => 'jenis-komoditas']);
    Route::resource('pasar', PasarController::class);
    Route::resource('user-uptd', UPTDController::class);
    // Route::resource('user', UserController::class);
    Route::resource('harga-monitoring', HargaMonitoringController::class);

    Route::post('perkembangan-harga/download-file', [PerkembanganHargaController::class,'downloadFile'])->name('perkembangan-harga.download-file');
    Route::get('perkembangan-harga/export',[PerkembanganHargaController::class,'export'])->name('perkembangan-harga.export');
    Route::get('perkembangan-harga/print',[PerkembanganHargaController::class,'print'])->name('perkembangan-harga.print');
    Route::resource('perkembangan-harga', PerkembanganHargaController::class);

    Route::resource('berita', ManajemenBeritaController::class)->parameters(['berita' => 'berita']);
});



// Auth
require __DIR__ . '/auth.php';
