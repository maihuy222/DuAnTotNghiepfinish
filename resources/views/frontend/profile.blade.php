@extends('frontend.layout')

@section('content')
<div class="profile-wrapper">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-cover">
            <div class="cover-image"></div>
            <div class="cover-overlay"></div>
        </div>

        <div class="container">
            <div class="profile-info">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-end">
                            <!-- Avatar -->
                            <div class="profile-avatar-wrapper">
                                <div class="profile-avatar">
                                    @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar">
                                    @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                    @endif
                                    <div class="avatar-edit" onclick="document.getElementById('avatarInput').click()">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </div>
                                <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                            </div>

                            <!-- User Info -->
                            <div class="user-info ms-4">
                                <h1 class="user-name">{{ auth()->user()->name }}</h1>
                                <p class="user-email">{{ auth()->user()->email }}</p>
                                <div class="user-stats">
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $totalOrders ?? 0 }}</span>
                                        <span class="stat-label">Đơn hàng</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $totalSpent ?? 0 }}đ</span>
                                        <span class="stat-label">Đã chi tiêu</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $memberSince ?? 'N/A' }}</span>
                                        <span class="stat-label">Thành viên từ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-end">
                        <div class="profile-actions">
                            <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="fas fa-edit me-2"></i>
                                Chỉnh sửa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="profile-sidebar">
                        <nav class="profile-nav">
                            <a href="#overview" class="nav-item active" data-tab="overview">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Tổng quan</span>
                            </a>
                            <a href="#orders" class="nav-item" data-tab="orders">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Đơn hàng</span>
                                <span class="badge">{{ $totalOrders ?? 0 }}</span>
                            </a>
                            <a href="#addresses" class="nav-item" data-tab="addresses">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Địa chỉ</span>
                            </a>
                            <a href="#security" class="nav-item" data-tab="security">
                                <i class="fas fa-shield-alt"></i>
                                <span>Bảo mật</span>
                            </a>
                            <a href="#notifications" class="nav-item" data-tab="notifications">
                                <i class="fas fa-bell"></i>
                                <span>Thông báo</span>
                            </a>
                            <a href="#settings" class="nav-item" data-tab="settings">
                                <i class="fas fa-cog"></i>
                                <span>Cài đặt</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <!-- Overview Tab -->
                    <div id="overview-tab" class="tab-content active">
                        <div class="row">
                            <!-- Quick Stats -->
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-primary">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="stat-details">
                                        <h3>{{ $totalOrders ?? 0 }}</h3>
                                        <p>Tổng đơn hàng</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-success">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="stat-details">
                                        <h3>{{ $completedOrders ?? 0 }}</h3>
                                        <p>Đã hoàn thành</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-warning">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-details">
                                        <h3>{{ $pendingOrders ?? 0 }}</h3>
                                        <p>Chờ xử lý</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="stat-card">
                                    <div class="stat-icon bg-info">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="stat-details">
                                        <h3>{{ number_format($totalSpent ?? 0) }}đ</h3>
                                        <p>Tổng chi tiêu</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-history me-2 text-primary"></i>
                                    Đơn hàng gần đây
                                </h5>
                                <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">
                                    Xem tất cả
                                </a>
                            </div>
                            <div class="card-body">
                                @if(isset($recentOrders) && $recentOrders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Đơn hàng</th>
                                                <th>Ngày</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng tiền</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentOrders as $order)
                                            <tr>
                                                <td>
                                                    <strong>#{{ $order->id }}</strong>
                                                </td>
                                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($order->status == 'completed')
                                                    <span class="badge bg-success">Hoàn tất</span>
                                                    @elseif($order->status == 'pending')
                                                    <span class="badge bg-warning">Chờ xử lý</span>
                                                    @elseif($order->status == 'processing')
                                                    <span class="badge bg-info">Đang xử lý</span>
                                                    @else
                                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td><strong>{{ number_format($order->total_amount) }}đ</strong></td>
                                                <td>
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                        Chi tiết
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="text-center py-4">
                                    <i class="fas fa-shopping-bag text-muted fa-3x mb-3"></i>
                                    <p class="text-muted">Chưa có đơn hàng nào</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Orders Tab -->
                    <div id="orders-tab" class="tab-content">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">
                                    <i class="fas fa-shopping-bag me-2 text-primary"></i>
                                    Tất cả đơn hàng
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('orders.index') }}" class="btn btn-primary">
                                        <i class="fas fa-external-link-alt me-2"></i>
                                        Xem chi tiết đơn hàng
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Addresses Tab -->
                    <div id="addresses-tab" class="tab-content">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                    Địa chỉ của tôi
                                </h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                    <i class="fas fa-plus me-2"></i>
                                    Thêm địa chỉ
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Default Address -->
                                    <div class="col-md-6 mb-4">
                                        <div class="address-card default">
                                            <div class="address-header">
                                                <h6>Địa chỉ mặc định</h6>
                                                <span class="badge bg-primary">Mặc định</span>
                                            </div>
                                            <div class="address-content">
                                                <p class="mb-1"><strong>{{ auth()->user()->name }}</strong></p>
                                                <p class="mb-1">{{ auth()->user()->phone ?? 'Chưa cập nhật SĐT' }}</p>
                                                <p class="mb-3 text-muted">{{ auth()->user()->address ?? 'Chưa cập nhật địa chỉ' }}</p>
                                                <div class="address-actions">
                                                    <button class="btn btn-sm btn-outline-primary me-2">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div id="security-tab" class="tab-content">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-transparent border-0">
                                        <h5 class="mb-0">
                                            <i class="fas fa-shield-alt me-2 text-primary"></i>
                                            Bảo mật tài khoản
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="changePasswordForm">
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu hiện tại</label>
                                                <input type="password" class="form-control" name="current_password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <input type="password" class="form-control" name="new_password" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Xác nhận mật khẩu mới</label>
                                                <input type="password" class="form-control" name="confirm_password" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>
                                                Cập nhật mật khẩu
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <i class="fas fa-shield-alt text-success fa-3x mb-3"></i>
                                        <h6>Tài khoản được bảo vệ</h6>
                                        <p class="text-muted small">Tài khoản của bạn được bảo vệ bởi mật khẩu mạnh và các biện pháp bảo mật.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div id="notifications-tab" class="tab-content">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">
                                    <i class="fas fa-bell me-2 text-primary"></i>
                                    Cài đặt thông báo
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="notification-settings">
                                    <div class="setting-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6>Thông báo đơn hàng</h6>
                                                <p class="text-muted small mb-0">Nhận thông báo khi có cập nhật đơn hàng</p>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6>Khuyến mãi</h6>
                                                <p class="text-muted small mb-0">Nhận thông báo về các chương trình khuyến mãi</p>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" checked>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6>Sản phẩm mới</h6>
                                                <p class="text-muted small mb-0">Thông báo về sản phẩm mới</p>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div id="settings-tab" class="tab-content">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">
                                    <i class="fas fa-cog me-2 text-primary"></i>
                                    Cài đặt tài khoản
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="danger-zone">
                                    <h6 class="text-danger">Vùng nguy hiểm</h6>
                                    <p class="text-muted">Các hành động này không thể hoàn tác</p>
                                    <button class="btn btn-outline-danger" onclick="confirmDeleteAccount()">
                                        <i class="fas fa-trash me-2"></i>
                                        Xóa tài khoản
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Chỉnh sửa thông tin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" name="birthday" value="{{ auth()->user()->birthday ?? '' }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control" name="address" rows="3">{{ auth()->user()->address ?? '' }}</textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="updateProfile()">
                    <i class="fas fa-save me-2"></i>
                    Lưu thay đổi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Thêm địa chỉ mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addAddressForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Địa chỉ chi tiết</label>
                            <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default" id="isDefault">
                                <label class="form-check-label" for="isDefault">
                                    Đặt làm địa chỉ mặc định
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="addAddress()">
                    <i class="fas fa-plus me-2"></i>
                    Thêm địa chỉ
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Profile Wrapper */
    .profile-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* Profile Header */
    .profile-header {
        position: relative;
        padding-bottom: 100px;
    }

   

    .cover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
    }

    .profile-info {
        position: relative;
        z-index: 10;
        padding-top: 150px;
    }

    /* Profile Avatar */
    .profile-avatar-wrapper {
        position: relative;
    }

    .profile-avatar {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 6px solid white;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
    }

    .avatar-edit {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background: #007bff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .avatar-edit:hover {
        background: #0056b3;
        transform: scale(1.1);
    }

    /* User Info */
    .user-name {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .user-email {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .user-stats {
        display: flex;
        gap: 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        display: block;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    /* Profile Content */
    .profile-content {
        margin-top: -50px;
        position: relative;
        z-index: 5;
    }

    /* Profile Sidebar */
    .profile-sidebar {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: sticky;
        top: 20px;
    }

    .profile-nav {
        display: flex;
        flex-direction: column;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        color: #6c757d;
        text-decoration: none;
        transition: all 0.3s ease;
        border-bottom: 1px solid #f8f9fa;
    }

    .nav-item:hover,
    .nav-item.active {
        background: #f8f9fa;
        color: #007bff;
        border-left: 4px solid #007bff;
    }

    .nav-item i {
        width: 20px;
        margin-right: 0.75rem;
    }

    .nav-item .badge {
        margin-left: auto;
        background: #007bff;
    }

    /* Tab Content */
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .stat-details h3 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .stat-details p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Address Card */
    .address-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .address-card:hover {
        transform: translateY(-2px);
    }

    .address-card.default {
        border: 2px solid #007bff;
    }

    .address-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .address-header h6 {
        margin: 0;
        font-weight: 600;
    }

    /* Notification Settings */
    .notification-settings .setting-item {
        padding: 1.5rem 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .notification-settings .setting-item:last-child {
        border-bottom: none;
    }

    .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }

    /* Danger Zone */
    .danger-zone {
        background: #fff5f5;
        border: 1px solid #fed7d7;
        border-radius: 10px;
        padding: 1.5rem;
    }

    .danger-zone h6 {
        color: #e53e3e;
        margin-bottom: 0.5rem;
    }

    /* Cards */
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .card-header {
        background: transparent !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Buttons */
    .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }

    /* Modal */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        padding: 1.5rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1.5rem;
    }

    /* Form Controls */
    .form-control,
    .form-select {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #495057;
    }

    /* Table */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    /* Badges */
    .badge {
        border-radius: 20px;
        padding: 0.5rem 1rem;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .profile-info {
            padding-top: 100px;
        }

        .user-name {
            font-size: 2rem;
        }

        .user-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .profile-sidebar {
            position: static;
            margin-bottom: 2rem;
        }

        .profile-nav {
            flex-direction: row;
            flex-wrap: wrap;
        }

        .nav-item {
            flex: 1;
            min-width: 150px;
            justify-content: center;
            text-align: center;
            border-right: 1px solid #f8f9fa;
            border-bottom: none;
        }

        .nav-item:last-child {
            border-right: none;
        }

        .nav-item.active {
            border-left: none;
            border-bottom: 4px solid #007bff;
        }
    }

    @media (max-width: 768px) {
        .profile-avatar {
            width: 120px;
            height: 120px;
        }

        .user-info {
            margin-left: 1rem !important;
            text-align: center;
        }

        .user-name {
            font-size: 1.8rem;
        }

        .profile-actions {
            text-align: center !important;
            margin-top: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .stat-details h3 {
            font-size: 1.5rem;
        }
    }

    /* Loading Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card,
    .card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Hover Effects */
    .profile-nav .nav-item {
        position: relative;
        overflow: hidden;
    }

    .profile-nav .nav-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .profile-nav .nav-item:hover::before {
        left: 100%;
    }

    /* Custom Scrollbar */
    .profile-sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .profile-sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .profile-sidebar::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 2px;
    }
</style>

<script>
    // Tab Navigation
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.nav-item');
        const tabContents = document.querySelectorAll('.tab-content');

        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all nav items and tab contents
                navItems.forEach(nav => nav.classList.remove('active'));
                tabContents.forEach(tab => tab.classList.remove('active'));

                // Add active class to clicked nav item
                this.classList.add('active');

                // Show corresponding tab content
                const tabId = this.getAttribute('data-tab') + '-tab';
                const targetTab = document.getElementById(tabId);
                if (targetTab) {
                    targetTab.classList.add('active');
                }
            });
        });
    });

    // Avatar Upload
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('avatar', file);

            // Upload avatar
            fetch('/profile/avatar', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update avatar preview
                        const avatar = document.querySelector('.profile-avatar img') ||
                            document.querySelector('.avatar-placeholder');
                        if (avatar.tagName === 'IMG') {
                            avatar.src = data.avatar_url;
                        } else {
                            avatar.parentElement.innerHTML = `<img src="${data.avatar_url}" alt="Avatar">`;
                        }

                        showToast('Cập nhật avatar thành công!', 'success');
                    } else {
                        showToast('Có lỗi xảy ra khi cập nhật avatar', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Có lỗi xảy ra khi cập nhật avatar', 'error');
                });
        }
    });

    // Update Profile
    function updateProfile() {
        const form = document.getElementById('editProfileForm');
        const formData = new FormData(form);

        fetch('/profile/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
                    modal.hide();

                    // Update UI
                    document.querySelector('.user-name').textContent = formData.get('name');
                    document.querySelector('.user-email').textContent = formData.get('email');

                    showToast('Cập nhật thông tin thành công!', 'success');

                    // Reload page after 1 second
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showToast(data.message || 'Có lỗi xảy ra', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra khi cập nhật thông tin', 'error');
            });
    }

    // Change Password
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Validate passwords match
        if (formData.get('new_password') !== formData.get('confirm_password')) {
            showToast('Mật khẩu xác nhận không khớp', 'error');
            return;
        }

        fetch('/profile/change-password', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.reset();
                    showToast('Đổi mật khẩu thành công!', 'success');
                } else {
                    showToast(data.message || 'Có lỗi xảy ra', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra khi đổi mật khẩu', 'error');
            });
    });

    // Add Address
    function addAddress() {
        const form = document.getElementById('addAddressForm');
        const formData = new FormData(form);

        fetch('/profile/addresses', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addAddressModal'));
                    modal.hide();

                    showToast('Thêm địa chỉ thành công!', 'success');

                    // Reload addresses tab
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showToast(data.message || 'Có lỗi xảy ra', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra khi thêm địa chỉ', 'error');
            });
    }

    // Confirm Delete Account
    function confirmDeleteAccount() {
        if (confirm('Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác!')) {
            if (confirm('Xác nhận lần cuối: Tất cả dữ liệu của bạn sẽ bị xóa vĩnh viễn!')) {
                deleteAccount();
            }
        }
    }

    // Delete Account
    function deleteAccount() {
        fetch('/profile/delete', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Tài khoản đã được xóa', 'success');
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                } else {
                    showToast(data.message || 'Có lỗi xảy ra', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra khi xóa tài khoản', 'error');
            });
    }

    // Toast Notification
    function showToast(message, type = 'info') {
        // Create toast container if it doesn't exist
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} border-0`;
        toast.setAttribute('role', 'alert');

        toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

        toastContainer.appendChild(toast);

        // Show toast
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        // Remove toast element after hiding
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    // Notification Settings
    document.querySelectorAll('.form-check-input').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const setting = this.closest('.setting-item').querySelector('h6').textContent;
            const isEnabled = this.checked;

            // Save notification setting
            fetch('/profile/notifications', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        setting: setting,
                        enabled: isEnabled
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(`Cài đặt ${setting.toLowerCase()} đã được ${isEnabled ? 'bật' : 'tắt'}`, 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isEnabled; // Revert checkbox state
                });
        });
    });

    // Smooth scroll to tab
    function scrollToTab(tabId) {
        const tab = document.getElementById(tabId);
        if (tab) {
            tab.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // Add loading states to buttons
    document.querySelectorAll('button[onclick]').forEach(button => {
        const originalOnclick = button.getAttribute('onclick');
        button.addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

            setTimeout(() => {
                this.disabled = false;
                this.innerHTML = this.innerHTML.replace('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...', this.textContent);
            }, 2000);
        });
    });
</script>
@endsection