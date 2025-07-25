<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    // THÊM 'price' vào đây
    protected $fillable = ['cart_id', 'product_id', 'size_id', 'quantity', 'price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class, 'size_id');
    }
}
