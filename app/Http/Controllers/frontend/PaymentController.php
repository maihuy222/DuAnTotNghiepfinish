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

        $vnpUrl = VNPayService::generatePaymentUrl($order);
        return redirect($vnpUrl); // ✅ Đây mới là cách Laravel redirect đúng
    }


    public function vnpayCallback(Request $request)
    {
        $vnp_SecureHash = $request->input('vnp_SecureHash');

        // Lấy toàn bộ input trừ SecureHash & SecureHashType
        $inputData = $request->except(['vnp_SecureHash', 'vnp_SecureHashType']);
        ksort($inputData);

        $hashData = urldecode(http_build_query($inputData));
        $computedHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));

        if ($computedHash === $vnp_SecureHash) {
            $order = Order::find($request->input('vnp_TxnRef'));

            if (!$order) {
                abort(404, 'Không tìm thấy đơn hàng');
            }

            if ($request->input('vnp_ResponseCode') === '00') {
                $order->update(['status' => 'paid']);

                Payment::create([
                    'order_id' => $order->id,
                    'amount' => $order->total_amount,
                    'method' => 'vnpay',
                    'status' => 'completed'
                ]);

                return view('frontend.payment_success', compact('order'));
            } else {
                $order->update(['status' => 'failed']);
                return view('frontend.payment_fail', compact('order'));
            }
        } else {
            abort(403, 'Sai chữ ký thanh toán (SecureHash không hợp lệ)');
        }
    }
}
