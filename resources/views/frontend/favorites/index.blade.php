@extends('frontend.layout')

@section('content')
<div class="container py-4">
    <h3>Sản phẩm yêu thích</h3>
    <div class="row">
        @forelse($favorites as $fav)
        <div class="col-md-3 mb-3">
            <div class="card">
                <a href="{{ route('product.show', $fav->product->slug) }}">
                    <img src="{{ asset($fav->product->image) }}" class="card-img-top">
                </a>
                <div class="card-body">
                    <h6>{{ $fav->product->name }}</h6>
                    <p class="text-danger fw-bold">{{ number_format($fav->product->price, 0, ',', '.') }}₫</p>
                    <form method="POST" action="{{ route('favorites.toggle') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $fav->product->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Bỏ yêu thích</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p>Bạn chưa yêu thích sản phẩm nào.</p>
        @endforelse
    </div>
</div>
@endsection