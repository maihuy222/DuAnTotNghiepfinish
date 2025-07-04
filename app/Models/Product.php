<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Tên bảng nếu không theo chuẩn Laravel

    protected $fillable = [
        'name',
        'slug',
        'price',
        'quantity',
        'description',
        'short_description',
        'image',
        'category_id',
        'status',
        'sold',
    ];

    // Nếu bạn có created_at, updated_at
    public $timestamps = true;

    // ⭐ Mối quan hệ với danh mục (category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ⭐ Mối quan hệ với đánh giá
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ⭐ Nếu bạn có bảng product_images (ảnh phụ)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // ⭐ Accessor nếu bạn lưu nhiều ảnh trong 1 cột kiểu JSON (tùy chọn)
    public function getImagesAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    // ⭐ Tự động tạo slug (tùy chọn nếu muốn)
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }
    public function sizes()
    {
        return $this->belongsToMany(Sizes::class, 'ProductSizes', 'product_id', 'size_id')
            ->withPivot('price')
            ->wherePivot('isDeleted', 0);
    }
}
