<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory;

    // Khai báo bảng tương ứng trong DB vì tên không theo quy ước Laravel
    protected $table = 'postcategories';

    protected $fillable = ['name', 'isDeleted'];

    public function posts()
    {
        // Giả sử bảng posts có cột `postcategory_id` làm khóa ngoại
        return $this->hasMany(Post::class, 'category_id');
    }
    
}
