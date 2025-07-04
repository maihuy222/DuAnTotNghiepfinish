<?php

namespace App\Services;

class VNPayService
{
    public static function generatePaymentUrl($order)
    {
        $baseUrl = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';

        $queryParams = http_build_query([
            'vnp_Amount' => $order->total_amount * 100, // VNPAY cần đơn vị là VND * 100
            'vnp_TxnRef' => $order->id,
            'vnp_OrderInfo' => 'Thanh toán đơn hàng #' . $order->id,
            'vnp_ReturnUrl' => route('payment.vnpay.callback'),
            // Các tham số khác bạn có thể bổ sung
        ]);

        return $baseUrl . '?' . $queryParams;
    }
}
