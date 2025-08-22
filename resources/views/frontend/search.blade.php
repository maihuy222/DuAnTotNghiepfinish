@extends('frontend.layout')

@section('content')
<div class="container py-4">
    <h4>Kết quả tìm kiếm cho: "{{ $keyword }}"</h4>

    @if($products->isEmpty())
    <p>Không tìm thấy kết quả nào.</p>
    @else
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <img src="{{ asset($product->image) }}" class="tab-image product-image" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                    <a href="{{ url('product/' . $product->slug) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection