<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
    
        $request->validate([
            'method' => 'required|in:cod,vnpay'
        ]);

        $user = Auth::user();

        // Lấy giỏ hàng
        $cart = Cart::with(['items.product', 'items.size'])->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($cart->items as $item) {
                $price = $item->price ?? $item->product->price;
                $total += $price * $item->quantity;
            }
         

            // Tạo đơn hàng
            $order = Order::create([
                'user_id'      => $user->id,
                'total_amount' => $total,
                'status'       => 'pending',
            ]);
          

            // Chi tiết đơn hàng
            foreach ($cart->items as $item) {
               
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'size_id'    => $item->size_id,
                    'quantity'   => $item->quantity,
                    'unit_price' => (float) ($item->price ?? optional($item->product)->price ?? 0),

                ]);
            }
           

            // Thanh toán
            $method = $request->input('method');

            if ($method === 'cod') {
                Payment::create([
                    'order_id' => $order->id,
                    'amount'   => $total,
                    'method'   => 'cod',
                    'status'   => 'completed'
                ]);

                // Xóa giỏ hàng
                $cart->items()->delete();
                $cart->delete();

                DB::commit();
                return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được đặt thành công!');
            }

            if ($method === 'vnpay') {
                DB::commit();
                return redirect()->route('vnpay.checkout', ['order_id' => $order->id]);
            }

            throw new \Exception("Phương thức thanh toán không hợp lệ.");
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function index()
    {
        $userId = Auth::id();

        $orders = Order::where('user_id', $userId)
            ->with('details.product', 'details.size', 'payment')
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['details.product', 'details.size', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.orders.show', compact('order'));
    }
    public function showCheckoutForm()
    {
        $user = Auth::user();
        $cart = \App\Models\Cart::with(['items.product', 'items.size'])
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        return view('frontend.checkout', compact('cart'));
    }
}
