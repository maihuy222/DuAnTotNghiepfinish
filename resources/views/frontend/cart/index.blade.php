@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>

    @if ($cart && $cart->items->count() > 0)
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Kích cỡ</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Hành động </th>

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
                <td>
                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" width="80" class="img-thumbnail">
                </td>
                <td>{{ $item->size ? $item->size->name : 'Không có' }}</td>
                <td>
                    <input type="number" class="form-control quantity-input" min="1"
                        data-id="{{ $item->id }}" value="{{ $item->quantity }}">
                </td>
                <td class="text-danger fw-semibold">{{ number_format($price) }} đ</td>
                <td class="text-end fw-bold">{{ number_format($subtotal) }} đ</td>
                <td>
                    <button class="btn btn-danger btn-sm remove-item" data-id="{{ $item->id }}">X</button>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <div class="text-end mt-4">
        <h4>Tổng cộng: <span class="text-danger">{{ number_format($total) }} đ</span></h4>
    </div>
    <a href="{{ route('checkout' ) }}" class="btn btn-primary">Mua ngay</a>


    @else
    <div class="alert alert-warning">
        Bạn chưa có sản phẩm nào trong giỏ hàng.
    </div>
    @endif
</div>
@endsection

@section('js')
<script>
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const itemId = this.dataset.id;
            const quantity = this.value;

            fetch("{{ route('cart.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        quantity: quantity
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // hoặc cập nhật DOM
                    }
                });
        });
    });

    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm("Bạn có chắc muốn xóa sản phẩm này?")) return;

            const itemId = this.dataset.id;

            fetch("/cart/remove/" + itemId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        });
    });
</script>
@endsection