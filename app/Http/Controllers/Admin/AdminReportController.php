<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminReportController extends Controller
{
   

    public function index(Request $request)
    {
        $from = $request->input('from_date', Carbon::now()->toDateString());
        $to = $request->input('to_date', Carbon::now()->toDateString());

        // Thống kê đơn hàng, khách hàng, sản phẩm bán ra, doanh thu
        $todayOrdersCount = DB::table('orders')
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->count();

        $todayCustomersCount = DB::table('users')
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->count();

        $todayRevenue = DB::table('orders')
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->sum('total_amount');

        $todayProductsSold = DB::table('orderdetails')
            ->join('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->whereBetween(DB::raw('DATE(orders.created_at)'), [$from, $to])
            ->sum('quantity');

        // Biểu đồ doanh thu theo ngày
        $start = Carbon::parse($from);
        $end = Carbon::parse($to);
        $revenueDates = [];
        $revenueValues = [];

        while ($start->lte($end)) {
            $day = $start->format('Y-m-d');
            $revenue = DB::table('orders')
                ->whereDate('created_at', $day)
                ->sum('total_amount');

            $revenueDates[] = $start->format('d/m');
            $revenueValues[] = $revenue;

            $start->addDay();
        }

        return view('admin.baocao', compact(
            'todayOrdersCount',
            'todayCustomersCount',
            'todayRevenue',
            'todayProductsSold',
            'revenueDates',
            'revenueValues'
        ));
    }
}
