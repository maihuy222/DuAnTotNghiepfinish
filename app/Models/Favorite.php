<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';           // nếu bạn đặt tên khác thì sửa lại
    protected $fillable = ['user_id', 'product_id'];
    public $timestamps = true;

    public function product()
    {
        // chắc chắn Product model tồn tại
        return $this->belongsTo(Product::class, 'product_id');
    }
}
