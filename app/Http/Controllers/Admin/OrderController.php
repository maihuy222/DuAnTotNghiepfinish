<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sizes;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'details.product', 'details.size'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
    public function create()
    {
        $products = Product::all();
        $sizes = Sizes::all();

        return view('admin.orders.create', compact('products', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.size_id' => 'nullable|exists:sizes,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            $order = Order::create([
                'user_id' => null,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_amount' => 0
            ]);

            foreach ($request->products as $item) {
                $productId = $item['product_id'];
                $sizeId = $item['size_id'] ?? null;
                $quantity = $item['quantity'];

                $price = DB::table('productsizes')
                    ->where('product_id', $productId)
                    ->where('size_id', $sizeId)
                    ->value('price') ?? Product::find($productId)->price;

                $subtotal = $price * $quantity;
                $total += $subtotal;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'size_id' => $sizeId,
                    'quantity' => $quantity,
                    'unit_price' => $price,


                ]);
            }

            $order->total_amount = $total;
            $order->save();

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Tạo đơn hàng thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }
}
