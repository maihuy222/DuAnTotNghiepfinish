<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuanLyController;
use App\Http\Controllers\Admin\SanPhamController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/home', function () {
    return view('frontend.home');
});
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/quanlynguoidung', [QuanLyController::class, 'quanlynguoidung'])->name('quanly.nguoidung');
     
     
     ;
    });
Route::prefix('admin/products')->group(function () {
    Route::get('/', [SanPhamController::class, 'index'])->name('products.index'); // Danh sách
    Route::get('/create', [SanPhamController::class, 'create'])->name('products.create'); // Form thêm mới
    Route::post('/store', [SanPhamController::class, 'store'])->name('products.store'); // Lưu mới
   
});

require __DIR__.'/auth.php';
