<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_date',
        'amount',
        'method',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
