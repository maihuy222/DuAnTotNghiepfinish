<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
public function index()
{
$user = Auth::user();

$orders = Order::where('user_id', $user->id)
->where('isDeleted', 0)
->orderByDesc('created_at')
->get();

return view('frontend.profile', [
'totalOrders' => $orders->count(),
'completedOrders' => $orders->where('status', 'completed')->count(),
'pendingOrders' => $orders->where('status', 'pending')->count(),
'totalSpent' => $orders->sum('total_amount'),
'recentOrders' => $orders->take(5),
'memberSince' => $user->created_at->format('d/m/Y'),
]);
}
}