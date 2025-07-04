@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Xác nhận đơn hàng</h2>

    @if ($cart && $cart->items->count() > 0)
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Kích cỡ</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart->items as $item)
                @php
                $price = $item->price ?? $item->product->price;
                $subtotal = $price * $item->quantity;
                $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td><img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" width="60"></td>
                    <td>{{ $item->size ? $item->size->name : 'Mặc định' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($price) }} đ</td>
                    <td>{{ number_format($subtotal) }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            <h4>Tổng cộng: <span class="text-danger">{{ number_format($total) }} đ</span></h4>
        </div>
    </div>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="method" class="form-label fw-bold">Phương thức thanh toán:</label>
            <select name="method" class="form-select" required>
                <option value="cod">💵 Tiền mặt khi nhận hàng</option>
                <option value="vnpay">🏦 Thanh toán qua VNPAY</option>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">✅ Xác nhận đặt hàng</button>
        </div>
    </form>

    @else
    <p class="text-danger">Giỏ hàng của bạn đang trống.</p>
    @endif
</div>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $err)
    <div>{{ $err }}</div>
    @endforeach
</div>
@endif

@endsection