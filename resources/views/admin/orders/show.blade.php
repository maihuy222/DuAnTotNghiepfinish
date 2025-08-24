@extends('admin.layout')

@section('content')
<main class="app-content">
    <div class="container">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

        {{-- Thông tin người đặt --}}
        <div class="mb-3">
            <p><strong>Khách hàng:</strong> {{ $order->customer_name ?? $order->user->name ?? 'N/A' }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->customer_phone ?? $order->user->phone ?? 'N/A' }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->user->address ?? 'N/A' }}</p>
            <p><strong>Ngày đặt:</strong> {{ $order->order_date }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount,0,',','.') }} VNĐ</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $order->payment->method ?? 'COD' }}</p>
        </div>

        {{-- Form cập nhật trạng thái --}}
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mb-4">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4">
                    <label for="status">Trạng thái đơn hàng</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Cửa hàng xác nhận, chuẩn bị hàng</option>
                        <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao hàng</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="payment_status">Trạng thái thanh toán</label>
                    <input type="text" class="form-control" value="
                        @if(!$order->payment)
                            Chưa thanh toán
                        @elseif($order->payment->status == 'completed')
                            Đã thanh toán
                        @elseif($order->payment->status == 'refunded')
                            Hoàn tiền
                        @else
                            {{ ucfirst($order->payment->status) }}
                        @endif
                    " readonly>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                </div>
            </div>
        </form>

        {{-- Danh sách sản phẩm --}}
        <h4>Sản phẩm trong đơn hàng</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->size->name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price,0,',','.') }} VNĐ</td>
                    <td>{{ number_format($item->unit_price * $item->quantity,0,',','.') }} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
