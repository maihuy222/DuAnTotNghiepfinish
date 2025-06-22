<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostCategory; // Added this import
use App\Models\Employee; // Added this import

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
        'employee_id',
        'isDeleted'
    ];

    protected $casts = [
        'isDeleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Quan hệ với Comment
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    // Quan hệ với Category (nếu có model Category)
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    // Quan hệ với Employee (nếu có model Employee)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Scope để lọc post chưa bị xóa
    public function scopeNotDeleted($query)
    {
        return $query->where('isDeleted', 0);
    }

    // Scope để lọc theo category
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
} 