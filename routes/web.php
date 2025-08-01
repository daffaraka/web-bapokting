<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UPTDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\HargaMonitoringController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::view('layout', 'dashboard.layouts.layout');
Route::view('base-layout', 'dashboard.layouts.base-view');


Route::resource('komoditas', KomoditasController::class);
Route::resource('pasar', PasarController::class);
Route::resource('uptd', UPTDController::class);
Route::resource('user', UserController::class);
Route::resource('harga-monitoring', HargaMonitoringController::class);
