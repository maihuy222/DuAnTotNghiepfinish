# Hệ thống Quản lý Quảng cáo (Slider/Banner)

## Tổng quan
Hệ thống quản lý quảng cáo cho phép admin thêm, sửa, xóa các banner/slider hiển thị ở trang chủ.

## Cấu trúc cơ sở dữ liệu
Bảng `sliders` đã có sẵn với cấu trúc:
```sql
CREATE TABLE `sliders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Các file đã tạo

### 1. Model
- `app/Models/Slider.php` - Model để tương tác với bảng sliders

### 2. Controller
- `app/Http/Controllers/Admin/SliderController.php` - Controller xử lý logic CRUD

### 3. Views
- `resources/views/admin/sliders/index.blade.php` - Trang danh sách quảng cáo
- `resources/views/admin/sliders/create.blade.php` - Trang thêm quảng cáo mới
- `resources/views/admin/sliders/edit.blade.php` - Trang chỉnh sửa quảng cáo

### 4. Routes
Đã thêm vào `routes/web.php`:
```php
// Routes cho quản lý slider/quảng cáo
Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');
Route::get('/sliders/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
Route::put('/sliders/{id}', [SliderController::class, 'update'])->name('sliders.update');
Route::delete('/sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
Route::put('/sliders/{id}/restore', [SliderController::class, 'restore'])->name('sliders.restore');
Route::delete('/sliders/{id}/force', [SliderController::class, 'forceDelete'])->name('sliders.forceDelete');
```

### 5. Seeder
- `database/seeders/SliderSeeder.php` - Seeder để thêm dữ liệu mẫu

## Tính năng

### 1. Xem danh sách quảng cáo
- Hiển thị tất cả quảng cáo chưa bị xóa
- Hiển thị hình ảnh thumbnail, tiêu đề, link, ngày tạo
- Nút thêm quảng cáo mới

### 2. Thêm quảng cáo mới
- Form nhập tiêu đề (bắt buộc, tối đa 100 ký tự)
- Upload hình ảnh (bắt buộc, định dạng: jpeg, png, jpg, gif, tối đa 2MB)
- Nhập link (tùy chọn, phải là URL hợp lệ)
- Preview hình ảnh trước khi upload
- Validation đầy đủ với thông báo lỗi tiếng Việt

### 3. Chỉnh sửa quảng cáo
- Form chỉnh sửa với dữ liệu hiện tại
- Có thể thay đổi hình ảnh hoặc giữ nguyên
- Hiển thị hình ảnh hiện tại
- Preview hình ảnh mới nếu có

### 4. Xóa quảng cáo
- Xóa mềm (soft delete) - chỉ đánh dấu isDeleted = true
- Xác nhận trước khi xóa
- Thông báo kết quả

### 5. Khôi phục quảng cáo
- Khôi phục quảng cáo đã bị xóa mềm
- Xóa vĩnh viễn (xóa cả file hình ảnh)

## Cách sử dụng

### 1. Truy cập trang quản lý
```
/admin/sliders
```

### 2. Thêm quảng cáo mới
```
/admin/sliders/create
```

### 3. Chỉnh sửa quảng cáo
```
/admin/sliders/{id}/edit
```

## Lưu ý kỹ thuật

### 1. Upload hình ảnh
- Hình ảnh được lưu trong `storage/app/public/sliders/`
- Tên file: `timestamp_original_name.ext`
- Symbolic link đã được tạo: `public/storage` -> `storage/app/public`

### 2. Validation
- Tiêu đề: bắt buộc, tối đa 100 ký tự
- Hình ảnh: bắt buộc khi tạo mới, tùy chọn khi cập nhật
- Link: tùy chọn, phải là URL hợp lệ

### 3. Soft Delete
- Sử dụng trường `isDeleted` thay vì xóa thật
- Có thể khôi phục quảng cáo đã xóa

### 4. AJAX
- Tất cả thao tác CRUD đều sử dụng AJAX
- Thông báo kết quả bằng SweetAlert
- Reload trang sau khi thành công

## Tích hợp vào trang chủ

Để hiển thị slider trên trang chủ, thêm code sau vào controller trang chủ:

```php
use App\Models\Slider;

public function index()
{
    $sliders = Slider::active()->orderBy('created_at', 'desc')->get();
    return view('frontend.home', compact('sliders'));
}
```

Và trong view trang chủ:

```blade
@foreach($sliders as $slider)
    <div class="slider-item">
        @if($slider->link)
            <a href="{{ $slider->link }}" target="_blank">
        @endif
        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}">
        @if($slider->link)
            </a>
        @endif
    </div>
@endforeach
``` 