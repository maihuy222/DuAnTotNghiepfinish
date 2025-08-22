<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User; // hoặc Customer nếu bạn dùng riêng
use App\Models\Product;
use Carbon\Carbon;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalCustomers = User::count(); // hoặc Customer::count()
        $totalProducts = Product::count();
        $lowStockCount = Product::where('quantity', '<=', 5)->count();
        $recentCustomers = User::orderBy('created_at', 'desc')->take(5)->get();

        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        
        $months = [];
        $revenues = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = 'Tháng ' . $i;
            $revenues[] = $monthlyRevenue[$i] ?? 0; // nếu không có dữ liệu, gán 0
        }

        return view('admin.dashboard', 
        compact('totalOrders', 
        'totalCustomers',
        'totalProducts',
        'lowStockCount',
        'recentCustomers',
        'months',
        'revenues'));
    }
}
