@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="text-success">🎉 Thanh toán thành công!</h2>
    <p>Mã đơn hàng: #{{ $order->id }}</p>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">Xem đơn hàng của bạn</a>
</div>
@endsection 