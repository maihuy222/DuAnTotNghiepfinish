<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ProductSizes', 'size_id', 'product_id')
            ->withPivot('price')
            ->wherePivot('isDeleted', 0);
    }
}
