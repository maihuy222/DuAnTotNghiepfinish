@extends('frontend.layout')

@section('content')

<div class="container">
    @if ($products->isEmpty())
    <div class="empty-state text-center py-5">
        <div class="mx-auto" style="max-width: 400px;">
            <div class="mb-4">
                <svg width="120" height="120" class="mx-auto text-muted" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z" />
                </svg>
            </div>
            <h3 class="h4 text-muted mb-3">Chưa có sản phẩm</h3>
            <p class="text-muted mb-4">Hiện tại chưa có sản phẩm nào trong danh mục này. Hãy quay lại sau nhé!</p>
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>Về trang chủ
            </a>
        </div>
    </div>
    @else
    <div class="filter-section mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <p class="mb-0 text-muted">
                <span class="fw-bold text-dark">{{ $products->count() }}</span> sản phẩm được tìm thấy
            </p>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" style="width: auto;">
                    <option>Sắp xếp theo</option>
                    <option>Giá: Thấp đến cao</option>
                    <option>Giá: Cao đến thấp</option>
                    <option>Tên A-Z</option>
                    <option>Mới nhất</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-2 mb-4">
            <div class="card h-100 product-card shadow-sm">
                <div class="position-relative overflow-hidden">
                    <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
                        <img src="{{ asset($product->image) }}" class="tab-image product-image" alt="{{ $product->name }}">
                    </a>

                    <div class="product-overlay d-flex align-items-center justify-content-center">
                        <div class="d-flex gap-2">
                            <button class="btn btn-light btn-sm rounded-circle action-btn">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-light btn-sm rounded-circle action-btn">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>

                    @if(isset($product->discount) && $product->discount > 0)
                    <div class="position-absolute top-0 start-0 p-2">
                        <span class="badge bg-danger">-{{ $product->discount }}%</span>
                    </div>
                    @endif
                </div>

                <div class="card-body p-3">
                    <h6 class="card-title product-name">
                        <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}" class="text-decoration-none text-dark">
                            {{ $product->name }}
                        </a>
                    </h6>

                    <div class="d-flex align-items-center mb-2 rating-section">
                        <div class="text-warning small">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-muted small ms-1">(4.5)</span>
                    </div>

                    <div class="price-section">
                        <span class="h6 text-danger fw-bold mb-0">
                            {{ number_format($product->price, 0, ',', '.') }}₫
                        </span>
                        @if(isset($product->original_price) && $product->original_price > $product->price)
                        <div class="text-muted small text-decoration-line-through">
                            {{ number_format($product->original_price, 0, ',', '.') }}₫
                        </div>
                        @endif
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit" class="btn btn-primary btn-sm w-100 add-to-cart-btn">
                            <i class="fas fa-shopping-cart me-1"></i> Thêm vào giỏ
                        </button>
                    </form>


                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(method_exists($products, 'links'))
    <div class="mt-5 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
    @endif
    @endif
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- CSS + Responsive -->


<!-- JavaScript -->


@endsection