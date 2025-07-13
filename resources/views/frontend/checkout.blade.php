@extends('frontend.layout')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Progress Steps -->
            <div class="checkout-progress mb-5">
                <div class="progress-steps d-flex justify-content-between align-items-center">
                    <div class="step completed">
                        <div class="step-circle">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="step-label">Giỏ hàng</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step active">
                        <div class="step-circle">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <span class="step-label">Thanh toán</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span class="step-label">Hoàn tất</span>
                    </div>
                </div>
            </div>

            <!-- Page Header -->
            <div class="checkout-header text-center mb-5">
                <h1 class="display-6 fw-bold text-primary mb-2">Xác nhận đơn hàng</h1>
                <p class="text-muted">Vui lòng kiểm tra lại thông tin trước khi thanh toán</p>
            </div>

            @if ($cart && $cart->items->count() > 0)
            <div class="row">
                <!-- Order Summary -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="fas fa-list-alt me-2"></i>
                                Chi tiết đơn hàng
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
                            <div class="order-item p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-3">
                                        <div class="product-image">
                                            <img src="{{ asset($item->product->image) }}"
                                                alt="{{ $item->product->name }}"
                                                class="img-fluid rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-9">
                                        <h6 class="fw-bold mb-1">{{ $item->product->name }}</h6>
                                        <div class="product-details">
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="fas fa-expand-arrows-alt me-1"></i>
                                                {{ $item->size ? $item->size->name : 'Mặc định' }}
                                            </span>
                                            <span class="text-muted small">
                                                x{{ $item->quantity }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 text-center">
                                        <div class="price-info">
                                            <div class="text-muted small">Đơn giá</div>
                                            <div class="fw-semibold">{{ number_format($price) }}đ</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 text-end">
                                        <div class="subtotal-info">
                                            <div class="text-muted small">Thành tiền</div>
                                            <div class="fw-bold text-primary fs-6">{{ number_format($subtotal) }}đ</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Payment & Summary -->
                <div class="col-lg-4">
                    <!-- Order Total -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="fas fa-calculator me-2"></i>
                                Tổng thanh toán
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="order-summary">
                                <div class="summary-row d-flex justify-content-between mb-3">
                                    <span>Tạm tính:</span>
                                    <span class="fw-semibold">{{ number_format($total) }}đ</span>
                                </div>
                                <div class="summary-row d-flex justify-content-between mb-3">
                                    <span>Phí vận chuyển:</span>
                                    <span class="text-success fw-semibold">Miễn phí</span>
                                </div>
                                <div class="summary-row d-flex justify-content-between mb-3">
                                    <span>Thuế VAT:</span>
                                    <span class="text-success">Đã bao gồm</span>
                                </div>
                                <hr class="my-3">
                                <div class="summary-total d-flex justify-content-between">
                                    <span class="fw-bold fs-5">Tổng cộng:</span>
                                    <span class="fw-bold fs-4 text-danger">{{ number_format($total) }}đ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0 fw-semibold">
                                <i class="fas fa-credit-card me-2"></i>
                                Phương thức thanh toán
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('checkout') }}" method="POST" id="checkoutForm">
                                @csrf

                                <div class="payment-methods">
                                    <div class="form-check payment-option mb-3">
                                        <input class="form-check-input" type="radio" name="method" id="cod" value="cod" checked>
                                        <label class="form-check-label payment-label" for="cod">
                                            <div class="d-flex align-items-center">
                                                <div class="payment-icon me-3">
                                                    <i class="fas fa-money-bill-wave text-success"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Tiền mặt khi nhận hàng</div>
                                                    <small class="text-muted">Thanh toán khi nhận được sản phẩm</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-check payment-option mb-3">
                                        <input class="form-check-input" type="radio" name="method" id="vnpay" value="vnpay">
                                        <label class="form-check-label payment-label" for="vnpay">
                                            <div class="d-flex align-items-center">
                                                <div class="payment-icon me-3">
                                                    <i class="fas fa-mobile-alt text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Thanh toán qua VNPAY</div>
                                                    <small class="text-muted">Thanh toán online an toàn</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Action Buttons -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success btn-lg fw-semibold" id="confirmBtn">
                                        <i class="fas fa-shield-alt me-2"></i>
                                        Xác nhận đặt hàng
                                    </button>
                                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Quay lại giỏ hàng
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="security-notice mt-4 p-3 bg-light rounded">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lock text-success me-2"></i>
                            <small class="text-muted">
                                Thông tin của bạn được bảo mật với công nghệ SSL 256-bit
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <!-- Empty Cart -->
            <div class="empty-cart text-center py-5">
                <div class="empty-illustration mb-4">
                    <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Giỏ hàng của bạn đang trống</h4>
                <p class="text-muted mb-4">Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Tiếp tục mua sắm
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Error Messages -->
@if ($errors->any())
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong class="me-auto">Lỗi</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @foreach ($errors->all() as $err)
            <div class="mb-1">{{ $err }}</div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

