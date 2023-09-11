<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\NhacungcapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoaihangController;
use App\Http\Controllers\HanghoaController;
use App\Http\Controllers\LoController;
use App\Http\Controllers\KhoController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard',[DashboardController::class, 'dashboard'])
        ->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('khachhangs',App\Http\Controllers\KhachhangController::class);
        // Route::get('khachhangs/{id}',[KhachhangController::class, 'show'])->name('khachhangs.show');
        Route::resource('nhacungcaps',App\Http\Controllers\NhacungcapController::class);
        Route::resource('users',App\Http\Controllers\UserController::class);
        Route::resource('loaihangs',App\Http\Controllers\LoaihangController::class);
        Route::resource('khos',App\Http\Controllers\KhoController::class);
        Route::resource('hanghoas',App\Http\Controllers\HanghoaController::class);
        Route::resource('hoadonxuats',App\Http\Controllers\HoadonxuatController::class);
        Route::resource('hoadonnhaps',App\Http\Controllers\HoadonnhapController::class);
        Route::resource('chitiethoadonnhaps',App\Http\Controllers\ChitiethoadonnhapController::class);
        Route::resource('chitiethoadonxuats',App\Http\Controllers\ChitiethoadonxuatController::class);
        Route::resource('roles',App\Http\Controllers\RoleController::class);

        Route::get('deletekhachhang',[KhachhangController::class, 'deletekhachhang'])->name('khachhangs.delete');
        Route::get('khachhangrestore/{id}',[KhachhangController::class, 'khachhangrestore'])->name('khachhangs.restore');
        Route::get('khachhangrestoreAll',[KhachhangController::class, 'khachhangrestoreAll'])->name('khachhangs.restoreAll');

        Route::get('deletenhacungcap',[NhacungcapController::class, 'deletenhacungcap'])->name('nhacungcaps.delete');
        Route::get('nhacungcaprestore/{id}',[NhacungcapController::class, 'nhacungcaprestore'])->name('nhacungcaps.restore');
        Route::get('nhacungcaprestoreAll',[NhacungcapController::class, 'nhacungcaprestoreAll'])->name('nhacungcaps.restoreAll');

        Route::get('deleteuser',[UserController::class, 'deleteuser'])->name('users.delete');
        Route::get('userrestore/{id}',[UserController::class, 'userrestore'])->name('users.restore');
        Route::get('userrestoreAll',[UserController::class, 'userrestoreAll'])->name('users.restoreAll');

        Route::get('deleteloaihang',[LoaihangController::class, 'deleteloaihang'])->name('loaihangs.delete');
        Route::get('loaihangrestore/{id}',[LoaihangController::class, 'loaihangrestore'])->name('loaihangs.restore');
        Route::get('loaihangrestoreAll',[LoaihangController::class, 'loaihangrestoreAll'])->name('loaihangs.restoreAll');

        Route::get('deletehanghoa',[HanghoaController::class, 'deletehanghoa'])->name('hanghoas.delete');
        Route::get('hanghoarestore/{id}',[HanghoaController::class, 'hanghoarestore'])->name('hanghoas.restore');
        Route::get('hanghoarestoreAll',[HanghoaController::class, 'hanghoarestoreAll'])->name('hanghoas.restoreAll');

        // Route::get('los',[LoController::class, 'index'])->name('los.index');
        Route::get('los/{id}',[LoController::class, 'detail'])->name('los.detail');

        Route::get('changeStatus/{id}',[LoController::class, 'changeStatus']);
    });

    require __DIR__.'/auth.php';
});
