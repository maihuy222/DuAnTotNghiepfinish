<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Services\VNPayService;
use Illuminate\Support\Facades\Log;

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
        Log::info('VNPAY CALLBACK ĐÃ ĐƯỢC GỌI');
        $vnp_SecureHash = $request->input('vnp_SecureHash');

        // Lọc bỏ các tham số rỗng
        $inputData = array_filter(
            $request->except(['vnp_SecureHash', 'vnp_SecureHashType']),
            function ($v) {
                return $v !== null && $v !== '';
            }
        );
        ksort($inputData);

        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');


        $computedHash = hash_hmac('sha512', $hashData, config('vnpay.hash_secret'));

        // Thêm log để debug
        Log::info('VNPAY inputData: ' . json_encode($inputData));
        Log::info('VNPAY hashData: ' . $hashData);
        Log::info('VNPAY computedHash: ' . $computedHash);
        Log::info('VNPAY vnp_SecureHash: ' . $vnp_SecureHash);

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
