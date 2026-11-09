<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Halaman Publik (Bisa diakses tanpa login)
Route::get('/', [PageController::class, 'landing'])->name('landing');

// Autentikasi (Hanya untuk yang belum login)
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', [PageController::class, 'loginPage'])->name('login');
    Route::post('/login', 'login');
    
    Route::get('/daftar', [PageController::class, 'registerPage'])->name('register');
    Route::post('/daftar', 'register');
});

// Halaman Privat (Membutuhkan login)
Route::controller(PageController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');