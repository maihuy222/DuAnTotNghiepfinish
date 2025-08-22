@extends('frontend.layout')

@section('content')
<div class="container-fluid py-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary rounded-circle p-3 me-3">
                    <i class="fas fa-shopping-cart text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-0 fw-bold">Giỏ hàng của bạn</h2>
                    <p class="text-muted mb-0">Xem lại các sản phẩm trước khi thanh toán</p>
                </div>
            </div>

            @if ($cart && $cart->items->count() > 0)
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light border-0 py-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="fas fa-list me-2 text-primary"></i>
                                Danh sách sản phẩm ({{ $cart->items->count() }} sản phẩm)
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            @php $total = 0; @endphp
                            @foreach ($cart->items as $item)
                            @php
                            $price = $item->price ?? $item->product->price;
                            $subtotal = $price * $item->quantity;
                            $total += $subtotal;
                            @endphp
                            <div class="cart-item p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="row align-items-center">
                                    <!-- Product Image -->
                                    <div class="col-md-2 col-sm-3 mb-3 mb-sm-0">
                                        <div class="product-image-wrapper">
                                            <img src="{{ asset($item->product->image) }}"
                                                alt="{{ $item->product->name }}"
                                                class="img-fluid rounded shadow-sm">
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                                        <h6 class="fw-bold mb-2">{{ $item->product->name }}</h6>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="fas fa-tags me-1"></i>
                                                {{ $item->size ? $item->size->name : 'Không có' }}
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Sản phẩm chính hãng
                                        </p>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col-md-2 col-sm-3 mb-3 mb-md-0">
                                        <label class="form-label small fw-semibold">Số lượng:</label>
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease" data-id="{{ $item->id }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" class="form-control text-center quantity-input"
                                                min="1" data-id="{{ $item->id }}" value="{{ $item->quantity }}">
                                            <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase" data-id="{{ $item->id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                                        <div class="text-center">
                                            <div class="text-muted small">Đơn giá</div>
                                            <div class="fw-bold text-primary">{{ number_format($price) }}đ</div>
                                            <div class="text-muted small">Thành tiền</div>
                                            <div class="fw-bold fs-6 text-success">{{ number_format($subtotal) }}đ</div>
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <div class="col-md-1 col-sm-6 text-end">
                                        <button class="btn btn-outline-danger btn-sm remove-item"
                                            data-id="{{ $item->id }}"
                                            title="Xóa sản phẩm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 ">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="fas fa-calculator me-2"></i>
                                Tổng thanh toán
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tạm tính:</span>
                                <span class="fw-semibold">{{ number_format($total) }}đ</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success">Miễn phí</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Tổng cộng:</span>
                                <span class="fw-bold fs-5 text-danger">{{ number_format($total) }}đ</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Thanh toán ngay
                                </a>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-shopping-bag me-2"></i>
                                    Tiếp tục mua sắm
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Promotion Code -->
                 
                </div>
            </div>

            @else
            <!-- Empty Cart -->
            <div class="text-center py-5">
                <div class="empty-cart-illustration mb-4">
                    <i class="fas fa-shopping-cart text-muted" style="font-size: 5rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Giỏ hàng của bạn đang trống</h4>
                <p class="text-muted mb-4">Hãy thêm sản phẩm vào giỏ hàng để bắt đầu mua sắm</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Khám phá sản phẩm
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .cart-item {
        transition: all 0.3s ease;
    }

    .cart-item:hover {
        background-color: #f8f9fa;
    }

    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .product-image-wrapper img {
        transition: transform 0.3s ease;
    }

    .product-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .quantity-input {
        max-width: 60px;
    }

    .sticky-top {
        top: 20px;
    }

    .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    .card {
        border-radius: 12px;
    }

    .badge {
        font-size: 0.75rem;
    }

    .empty-cart-illustration {
        opacity: 0.5;
    }

    .btn-lg {
        padding: 12px 30px;
        font-weight: 600;
    }

    .quantity-btn {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-group-sm .form-control {
        height: 35px;
    }

    @media (max-width: 768px) {
        .sticky-top {
            position: static !important;
        }
    }
</style>
@endsection

@section('js')
<script>
    // Quantity controls
    document.querySelectorAll('.quantity-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const action = this.dataset.action;
            const input = document.querySelector(`input[data-id="${itemId}"]`);
            let quantity = parseInt(input.value);

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }

            input.value = quantity;
            updateCart(itemId, quantity);
        });
    });

    // Direct input change
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const itemId = this.dataset.id;
            const quantity = Math.max(1, parseInt(this.value) || 1);
            this.value = quantity;
            updateCart(itemId, quantity);
        });
    });

    // Remove item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) return;

            const itemId = this.dataset.id;
            const cartItem = this.closest('.cart-item');

            // Add loading state
            cartItem.style.opacity = '0.5';
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            fetch("/cart/remove/" + itemId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Animate removal
                        cartItem.style.transform = 'translateX(100%)';
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    } else {
                        // Reset on error
                        cartItem.style.opacity = '1';
                        this.disabled = false;
                        this.innerHTML = '<i class="fas fa-trash"></i>';
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    cartItem.style.opacity = '1';
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-trash"></i>';
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                });
        });
    });

    function updateCart(itemId, quantity) {
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
                    location.reload();
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            });
    }

    // Smooth scroll for mobile
    if (window.innerWidth <= 768) {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    }
</script>
@endsection