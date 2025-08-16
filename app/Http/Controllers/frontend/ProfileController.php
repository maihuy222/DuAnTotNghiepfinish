<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
public function index(){
$user = Auth::user();

$orders = Order::where('user_id', $user->id)
->where('isDeleted', 0)
->orderByDesc('created_at')
->get();
       

        return view('frontend.profile', [
'orders' => $orders,
'totalOrders' => $orders->count(),
'completedOrders' => $orders->where('status', 'completed')->count(),
'pendingOrders' => $orders->where('status', 'pending')->count(),
'totalSpent' => $orders->sum('total_amount'),
'recentOrders' => $orders->take(5),
'memberSince' => $user->created_at->format('d/m/Y'),
]);
}
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Cập nhật ảnh nếu có
        if ($request->hasFile('avatar')) {
            // Xoá ảnh cũ
            if ($user->avatar && file_exists(public_path('storage/' . $user->avatar))) {
                unlink(public_path('storage/' . $user->avatar));
            }

            // Lưu ảnh mới
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Đổi mật khẩu thành công!');
    }

}