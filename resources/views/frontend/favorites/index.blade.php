@extends('frontend.layout')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Sản phẩm yêu thích</h3>
    @if($favorites->isEmpty())
        <p>Bạn chưa yêu thích sản phẩm nào.</p>
    @else
    <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
        @foreach($favorites as $fav)
        @php $product = $fav->product; @endphp
        <div class="col-2 mb-4">
            <div class="card h-100 product-card shadow-sm">
                <div class="position-relative overflow-hidden">
                    <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
                        <img src="{{ asset($product->image) }}" class="tab-image product-image" alt="{{ $product->name }}">
                    </a>

                    <div class="product-overlay d-flex align-items-center justify-content-center">
                        <div class="d-flex gap-2">
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-light btn-sm rounded-circle action-btn" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm rounded-circle action-btn favorite-toggle btn-danger" data-product-id="{{ $product->id }}" title="Bỏ yêu thích">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">
                    <h6 class="card-title product-name">
                        <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}" class="text-decoration-none text-dark">
                            {{ $product->name }}
                        </a>
                    </h6>
                    <div class="d-flex align-items-center mb-2 rating-section">
                        @php
                            $avg = round(($product->avg_rating ?? 0), 1);
                            $full = floor($avg);
                            $hasHalf = ($avg - $full) >= 0.5;
                        @endphp
                        <div class="small" style="color: #FFD700;">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $full)
                                    <i class="fas fa-star fa-xs"></i>
                                @elseif ($i == $full + 1 && $hasHalf)
                                    <i class="fas fa-star-half-alt fa-xs"></i>
                                @else
                                    <i class="far fa-star fa-xs"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="small ms-1" style="color: #FFD700;">
                            ({{ number_format($avg, 1) }}/5 · {{ (int) ($product->reviews_count ?? 0) }} )
                        </span>
                    </div>
                    <div class="price-section">
                        <span style="font-weight: 800; color: #b20000; font-size: 0.8rem;">
                            {{ number_format($product->price, 0, ',', '.') }}₫
                        </span>
                    </div>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit" class="btn btn-primary btn-sm w-100 add-to-cart-btn mt-2">
                            <i class="fas fa-shopping-cart me-1"></i> Thêm vào giỏ
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<script>
    function ensureNotifyContainerBR() {
        let container = document.getElementById('notify-container-br');
        if (!container) {
            container = document.createElement('div');
            container.id = 'notify-container-br';
            container.style.position = 'fixed';
            container.style.right = '20px';
            container.style.bottom = '20px';
            container.style.zIndex = '9999';
            container.style.display = 'flex';
            container.style.flexDirection = 'column';
            container.style.gap = '10px';
            container.style.alignItems = 'flex-end';
            document.body.appendChild(container);
        }
        return container;
    }

    function toastBR(message, isError = false) {
        const wrap = ensureNotifyContainerBR();
        const card = document.createElement('div');
        card.className = 'notify-card' + (isError ? ' error' : '');
        card.style.display = 'flex';
        card.style.alignItems = 'center';
        card.style.gap = '10px';
        card.style.padding = '10px 14px';
        card.style.minWidth = '280px';
        card.style.borderRadius = '10px';
        card.style.boxShadow = '0 10px 20px rgba(0,0,0,0.12)';
        card.style.color = isError ? '#842029' : '#0f5132';
        card.style.background = isError ? '#f8d7da' : '#d1e7dd';
        card.style.border = '1px solid ' + (isError ? '#f5c2c7' : '#badbcc');
        card.innerHTML = `
            <span class="notify-icon" style="width:28px;height:28px;border-radius:50%;display:grid;place-items:center;background:${isError ? '#dc3545' : '#198754'};color:#fff">
                <i class="fas ${isError ? 'fa-times' : 'fa-check'}"></i>
            </span>
            <span>${message}</span>
            <button class="notify-close" style="border:none;background:transparent;color:inherit"><i class="fas fa-times"></i></button>
        `;
        wrap.appendChild(card);
        card.querySelector('.notify-close').addEventListener('click', () => card.remove());
        setTimeout(() => card.remove(), 4000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.favorite-toggle').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                fetch("{{ route('favorites.toggle') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => { if (!res.ok) throw new Error(); return res.text(); })
                .then(() => {
                    // Toggle UI
                    const isRemoving = btn.classList.contains('btn-danger');
                    if (isRemoving) {
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-light');
                        btn.title = 'Thêm yêu thích';
                        toastBR('Đã bỏ yêu thích sản phẩm');
                        // Ẩn thẻ card khi bỏ yêu thích
                        const card = btn.closest('.col-2');
                        if (card) card.remove();
                    } else {
                        btn.classList.remove('btn-light');
                        btn.classList.add('btn-danger');
                        btn.title = 'Bỏ yêu thích';
                        toastBR('Đã thêm sản phẩm yêu thích');
                    }
                })
                .catch(() => toastBR('Có lỗi xảy ra', true));
            });
        });
    });
</script>
@endsection