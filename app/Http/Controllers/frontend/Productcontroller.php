<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class Productcontroller extends Controller
{
    public function show($slug)
    {
        // Dùng Eloquent, load luôn quan hệ reviews và images
        $product = Product::with(['category', 'reviews', 'images','sizes'])
            ->where('slug', $slug)
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.product_detail', compact('product', 'relatedProducts'));
    }
}
