<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuanLyController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\BinhLuanController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\Productcontroller;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\OrderController as UserOrderController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;








Route::get('/', [HomeController::class, 'index']);

// Trang /home chính cho user (sau login, đã xác thực)

Route::get('/home', [HomeController::class, 'index'])
->middleware(['auth', 'verified'])->name('home');

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
        
        // Routes cho quản lý slider/quảng cáo
        Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/sliders/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/sliders/{id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
        Route::put('/sliders/{id}/restore', [SliderController::class, 'restore'])->name('sliders.restore');
        Route::delete('/sliders/{id}/force', [SliderController::class, 'forceDelete'])->name('sliders.forceDelete');
        Route::put('/sliders/{id}/toggle-active', [SliderController::class, 'toggleActive'])->name('sliders.toggleActive');
    });
Route::prefix('admin/products')->group(function () {
    Route::get('/', [SanPhamController::class, 'index'])->name('products.index'); // Danh sách
    Route::get('/create', [SanPhamController::class, 'create'])->name('products.create'); // Form thêm mới
    Route::post('/store', [SanPhamController::class, 'store'])->name('products.store'); // Lưu mới
    Route::get('/{id}/edit', [SanPhamController::class, 'edit'])->name('products.edit'); // Form sửa
    Route::put('/{id}', [SanPhamController::class, 'update'])->name('products.update'); // Cập nhật
    Route::delete('/{id}', [SanPhamController::class, 'destroy'])->name('products.destroy'); // Xóa mềm
    Route::put('/{id}/restore', [SanPhamController::class, 'restore'])->name('products.restore'); // Khôi phục
    Route::delete('/{id}/force', [SanPhamController::class, 'forceDelete'])->name('products.forceDelete'); // Xóa vĩnh viễn
});
Route::prefix('admin/categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});
// sản phẩm chi tiết
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [UserOrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout', [UserOrderController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::get('/vnpay/checkout', [PaymentController::class, 'vnpayRedirect'])->name('vnpay.checkout');
    Route::get('/vnpay/return', [PaymentController::class, 'vnpayCallback'])->name('vnpay.return');
});;
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('orders.show');
});



Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});





require __DIR__.'/auth.php';
