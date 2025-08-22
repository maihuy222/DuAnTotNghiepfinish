<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class OrderDetail extends Model
{
    protected $table = 'OrderDetails';
    protected $fillable = ['order_id', 'product_id', 'size_id', 'quantity', 'unit_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class, 'size_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // App\Models\OrderDetail.php

  
}


