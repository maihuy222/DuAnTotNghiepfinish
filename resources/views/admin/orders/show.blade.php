@extends('admin.layout')

@section('content')
<main class="app-content">
    <div class="container">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <p><strong>Khách hàng:</strong> {{ $order->user->name ?? 'N/A' }}</p>
        <p><strong>Ngày đặt:</strong> {{ $order->order_date ?? $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Trạng thái hiện tại:</strong> <span class="fw-bold text-primary">{{ ucfirst($order->status) }}</span></p>

        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="mb-4">
            @csrf
            <label for="status" class="form-label fw-bold">Cập nhật trạng thái:</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
            <button type="submit" class="btn btn-success mt-2">Cập nhật</button>
        </form>

        <h4>Sản phẩm trong đơn hàng</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $item)
                <tr>
                    <td>{{ $item->product->name ?? '---' }}</td>
                    <td>{{ $item->size->name ?? '---' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 0, ',', '.') }} đ</td>
                    <td>{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-3"><strong>Tổng cộng:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} đ</p>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
    </div>
</main>
    @endsection