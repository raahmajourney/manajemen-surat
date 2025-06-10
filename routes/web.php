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
use App\Http\Controllers\FormulirSuratController;
use App\Http\Controllers\LogSuratController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

// Route login, register (TIDAK PAKAI middleware)
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'loginProses'])->name('loginProses');

Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('register', [AuthController::class,'registerProses'])->name('registerProses');

// Menampilkan form lupa password
Route::get('forgotpassword', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Mengirim email reset password
Route::post('forgotpassword', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Menampilkan form reset password (dari link email)
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Proses reset password
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/test-email', function () {
    Mail::raw('Ini adalah email percobaan dari Laravel', function ($message) {
        $message->to('test@example.com') // Alamat bebas, Mailtrap akan tangkap
                ->subject('Tes Kirim Email');
    });

    return 'Email percobaan sudah dikirim';
});


// Route logout dan umum setelah login
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
    
});

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('pengguna', UserController::class)->names('user');


    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
    Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    Route::get('unitkerja', [UnitkerjaController::class,'unitkerja'])->name('unitkerja');
    Route::post('unitkerja', [UnitkerjaController::class, 'store'])->name('unitkerja.store');
    Route::put('unitkerja/{id}', [UnitkerjaController::class, 'update'])->name('unitkerja.update');
    Route::get('unitkerja/{id}/edit', [UnitkerjaController::class, 'edit'])->name('unitkerja.edit');
    Route::delete('unitkerja/{id}', [UnitkerjaController::class, 'destroy'])->name('unitkerja.destroy');

    
   
    

});

// Route untuk Admin & Staf
Route::middleware(['auth', 'role:admin|staf'])->group(function () {
    Route::get('suratmasuk/datatable', [SuratMasukController::class, 'getData'])->name('suratmasuk.data');
    Route::get('suratmasuk', [SuratMasukController::class,'index'])->name('suratmasuk');
    Route::post('suratmasuk', [SuratMasukController::class, 'store'])->name('suratmasuk.store');
    Route::get('suratmasuk/{id}/edit', [SuratMasukController::class, 'edit'])->name('suratmasuk.edit');
    Route::put('suratmasuk/{id}', [SuratMasukController::class, 'update'])->name('suratmasuk.update');
    Route::delete('suratmasuk/{id}', [SuratMasukController::class, 'destroy'])->name('suratmasuk.destroy');
    Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.show');


    Route::get('suratkeluar/datatable', [SuratKeluarController::class, 'getData'])->name('suratkeluar.data');
    Route::get('suratkeluar', [SuratKeluarController::class,'index'])->name('suratkeluar');
    Route::post('suratkeluar', [SuratKeluarController::class, 'store'])->name('suratkeluar.store');
    Route::get('suratkeluar/{id}/edit', [SuratKeluarController::class, 'edit'])->name('suratkeluar.edit');
    Route::put('suratkeluar/{id}', [SuratKeluarController::class, 'update'])->name('suratkeluar.update');
    Route::delete('suratkeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('suratkeluar.destroy');
    Route::get('suratkeluar/{id}', [SuratKeluarController::class, 'show'])->name('suratkeluar.show');

    Route::get('suratkeputusan/datatable', [SuratKeputusanController::class, 'getData'])->name('suratkeputusan.data');
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
    Route::get('disposisi/data', [DisposisiController::class, 'getData'])->name('disposisi.data');
    Route::get('disposisi/{id}', [DisposisiController::class, 'show'])->name('disposisi.show');


    

    Route::get('logsurat', [LogSuratController::class, 'index'])->name('logsurat.index');
});

// Route untuk semua: admin, staf, dosen
Route::middleware(['auth', 'role:admin|staf|dosen'])->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('formulir', [FormulirSuratController::class,'index'])->name('formulir');
    Route::post('formulir', [FormulirSuratController::class,'store'])->name('formulir.store');

    Route::get('formulirsurat', [DataFormulirController::class,'index'])->name('formulirsurat');
    Route::get('dataformulir', [DataFormulirController::class, 'index'])->name('dataformulir.index');
    Route::delete('formulirsurat/{id}', [DataFormulirController::class, 'destroy'])->name('formulirsurat.destroy');
    Route::get('formulirsurat/{id}/edit', [DataFormulirController::class, 'edit'])->name('formulir.edit');
    Route::put('formulirsurat/{id}', [DataFormulirController::class, 'update'])->name('formulir.update');

    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
    Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});