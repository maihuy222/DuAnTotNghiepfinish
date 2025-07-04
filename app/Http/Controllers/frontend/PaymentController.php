<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Services\VNPayService;




class PaymentController extends Controller
{
    public function vnpayRedirect(Request $request)
    {
        $orderId = $request->get('order_id');
        $order = Order::findOrFail($orderId);

        // Tạo link VNPAY ở đây (giả sử trả về URL)
        $vnpUrl = VNPayService::generatePaymentUrl($order);

        return redirect($vnpUrl);
    }

    public function vnpayCallback(Request $request)
    {
        $orderId = $request->get('vnp_TxnRef');
        $status = $request->get('vnp_ResponseCode') == '00' ? 'completed' : 'failed';

        $order = Order::find($orderId);
        if ($order) {
            // Cập nhật trạng thái thanh toán
            Payment::where('order_id', $orderId)->update([
                'status' => $status,
            ]);

            $order->status = $status === 'completed' ? 'paid' : 'failed';
            $order->save();

            return redirect()->route('orders.success')->with('success', 'Thanh toán VNPAY ' . $status);
        }

        return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng');
    }
}


