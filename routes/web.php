<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitkerjaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratKeputusanController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\DataFormulirController;
use App\Http\Controllers\FormulirController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('login', [AuthController::class,'login'])->name('login');

Route::get('register', [AuthController::class,'register'])->name('register');


Route::get('suratmasuk', [SuratMasukController::class,'index'])->name('suratmasuk');
Route::post('suratmasuk', [SuratMasukController::class, 'store'])->name('suratmasuk.store');
Route::get('suratmasuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('suratmasuk.edit');
Route::put('suratmasuk/{id}', [SuratMasukController::class, 'update'])->name('suratmasuk.update');
Route::delete('suratmasuk/{id}', [SuratMasukController::class, 'destroy'])->name('suratmasuk.destroy');
Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.show');


Route::get('suratkeluar', [SuratKeluarController::class,'index'])->name('suratkeluar');
Route::post('suratkeluar', [SuratKeluarController::class, 'store'])->name('suratkeluar.store');
Route::get('suratkeluar/{id}/edit', [SuratKeluarController::class, 'edit'])->name('suratkeluar.edit');
Route::put('suratkeluar/{id}', [SuratKeluarController::class, 'update'])->name('suratkeluar.update');
Route::delete('suratkeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratkeluar.destroy');
Route::get('suratkeluar/{id}', [SuratKeluarController::class, 'show'])->name('suratkeluar.show');

Route::get('suratkeputusan', [SuratKeputusanController::class,'index'])->name('suratkeputusan');
Route::post('suratkeputusan', [SuratKeputusanController::class,'store'])->name('suratkeputusan.store');
Route::get('suratkeputusan/{id}/edit', [SuratKeputusanController::class,'edit'])->name('suratkeputusan.edit');
Route::delete('suratkeputusan/{id}', [SuratKeputusanController::class,'destroy'])->name('suratkeputusan.destroy');
Route::put('suratkeputusan/{id}', [SuratKeputusanController::class,'update'])->name('suratkeputusan.update');
Route::get('suratkeputusan/{id}', [SuratKeputusanController::class,'show'])->name('suratkeputusan.show');

Route::get('disposisi', [DisposisiController::class,'index'])->name('disposisi.index');
Route::post('disposisi', [DisposisiController::class,'store'])->name('disposisi.store');
Route::get('disposisi{id}/edit', [DisposisiController::class,'edit'])->name('disposisi.edit');
Route::delete('disposisi{id}', [DisposisiController::class,'destroy'])->name('disposisi.destroy');
Route::put('disposisi{id}', [DisposisiController::class,'update'])->name('disposisi.update');


Route::get('unitkerja', [UnitkerjaController::class,'unitkerja'])->name('unitkerja');
Route::post('unitkerja', [UnitkerjaController::class, 'store'])->name('unitkerja.store');
Route::put('unitkerja/{id}', [UnitkerjaController::class, 'update'])->name('unitkerja.update');
Route::get('unitkerja/{id}/edit', [UnitkerjaController::class, 'edit'])->name('unitkerja.edit');
Route::delete('unitkerja/{id}', [UnitkerjaController::class, 'destroy'])->name('unitkerja.destroy');

Route::get('formulirsurat', [DataFormulirController::class,'index'])->name('formulirsurat');
Route::get('formulirsurat/create', [DataFormulirController::class, 'create'])->name('formulirsurat.create');


Route::get('formulir', [FormulirController::class,'index'])->name('formulir');