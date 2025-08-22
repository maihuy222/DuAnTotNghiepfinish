@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="mb-1 text-primary">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Lịch sử đơn hàng
                    </h2>
                    <p class="text-muted mb-0">Theo dõi và quản lý các đơn hàng của bạn</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-light text-dark me-2">
                        Tổng: {{ $orders->count() }} đơn hàng
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if ($orders->count())
    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-light border-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-0 shadow-sm"
                    placeholder="Tìm kiếm theo mã đơn hàng..."
                    id="searchOrder">
            </div>
        </div>
        <div class="col-md-6">
            <select class="form-select border-0 shadow-sm" id="statusFilter">
                <option value="">Tất cả trạng thái</option>
                <option value="completed">Hoàn tất</option>
                <option value="pending">Chờ xử lý</option>
                <option value="processing">Đang xử lý</option>
                <option value="cancelled">Đã hủy</option>
            </select>
        </div>
    </div>

    <!-- Orders Grid -->
    <div class="row" id="ordersContainer">
        @foreach ($orders as $order)
        <div class="col-lg-6 col-xl-4 mb-4 order-item" data-status="{{ $order->status }}">
            <div class="card h-100 shadow-sm border-0 hover-shadow">
                <div class="card-header bg-light border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1 text-primary fw-bold">#{{ $order->id }}</h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="text-end">
                            @if ($order->status == 'completed')
                            <span class="badge bg-success rounded-pill">
                                <i class="fas fa-check-circle me-1"></i>
                                Hoàn tất
                            </span>
                            @elseif ($order->status == 'pending')
                            <span class="badge bg-warning text-dark rounded-pill">
                                <i class="fas fa-clock me-1"></i>
                                Chờ xử lý
                            </span>
                            @elseif ($order->status == 'processing')
                            <span class="badge bg-info rounded-pill">
                                <i class="fas fa-spinner me-1"></i>
                                Đang xử lý
                            </span>
                            @elseif ($order->status == 'cancelled')
                            <span class="badge bg-danger rounded-pill">
                                <i class="fas fa-times-circle me-1"></i>
                                Đã hủy
                            </span>
                            @else
                            <span class="badge bg-secondary rounded-pill">
                                {{ ucfirst($order->status) }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-box text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Sản phẩm</small>
                                    <span class="fw-bold">{{ $order->details_count ?? '0' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-dollar-sign text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Tổng tiền</small>
                                    <span class="fw-bold text-danger">{{ number_format($order->total_amount) }}đ</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Progress -->
                    <div class="mb-3">
                        <div class="progress" style="height: 6px;">
                            @if ($order->status == 'pending')
                            <div class="progress-bar bg-warning" style="width: 25%"></div>
                            @elseif ($order->status == 'processing')
                            <div class="progress-bar bg-info" style="width: 50%"></div>
                            @elseif ($order->status == 'completed')
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                            @else
                            <div class="progress-bar bg-secondary" style="width: 0%"></div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Đặt hàng</small>
                            <small class="text-muted">Xử lý</small>
                            <small class="text-muted">Hoàn tất</small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 pt-0">
                    <div class="d-flex gap-2">
                        <!-- Nút xem chi tiết -->
                        <a href="{{ route('orders.show', $order->id) }}"
                            class="btn btn-primary btn-sm flex-fill">
                            <i class="fas fa-eye me-1"></i>
                            Xem chi tiết
                        </a>

                        <!-- Form hủy đơn hàng chỉ khi đang pending -->
                        @if ($order->status == 'pending')
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    @else
    <!-- Empty State -->
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-shopping-bag text-muted" style="font-size: 4rem;"></i>
        </div>
        <h4 class="text-muted mb-3">Chưa có đơn hàng nào</h4>
        <p class="text-muted mb-4">Bạn chưa thực hiện đơn hàng nào. Hãy khám phá các sản phẩm của chúng tôi!</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">
            <i class="fas fa-shopping-cart me-2"></i>
            Mua sắm ngay
        </a>
    </div>
    @endif
</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .progress {
        border-radius: 10px;
    }

    .progress-bar {
        border-radius: 10px;
    }

    .order-item {
        transition: all 0.3s ease;
    }

    .order-item.d-none {
        display: none !important;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.8em;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    @media (max-width: 576px) {
        .col-6 {
            margin-bottom: 1rem;
        }

        .card-body .row {
            text-align: center;
        }
    }
</style>

<script>
    // Search functionality
    document.getElementById('searchOrder').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const orders = document.querySelectorAll('.order-item');

        orders.forEach(order => {
            const orderNumber = order.querySelector('h6').textContent.toLowerCase();
            if (orderNumber.includes(searchTerm)) {
                order.classList.remove('d-none');
            } else {
                order.classList.add('d-none');
            }
        });
    });

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        const filterValue = this.value;
        const orders = document.querySelectorAll('.order-item');

        orders.forEach(order => {
            const orderStatus = order.getAttribute('data-status');
            if (filterValue === '' || orderStatus === filterValue) {
                order.classList.remove('d-none');
            } else {
                order.classList.add('d-none');
            }
        });
    });

    // Cancel order function
    function cancelOrder(orderId) {
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
            // Ajax call to cancel order
            fetch(`/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra khi hủy đơn hàng');
                    }
                });
        }
    }
</script>
@endsection