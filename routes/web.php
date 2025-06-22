<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuanLyController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\BinhLuanController;

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
   
});

require __DIR__.'/auth.php';
