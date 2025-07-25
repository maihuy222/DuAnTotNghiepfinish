<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    public $timestamps = false;

    // Quan hệ ngược lại với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
