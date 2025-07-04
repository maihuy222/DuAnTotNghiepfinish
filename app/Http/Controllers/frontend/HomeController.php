<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product; 

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm
        $products = DB::table('products')->get();

        // Lấy danh sách danh mục (chưa bị xóa)
        $categories = DB::table('categories')
            ->where('isDeleted', 0)
            ->get();
        $latestProducts = DB::table('products') // sản phẩm mới nhất
            ->where('isDeleted', 0)
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();
        $bestSelling = Product::select('products.*', DB::raw('SUM(orderdetails.quantity) as total_sold'))
            ->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(8) // Top 8 sản phẩm bán chạy
            ->get();
      
        // Truyền cả 2 biến sang view
        return view('frontend.home', [
            'bestSelling'=> $bestSelling,
            'products' => $products,
            'categories' => $categories,
            'latestProducts' => $latestProducts
           
        ]);
    }
}