@section('css')
<style>
    /* Progress Steps */
    .checkout-progress {
        max-width: 600px;
        margin: 0 auto;
    }

    .progress-steps {
        position: relative;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 2;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .step.completed .step-circle {
        background: #28a745;
        color: white;
    }

    .step.active .step-circle {
        background: #007bff;
        color: white;
        animation: pulse 2s infinite;
    }

    .step-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #6c757d;
    }

    .step.completed .step-label,
    .step.active .step-label {
        color: #495057;
        font-weight: 600;
    }

    .step-line {
        flex: 1;
        height: 2px;
        background: #e9ecef;
        margin: 0 20px;
        margin-bottom: 40px;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
        }
    }

    /* Cards */
    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border: none;
        padding: 1.25rem;
    }

    /* Order Items */
    .order-item {
        transition: background-color 0.3s ease;
    }

    .order-item:hover {
        background-color: #f8f9fa;
    }

    .product-image img {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Payment Options */
    .payment-option {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-option:hover {
        border-color: #007bff;
        background-color: #f8f9fa;
    }

    .payment-option input[type="radio"]:checked+.payment-label {
        color: #007bff;
    }

    .payment-option input[type="radio"]:checked~* {
        border-color: #007bff;
    }

    .payment-label {
        cursor: pointer;
        margin-bottom: 0;
        width: 100%;
    }

    .payment-icon {
        font-size: 1.5rem;
    }

    /* Summary */
    .summary-row {
        padding: 0.5rem 0;
    }

    .summary-total {
        padding: 1rem 0;
        border-top: 2px solid #007bff;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin: 0 -1.25rem;
        padding: 1rem 1.25rem;
    }

    /* Buttons */
    .btn-lg {
        padding: 12px 30px;
        border-radius: 8px;
        font-size: 1.1rem;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }

    /* Security Notice */
    .security-notice {
        border-left: 4px solid #28a745;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .progress-steps {
            flex-direction: column;
            gap: 20px;
        }

        .step-line {
            height: 20px;
            width: 2px;
            margin: 0;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    /* Loading state */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection

@section('js')
<script>
    // Form submission with loading state
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('confirmBtn');
        const selectedMethod = document.querySelector('input[name="method"]:checked');

        if (!selectedMethod) {
            e.preventDefault();
            alert('Vui lòng chọn phương thức thanh toán');
            return;
        }

        // Add loading state
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;

        // Show loading text
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

        // Reset after 30 seconds if not redirected
        setTimeout(() => {
            submitBtn.classList.remove('btn-loading');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 30000);
    });

    // Payment method selection animation
    document.querySelectorAll('input[name="method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove active class from all options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('border-primary', 'bg-light');
            });

            // Add active class to selected option
            const selectedOption = this.closest('.payment-option');
            selectedOption.classList.add('border-primary', 'bg-light');

            // Update button text based on selection
            const confirmBtn = document.getElementById('confirmBtn');
            if (this.value === 'vnpay') {
                confirmBtn.innerHTML = '<i class="fas fa-credit-card me-2"></i>Thanh toán qua VNPAY';
            } else {
                confirmBtn.innerHTML = '<i class="fas fa-shield-alt me-2"></i>Xác nhận đặt hàng';
            }
        });
    });

    // Auto-dismiss toast after 5 seconds
    setTimeout(() => {
        const toast = document.querySelector('.toast');
        if (toast) {
            toast.classList.remove('show');
        }
    }, 5000);

    // Smooth scroll to top when page loads
    window.addEventListener('load', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
@endsection