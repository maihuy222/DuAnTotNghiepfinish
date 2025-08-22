<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'status'];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    protected $casts = [
        'total_amount' => 'float',
    ];
}
