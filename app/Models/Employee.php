<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Nếu tên bảng không phải số nhiều chuẩn, cần khai báo

    protected $fillable = [
        'name',
        'email',
        'position',
        'avatar',
        // thêm các cột khác nếu có trong bảng
    ];

    // Quan hệ 1 nhân viên có nhiều bài viết
    public function posts()
    {
        return $this->hasMany(Post::class, 'employee_id');
    }
}
