<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';
    
    protected $fillable = [
        'title',
        'image',
        'link',
        'isDeleted',
        'is_active'
    ];

    protected $casts = [
        'isDeleted' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scope để lấy các slider chưa bị xóa
    public function scopeActive($query)
    {
        return $query->where('isDeleted', false);
    }

    // Scope để lấy các slider đã bị xóa
    public function scopeDeleted($query)
    {
        return $query->where('isDeleted', true);
    }
} 