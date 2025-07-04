@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Lịch sử đơn hàng của bạn</h2>

    @if ($orders->count())
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}

                <td>
                    @if ($order->status == 'completed')
                    <span class="badge bg-success">Hoàn tất</span>
                    @elseif ($order->status == 'pending')
                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                    @else
                    <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </td>
                <td class="text-danger fw-bold">{{ number_format($order->total_amount) }} đ</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Xem</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Bạn chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection