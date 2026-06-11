<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/jadwal-shalat', [PublicController::class, 'jadwalShalat'])->name('jadwal-shalat');
Route::get('/donasi', [PublicController::class, 'donasi'])->name('donasi');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [PublicController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('kegiatan');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/streaming', [PublicController::class, 'streaming'])->name('streaming');
