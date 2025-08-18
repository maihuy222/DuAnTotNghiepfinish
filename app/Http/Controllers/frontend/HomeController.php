<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Post; 

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm
        $products = DB::table('products')->get();

        // Lấy danh sách danh mục (chưa bị xóa)
        $categories = DB::table('categories')
            ->where('isDeleted', 0)
            ->take(6)
            ->get();

        $navCategories = DB::table('categories')
            ->where('show_in_nav', 1)
            ->where('isDeleted', 0)
            ->get();

        $latestProducts = DB::table('products') // sản phẩm mới nhất
            ->where('isDeleted', 0)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Best selling products
        $bestSelling = Product::select(
            'products.id',
            'products.name',
            'products.slug',
            'products.price',
            'products.image',
            DB::raw('SUM(orderdetails.quantity) as total_sold')
        )
        ->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
        ->groupBy('products.id', 'products.name', 'products.slug', 'products.price', 'products.image')
        ->orderByDesc('total_sold')
        ->take(5)
        ->get();

        // Featured products
        $featuredProducts = Product::select(
            'products.id',
            'products.name',
            'products.slug',
            'products.price',
            'products.image',
            DB::raw('SUM(orderdetails.quantity) as total_sold'),
            DB::raw('AVG(reviews.rating) as average_rating')
        )
        ->leftJoin('orderdetails', 'products.id', '=', 'orderdetails.product_id')
        ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
        ->where('products.isDeleted', 0)
        ->groupBy('products.id', 'products.name', 'products.slug', 'products.price', 'products.image')
        ->orderByDesc('total_sold')
        ->orderByDesc('average_rating')
        ->orderByDesc('products.updated_at')
        ->take(5)
        ->get();

        // Trending products
        $trendingProducts = Product::select(
            'products.id',
            'products.name',
            'products.slug',
            'products.price',
            'products.image',
            DB::raw('COUNT(DISTINCT orderdetails.id) as order_count'),
            DB::raw('AVG(reviews.rating) as avg_rating')
        )
        ->leftJoin('orderdetails', 'products.id', '=', 'orderdetails.product_id')
        ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
        ->where('products.isDeleted', 0)
        ->groupBy('products.id', 'products.name', 'products.slug', 'products.price', 'products.image')
        ->orderByDesc('order_count')
        ->orderByDesc('avg_rating')
->orderByDesc('products.updated_at')
        ->take(5)
        ->get();

        // Slider
        $sliders = DB::table('sliders')->get();

        // Bài viết mới nhất
        $posts = Post::with(['category', 'author'])
            ->where('isDeleted', 0)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Truyền dữ liệu sang view
        return view('frontend.home', [
            'bestSelling' => $bestSelling,
            'products' => $products,
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'sliders' => $sliders,
            'navCategories' => $navCategories,
            'posts' => $posts,
            'featuredProducts' => $featuredProducts,
            'trendingProducts' => $trendingProducts
        ]);
    }
}