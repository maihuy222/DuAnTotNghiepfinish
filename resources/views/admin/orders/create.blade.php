@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Tạo đơn hàng mới</h2>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Tên khách hàng</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="customer_phone" class="form-label">Số điện thoại (nếu có)</label>
            <input type="text" name="customer_phone" id="customer_phone" class="form-control">
        </div>

        <div id="product-list">
            <h5>Sản phẩm</h5>
            <div class="product-group mb-3 border p-3">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label>Sản phẩm</label>
                        <select name="products[0][product_id]" class="form-select">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Size</label>
                        <select name="products[0][size_id]" class="form-select">
                            <option value="">-- Không chọn --</option>
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Số lượng</label>
                        <input type="number" name="products[0][quantity]" class="form-control" value="1" min="1">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addProduct()">+ Thêm sản phẩm</button>

        <div>
            <button type="submit" class="btn btn-primary">Tạo đơn hàng</button>
        </div>
    </form>
</div>

<script>
    let index = 1;

    function addProduct() {
        const html = `
    <div class="product-group mb-3 border p-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label>Sản phẩm</label>
                <select name="products[${index}][product_id]" class="form-select">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Size</label>
                <select name="products[${index}][size_id]" class="form-select">
                    <option value="">-- Không chọn --</option>
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Số lượng</label>
                <input type="number" name="products[${index}][quantity]" class="form-control" value="1" min="1">
            </div>
        </div>
    </div>`;
        document.getElementById('product-list').insertAdjacentHTML('beforeend', html);
        index++;
    }
</script>
@endsection