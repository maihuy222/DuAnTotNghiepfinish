@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Hồ sơ cá nhân</h2>
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 mb-4">
            <div class="list-group">
                <a href="#tab-info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Thông tin cá nhân</a>
                <a href="#tab-password" class="list-group-item list-group-item-action" data-bs-toggle="tab">Đổi mật khẩu</a>
                <a href="#tab-orders" class="list-group-item list-group-item-action" data-bs-toggle="tab">Đơn hàng của tôi</a>
            </div>
        </div>

        {{-- Tab Content --}}
        <div class="col-md-9">
            <div class="tab-content">
                {{-- Tab Thông tin --}}
                <div class="tab-pane fade show active" id="tab-info">
                    <form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-center">
                            @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                            @else
                            <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            @endif
                            <div class="mt-2">
                                <input type="file" name="avatar" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{ auth()->user()->phone }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea name="address" class="form-control" rows="3">{{ auth()->user()->address }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>

                {{-- Tab Mật khẩu --}}
                <div class="tab-pane fade" id="tab-password">
                    <form action="{{ url('/profile/change-password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
                    </form>
                </div>

                {{-- Tab Đơn hàng --}}
                <div class="tab-pane fade" id="tab-orders">
                    <h5>Danh sách đơn hàng</h5>
                    @if ($orders->isEmpty())
                    <p>Bạn chưa có đơn hàng nào.</p>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ number_format($order->total, 0, ',', '.') }}đ</td>
                                    <td>
                                        <a href="{{ url('/orders/' . $order->id) }}" class="btn btn-sm btn-outline-info">Chi tiết</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script giữ lại tab đang mở --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hash = window.location.hash;
        if (hash) {
            const tabTrigger = document.querySelector(`a[href="${hash}"]`);
            if (tabTrigger) {
                new bootstrap.Tab(tabTrigger).show();
            }
        }

        // Cập nhật hash trên URL khi chuyển tab
        const tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(event) {
                history.replaceState(null, null, event.target.getAttribute('href'));
            });
        });
    });
</script>
@endsection