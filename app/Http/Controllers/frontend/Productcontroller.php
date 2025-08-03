<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

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

        return view('frontend.products.product_detail', compact('product', 'relatedProducts'));
    }
    public function index()
    {
        $products = DB::table('products')
            ->where('isDeleted', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.products.index', compact('products'));
    }
}
