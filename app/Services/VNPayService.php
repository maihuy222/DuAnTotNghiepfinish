<?php


namespace App\Services;

use Illuminate\Support\Facades\Log;

class VNPayService
{
    public static function generatePaymentUrl($order)

    {
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_Url = config('vnpay.url'); // Phải kết thúc bằng .html, KHÔNG thêm gì sau đó
        $vnp_ReturnUrl = config('vnpay.return_url');

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => (int)($order->total_amount * 100),
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => 'Payment for order ' . $order->id,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $order->id,
            "vnp_ExpireDate" => $vnp_ExpireDate
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnpUrl = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnp_SecureHash;

        Log::info('VNPAY hashData: ' . $hashdata);
        Log::info('VNPAY vnpSecureHash: ' . $vnp_SecureHash);
        Log::info('VNPAY payment URL: ' . $vnpUrl);

        return $vnpUrl;
    }
}
