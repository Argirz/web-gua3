<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BrosurController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FotoRumahController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\ProspekController as AdminProspekController;
use App\Http\Controllers\Admin\SerahTerimaController;
use App\Http\Controllers\Admin\TipeRumahController;
use App\Http\Controllers\Admin\UnitRumahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProspekController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/prospek', [ProspekController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('prospek.store');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('admin.login.proses');
});

Route::middleware(['auth', 'panel'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [\App\Http\Controllers\Admin\SearchController::class, 'index'])->name('search');

    Route::get('/prospek', [AdminProspekController::class, 'index'])->name('prospek.index');
    Route::get('/prospek/export', [AdminProspekController::class, 'export'])->name('prospek.export');
    Route::patch('/prospek/{prospek}/status', [AdminProspekController::class, 'ubahStatus'])->name('prospek.status');
    Route::delete('/prospek/{prospek}', [AdminProspekController::class, 'hapus'])->name('prospek.hapus');

    Route::get('/unit', [UnitRumahController::class, 'index'])->name('unit.index');
    Route::post('/unit', [UnitRumahController::class, 'simpan'])->name('unit.simpan');
    Route::patch('/unit/{unitRumah}/status', [UnitRumahController::class, 'ubahStatus'])->name('unit.status');
    Route::delete('/unit/{unitRumah}', [UnitRumahController::class, 'hapus'])->name('unit.hapus');

    Route::get('/tipe', [TipeRumahController::class, 'index'])->name('tipe.index');
    Route::get('/tipe/buat', [TipeRumahController::class, 'create'])->name('tipe.create');
    Route::post('/tipe', [TipeRumahController::class, 'simpan'])->name('tipe.simpan');
    Route::get('/tipe/{tipeRumah}/edit', [TipeRumahController::class, 'edit'])->name('tipe.edit');
    Route::put('/tipe/{tipeRumah}', [TipeRumahController::class, 'perbarui'])->name('tipe.perbarui');
    Route::patch('/tipe/{tipeRumah}/harga', [TipeRumahController::class, 'ubahHarga'])->name('tipe.harga');
    Route::delete('/tipe/{tipeRumah}', [TipeRumahController::class, 'hapus'])->name('tipe.hapus');

    Route::get('/foto', [FotoRumahController::class, 'index'])->name('foto.index');
    Route::get('/foto/buat', [FotoRumahController::class, 'create'])->name('foto.create');
    Route::post('/foto', [FotoRumahController::class, 'simpan'])->name('foto.simpan');
    Route::get('/foto/{fotoRumah}/edit', [FotoRumahController::class, 'edit'])->name('foto.edit');
    Route::put('/foto/{fotoRumah}', [FotoRumahController::class, 'perbarui'])->name('foto.perbarui');
    Route::delete('/foto/{fotoRumah}', [FotoRumahController::class, 'hapus'])->name('foto.hapus');

    Route::get('/brosur', [BrosurController::class, 'index'])->name('brosur.index');
    Route::get('/brosur/buat', [BrosurController::class, 'create'])->name('brosur.create');
    Route::post('/brosur', [BrosurController::class, 'simpan'])->name('brosur.simpan');
    Route::get('/brosur/{brosur}/edit', [BrosurController::class, 'edit'])->name('brosur.edit');
    Route::put('/brosur/{brosur}', [BrosurController::class, 'perbarui'])->name('brosur.perbarui');
    Route::delete('/brosur/{brosur}', [BrosurController::class, 'hapus'])->name('brosur.hapus');

    Route::get('/serah-terima', [SerahTerimaController::class, 'index'])->name('serah_terima.index');
    Route::get('/serah-terima/buat', [SerahTerimaController::class, 'create'])->name('serah_terima.create');
    Route::post('/serah-terima', [SerahTerimaController::class, 'simpan'])->name('serah_terima.simpan');
    Route::get('/serah-terima/{serahTerima}/edit', [SerahTerimaController::class, 'edit'])->name('serah_terima.edit');
    Route::put('/serah-terima/{serahTerima}', [SerahTerimaController::class, 'perbarui'])->name('serah_terima.perbarui');
    Route::delete('/serah-terima/{serahTerima}', [SerahTerimaController::class, 'hapus'])->name('serah_terima.hapus');

    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::post('/pengaturan', [PengaturanController::class, 'perbarui'])->name('pengaturan.perbarui');
});