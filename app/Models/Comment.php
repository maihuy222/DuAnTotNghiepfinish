<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'reply',
        'status',
        'isDeleted'
    ];

    protected $casts = [
        'isDeleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với Post (sản phẩm)
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    // Scope để lọc comment chưa bị xóa
    public function scopeNotDeleted($query)
    {
        return $query->where('isDeleted', 0);
    }

    // Scope để lọc theo trạng thái
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
} 