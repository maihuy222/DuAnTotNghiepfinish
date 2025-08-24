<header class="header">
    <!-- Top Header Section -->
    <div class="top-header py-3">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-md-3 col-sm-4 text-center text-sm-start">
                    <div class="main-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/takex_logo_clean.png') }}" alt="logo" class="img-fluid">
                        </a>

                    </div>
                </div>

                <!-- Search Bar -->
                <div class="col-lg-6 col-md-5 d-none d-md-block position-relative">
                    <form action="{{ route('search') }}" method="get" autocomplete="off">
                        <div class="input-group rounded-pill overflow-hidden bg-light">
                            <input type="text" name="q" id="searchInput"
                                class="form-control border-0 px-4 py-2"
                                placeholder="Bạn đang muốn tìm sản phẩm gì ?"
                                aria-label="Bạn đang muốn tìm sản phẩm gì ?">
                            <button class="btn btn-dark px-4" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <!-- Gợi ý -->
                        <ul id="autocompleteList" class="list-group position-absolute w-100 z-3 mt-1 bg-white rounded"></ul>
                    </form>
                </div>




                <!-- User Actions -->
                <div class="col-lg-4 col-md-4 col-sm-8 d-flex justify-content-end align-items-center">
                    <!-- Support Info -->
                    <!-- Action Buttons -->
                    <div class="user-actions d-flex gap-2">
                        <!-- User Account -->
                        <div class="user-dropdown">
                            @auth
                            <button class="user-toggle btn btn-outline-light d-flex align-items-center gap-2"
                                onclick="toggleDropdown()">
                                <i class="fas fa-user"></i>
                                <span class="d-none d-sm-inline">Chào, {{ Auth::user()->name }}</span>
                            </button>
                            <div id="dropdownMenu" class="dropdown-menu shadow">

                                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                    @csrf
                                    <button type="submit" class="logout-btn dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </button>
                                </form>
                                <div>
                                    <a href="{{ route('profile') }}" class="dropdown-item">
                                        <i class="fas fa-id-badge me-2"></i>Hồ sơ
                                    </a>
                                </div>
                            
                            </div>

                            @else
                            <a href="{{ route('login') }}"
                                class="btn btn-outline-light d-flex align-items-center gap-2 px-3 py-2 rounded-pill transition"
                                style="background: white; border: 1px solid black; color: black; transition: all 0.3s ease;"
                                title="Đăng nhập">
                                <i class="fas fa-user"></i>
                                <span>Đăng nhập</span>
                            </a>
                            @endauth

                        </div>
                        <!-- Wishlist -->
                        <a href="{{ route('favorites.index') }}"
                            class="action-btn btn btn-outline-light rounded-circle"
                            title="Yêu thích">
                            <i class="fas fa-heart"></i>
                        </a>



                        <!-- Mobile Search -->
                        <a href="#" class="action-btn btn btn-outline-light rounded-circle d-md-none"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch"
                            aria-controls="offcanvasSearch" title="Tìm kiếm">
                            <i class="fas fa-search"></i>
                        </a>

                        <!-- Mobile Cart -->
                        <a href="#" class="action-btn btn btn-outline-light rounded-circle d-lg-none"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                            aria-controls="offcanvasCart" title="Giỏ hàng">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>

                    <!-- Desktop Cart -->
                    <div class="cart-info d-none d-lg-block ms-3">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-light d-flex align-items-center gap-2">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cart-details text-start">
                                <div class="cart-label small text-muted">Giỏ hàng</div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="navigation navbar navbar-expand-lg py-2">
        <div class="container">
            <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <i class="fas fa-bars text-white"></i>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <!-- Main Categories -->
                        <ul class="navbar-nav menu-list d-flex gap-md-3 mb-0">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link text-white px-3 py-2 rounded-pill">Trang chủ</a>
                            </li>
                            @foreach ($navCategories as $category)
                            <li class="nav-item">
                                <a href="{{ url('category/' . $category->slug) }}"
                                    class="nav-link text-white px-3 py-2 rounded-pill">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                            <li class="nav-item">
                                <a href="{{ url('/blog') }}" class="nav-link text-white px-3 py-2 rounded-pill">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/about') }}" class="nav-link text-white px-3 py-2 rounded-pill">Về chúng tôi</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/contact') }}" class="nav-link text-white px-3 py-2 rounded-pill">Liên hệ</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link text-white px-3 py-2 rounded-pill">Tất cả</a>
                            </li>
                            @auth
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link text-white px-3 py-2 rounded-pill">
                                    Lịch sử mua hàng
                                </a>
                            </li>
                            @endauth



                        </ul>

                        <!-- More Categories Dropdown -->
                        <div class="more-categories">
                            <select class="form-select border-0 bg-transparent text-black"
                                onchange="if (this.value) window.location.href = '/category/' + this.value;">
                                <option selected disabled>Xem thêm danh mục</option>
                                @foreach ($otherCategories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Required CSS for styling -->


<!-- Required JavaScript -->
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdownMenu');
        const toggle = document.querySelector('.user-toggle');

        if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
</script>