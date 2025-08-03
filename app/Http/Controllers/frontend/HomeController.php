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
            ->take(5)
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
        $bestSelling = Product::select('products.*', DB::raw('SUM(orderdetails.quantity) as total_sold'))
            ->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(5) // Top 8 sản phẩm bán chạy
            ->get();
        $featuredProducts = Product::select(
            'products.*',
            DB::raw('SUM(orderdetails.quantity) as total_sold'),
            DB::raw('AVG(reviews.rating) as average_rating')
        )
            ->leftJoin('orderdetails', 'products.id', '=', 'orderdetails.product_id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.isDeleted', 0)
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->orderByDesc('average_rating')
            ->orderByDesc('products.updated_at')
            ->take(5)
            ->get();
        $trendingProducts = Product::select(
            'products.*',
            DB::raw('COUNT(DISTINCT orderdetails.id) as order_count'),
            DB::raw('AVG(reviews.rating) as avg_rating')
        )
            ->leftJoin('orderdetails', 'products.id', '=', 'orderdetails.product_id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.isDeleted', 0)
            ->groupBy('products.id')
            ->orderByDesc('order_count')
            ->orderByDesc('avg_rating')
            ->orderByDesc('products.updated_at')
            ->take(5)
            ->get();
            // sản phẩm thịnh hành

        // sản phẩm nối bật nhất
        $sliders = DB::table('sliders')->get();
        $posts = Post::with(['category', 'author'])
            ->where('isDeleted', 0)
            ->orderBy('created_at', 'desc')
            ->take(3) // lấy 6 bài viết mới nhất
            ->get();
      
        // Truyền cả 2 biến sang view
        return view('frontend.home', [
            'bestSelling'=> $bestSelling,
            'products' => $products,
            'categories' => $categories,
            'latestProducts' => $latestProducts,
            'sliders' => $sliders,
            'navCategories' => $navCategories,
            'posts' => $posts,
            'featuredProducts' => $featuredProducts,
            'trendingProducts' => $trendingProducts
             // ✅ thêm dòng này

        ]);
    }

  
}
