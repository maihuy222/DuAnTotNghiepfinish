@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('orders.index') }}" class="text-decoration-none">
                                    <i class="fas fa-shopping-bag me-1"></i>
                                    Lịch sử đơn hàng
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Chi tiết đơn hàng #{{ $order->id }}</li>
                        </ol>
                    </nav>
                    <h2 class="mb-1 text-primary">
                        <i class="fas fa-file-invoice me-2"></i>
                        Chi tiết đơn hàng #{{ $order->id }}
                    </h2>
                    <p class="text-muted mb-0">
                        Đặt hàng lúc {{ \Carbon\Carbon::parse($order->created_at)->format('H:i - d/m/Y') }}
                    </p>
                </div>
                <div class="text-end">
                    @if ($order->status == 'completed')
                    <span class="badge bg-success rounded-pill fs-6 px-3 py-2">
                        <i class="fas fa-check-circle me-1"></i>
                        Hoàn tất
                    </span>
                    @elseif ($order->status == 'pending')
                    <span class="badge bg-warning text-dark rounded-pill fs-6 px-3 py-2">
                        <i class="fas fa-clock me-1"></i>
                        Chờ xử lý
                    </span>
                    @elseif ($order->status == 'processing')
                    <span class="badge bg-info rounded-pill fs-6 px-3 py-2">
                        <i class="fas fa-spinner me-1"></i>
                        Đang xử lý
                    </span>
                    @elseif ($order->status == 'cancelled')
                    <span class="badge bg-danger rounded-pill fs-6 px-3 py-2">
                        <i class="fas fa-times-circle me-1"></i>
                        Đã hủy
                    </span>
                    @else
                    <span class="badge bg-secondary rounded-pill fs-6 px-3 py-2">
                        {{ ucfirst($order->status) }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Timeline -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-timeline me-2"></i>
                        Trạng thái đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item {{ $order->status == 'pending' || $order->status == 'processing' || $order->status == 'completed' ? 'active' : '' }}">
                            <div class="timeline-marker">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Đơn hàng đã được tạo</h6>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i - d/m/Y') }}</small>
                            </div>
                        </div>

                        <div class="timeline-item {{ $order->status == 'processing' || $order->status == 'completed' ? 'active' : '' }}">
                            <div class="timeline-marker">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Đang xử lý</h6>
                                @if($order->status == 'processing' || $order->status == 'completed')
                                <small class="text-muted">{{ \Carbon\Carbon::parse($order->updated_at)->format('H:i - d/m/Y') }}</small>
                                @else
                                <small class="text-muted">Chờ xử lý</small>
                                @endif
                            </div>
                        </div>

                        <div class="timeline-item {{ $order->status == 'completed' ? 'active' : '' }}">
                            <div class="timeline-marker">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Hoàn thành</h6>
                                @if($order->status == 'completed')
                                <small class="text-muted">{{ \Carbon\Carbon::parse($order->updated_at)->format('H:i - d/m/Y') }}</small>
                                @else
                                <small class="text-muted">Chưa hoàn thành</small>
                                @endif
                            </div>
                        </div>

                        @if($order->status == 'cancelled')
                        <div class="timeline-item cancelled">
                            <div class="timeline-marker">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1 text-danger">Đã hủy</h6>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($order->updated_at)->format('H:i - d/m/Y') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="col-lg-8">
            <!-- Customer & Shipping Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-user me-2"></i>
                        Thông tin khách hàng & giao hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Thông tin khách hàng</h6>
                            <div class="customer-info">
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Họ tên</small>
                                            <span class="fw-semibold">{{ $order->customer_name ?? 'Không có thông tin' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3">
                                            <i class="fas fa-phone text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Số điện thoại</small>
                                            <span class="fw-semibold">{{ $order->customer_phone ?? 'Không có thông tin' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3">
                                            <i class="fas fa-envelope text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Email</small>
                                            <span class="fw-semibold">{{ $order->customer_email ?? 'Không có thông tin' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Địa chỉ giao hàng</h6>
                            <div class="shipping-info">
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="icon-wrapper me-3 mt-1">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Địa chỉ</small>
                                            <span class="fw-semibold">{{ $order->shipping_address ?? 'Không có thông tin' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper me-3">
                                            <i class="fas fa-truck text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Phương thức giao hàng</small>
                                            <span class="fw-semibold">{{ $order->shipping_method ?? 'Giao hàng tiêu chuẩn' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-box me-2"></i>
                        Sản phẩm đã đặt
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 ps-4">Sản phẩm</th>
                                    <th class="border-0 text-center">Số lượng</th>
                                    <th class="border-0 text-center">Đơn giá</th>
                                    <th class="border-0 text-end pe-4">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="product-image me-3">
                                                @if($detail->product->image)
                                                <img src="{{ asset('storage/' . $detail->product->image) }}" 
                                                     alt="{{ $detail->product->name }}" 
                                                     class="rounded" width="60" height="60">
                                                @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ $detail->product->name }}</h6>
                                                @if($detail->product->description)
                                                <small class="text-muted">{{ Str::limit($detail->product->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ $detail->quantity }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-semibold">{{ number_format($detail->price) }}đ</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="fw-bold text-primary">{{ number_format($detail->price * $detail->quantity) }}đ</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-calculator me-2"></i>
                        Tổng kết đơn hàng
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="order-summary">
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tạm tính:</span>
                                    <span class="fw-semibold">{{ number_format($order->subtotal ?? $order->total_amount) }}đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Phí vận chuyển:</span>
                                    <span class="fw-semibold">{{ number_format($order->shipping_fee ?? 0) }}đ</span>
                                </div>
                                @if($order->discount_amount > 0)
                                <div class="d-flex justify-content-between mb-3 text-success">
                                    <span>Giảm giá:</span>
                                    <span class="fw-semibold">-{{ number_format($order->discount_amount) }}đ</span>
                                </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="h5 mb-0">Tổng cộng:</span>
                                    <span class="h5 mb-0 text-danger fw-bold">{{ number_format($order->total_amount) }}đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-credit-card me-2"></i>
                        Thông tin thanh toán
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper me-3">
                                    <i class="fas fa-money-check-alt text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Phương thức thanh toán</small>
                                    <span class="fw-semibold">{{ $order->payment_method ?? 'Thanh toán khi nhận hàng' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper me-3">
                                    @if($order->payment_status == 'paid')
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-clock text-warning"></i>
                                    @endif
                                </div>
                                <div>
                                    <small class="text-muted d-block">Trạng thái thanh toán</small>
                                    @if($order->payment_status == 'paid')
                                    <span class="fw-semibold text-success">Đã thanh toán</span>
                                    @else
                                    <span class="fw-semibold text-warning">Chưa thanh toán</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Quay lại danh sách
                        </a>
                        
                        @if($order->status == 'pending')
                        <button class="btn btn-outline-danger" onclick="cancelOrder({{ $order->id }})">
                            <i class="fas fa-times me-2"></i>
                            Hủy đơn hàng
                        </button>
                        @endif
                        
                        <button class="btn btn-success" onclick="printOrder()">
                            <i class="fas fa-print me-2"></i>
                            In đơn hàng
                        </button>
                        
                        @if($order->status == 'completed')
                        <a href="{{ route('orders.reorder', $order->id) }}" class="btn btn-primary">
                            <i class="fas fa-redo me-2"></i>
                            Đặt lại đơn hàng
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Timeline Styles */
.timeline {
    position: relative;
    padding-left: 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 25px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
    padding-left: 60px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border: 3px solid #dee2e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.timeline-item.active .timeline-marker {
    background: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.timeline-item.cancelled .timeline-marker {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}

.timeline-content h6 {
    margin-bottom: 0.25rem;
    font-weight: 600;
}

/* Card Styles */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.icon-wrapper {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

/* Table Styles */
.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
}

.product-image img {
    object-fit: cover;
}

/* Order Summary */
.order-summary {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

/* Responsive */
@media (max-width: 768px) {
    .timeline {
        padding-left: 0;
    }
    
    .timeline::before {
        left: 15px;
    }
    
    .timeline-item {
        padding-left: 50px;
    }
    
    .timeline-marker {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
}

/* Print Styles */
@media print {
    .btn, .breadcrumb {
        display: none !important;
    }
    
    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
    }
    
    .timeline::before {
        background: #000 !important;
    }
    
    .timeline-marker {
        border-color: #000 !important;
    }
}
</style>

<script>
function cancelOrder(orderId) {
    if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
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
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi hủy đơn hàng');
            });
    }
}

function printOrder() {
    window.print();
}

// Add smooth scroll to timeline
document.addEventListener('DOMContentLoaded', function() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    timelineItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
        item.classList.add('animate-slide-in');
    });
});
</script>

<style>
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in {
    animation: slideIn 0.6s ease-out forwards;
}
</style>
@endsection