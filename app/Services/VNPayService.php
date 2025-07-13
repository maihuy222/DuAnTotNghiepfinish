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

            $vnp_TxnRef = $order->id;
            $vnp_OrderInfo = 'Thanh toán đơn hàng ' . $order->id;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = (int) ($order->total_amount * 100);
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $vnp_CreateDate = date('YmdHis');
            $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => $vnp_CreateDate,
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_ReturnUrl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $vnp_ExpireDate,
            ];

            ksort($inputData);

            $hashData = '';
            foreach ($inputData as $key => $value) {
                $hashData .= $key . '=' . $value . '&';
            }
            $hashData = rtrim($hashData, '&');

            $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

            $query = http_build_query($inputData); // dùng lại để build URL
            $vnpUrlWithParams = $vnp_Url . '?' . $query . '&vnp_SecureHash=' . $vnpSecureHash;
            return $vnpUrlWithParams;
        }
    }
