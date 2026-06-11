<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/jadwal-shalat', [PublicController::class, 'jadwalShalat'])->name('jadwal-shalat');
Route::get('/donasi', [PublicController::class, 'donasi'])->name('donasi');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
