<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuanLyController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\BinhLuanController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('frontend.home');
});

// Trang /home chính cho user (sau login, đã xác thực)
Route::get('/home', function () {
    return view('frontend.home');
})->middleware(['auth', 'verified'])->name('home');

// Group route cho user đã đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Route test để kiểm tra dữ liệu comments
Route::get('/test-comments', function () {
    $comments = \App\Models\Comment::with(['user', 'post'])->get();
    return response()->json([
        'total' => $comments->count(),
        'comments' => $comments->take(3)->map(function($c) {
            return [
                'id' => $c->id,
                'user_name' => $c->user ? $c->user->name : 'N/A',
                'post_title' => $c->post ? $c->post->title : 'N/A',
                'content' => $c->content,
                'status' => $c->status
            ];
        })
    ]);
});

// route đăng nhập login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::prefix('admin')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->middleware('admin.auth')->name('admin.dashboard');


Route::prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/quanlynguoidung', [QuanLyController::class, 'quanlynguoidung'])->name('quanly.nguoidung');
        
        // Routes cho quản lý bình luận
        Route::get('/quanlybinhluan', [BinhLuanController::class, 'index'])->name('quanly.binhluan');
        Route::get('/binhluan/{id}', [BinhLuanController::class, 'show'])->name('binhluan.show');
        Route::put('/binhluan/{id}/status', [BinhLuanController::class, 'updateStatus'])->name('binhluan.updateStatus');
        Route::post('/binhluan/{id}/reply', [BinhLuanController::class, 'reply'])->name('binhluan.reply');
        Route::delete('/binhluan/{id}', [BinhLuanController::class, 'destroy'])->name('binhluan.destroy');
    });
Route::prefix('admin/products')->group(function () {
    Route::get('/', [SanPhamController::class, 'index'])->name('products.index'); // Danh sách
    Route::get('/create', [SanPhamController::class, 'create'])->name('products.create'); // Form thêm mới
    Route::post('/store', [SanPhamController::class, 'store'])->name('products.store'); // Lưu mới
    Route::get('/{id}/edit', [SanPhamController::class, 'edit'])->name('products.edit'); // Form sửa
    Route::put('/{id}', [SanPhamController::class, 'update'])->name('products.update'); // Cập nhật
    Route::delete('/{id}', [SanPhamController::class, 'destroy'])->name('products.destroy');
  

});
Route::prefix('admin/categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
