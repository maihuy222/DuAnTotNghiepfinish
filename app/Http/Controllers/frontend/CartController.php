<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);
        $sizeId = $request->input('size_id'); // Có thể null
        $price = $request->input('price'); // Bắt buộc

        // Validate dữ liệu
        if (!is_numeric($price)) {
            return back()->with('error', 'Giá sản phẩm không hợp lệ.');
        }

        // Tìm hoặc tạo giỏ hàng của user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Kiểm tra xem sản phẩm với size đã có trong giỏ chưa
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->when($sizeId, fn($q) => $q->where('size_id', $sizeId))
            ->when(!$sizeId, fn($q) => $q->whereNull('size_id'))
            ->first();

        if ($item) {
            // Nếu đã có thì tăng số lượng
            $item->quantity += $quantity;
            $item->save();
        } else {
            // Nếu chưa có thì thêm mới
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $productId,
                'size_id'    => $sizeId,
                'quantity'   => $quantity,
                'price'      => $price,
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function index()
    {
        $user = Auth::user();

        // Load giỏ hàng với sản phẩm và kích cỡ
        $cart = Cart::with(['items.product', 'items.size'])->where('user_id', $user->id)->first();

        return view('frontend.cart.index', compact('cart'));
    }

    public function updateQuantity(Request $request)
    {
        $item = CartItem::find($request->item_id);

        if ($item && $item->cart->user_id == Auth::id()) {
            $item->quantity = max(1, (int)$request->quantity);
            $item->save();

            $subtotal = $item->price * $item->quantity;
            $total = $item->cart->items->sum(function ($i) {
                return $i->price * $i->quantity;
            });

            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal),
                'total' => number_format($total)
            ]);
        }

        return response()->json(['success' => false], 400);
    }

    public function remove($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item && $item->cart->user_id == Auth::id()) {
            $item->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
