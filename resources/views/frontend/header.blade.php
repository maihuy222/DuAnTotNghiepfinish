<header class="header">
    <!-- Top Header Section -->
    <div class="top-header py-3">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-md-3 col-sm-4 text-center text-sm-start">
                    <div class="main-logo">
                        <a href="{{ url('index.html') }}">
                            <img src="{{ asset('assets/images/takex_logo_clean.png') }}" alt="logo" class="img-fluid">
                        </a>

                    </div>
                </div>

                <!-- Search Bar -->
                <div class="col-lg-6 col-md-5 d-none d-md-block">
                    <div class="search-container">
                        <div class="search-bar d-flex align-items-center rounded-pill bg-white shadow-sm">
                            <div class="category-select px-3">
                                <select class="form-select border-0 bg-transparent">
                                    <option>Tất cả danh mục</option>
                                    <option>Thực phẩm</option>
                                    <option>Đồ uống</option>
                                    <option>Chocolate</option>
                                </select>
                            </div>
                            <div class="search-input flex-grow-1">
                                <form id="search-form" action="index.html" method="post">
                                    <input type="text" class="form-control border-0 bg-transparent"
                                        placeholder="Tìm kiếm hơn 20,000 sản phẩm..." />
                                </form>
                            </div>
                            <button class="search-btn btn btn-primary rounded-circle me-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- User Actions -->
                <div class="col-lg-4 col-md-4 col-sm-8 d-flex justify-content-end align-items-center">
                    <!-- Support Info -->
                    <!-- Action Buttons -->
                    <div class="user-actions d-flex gap-2">
                        <!-- User Account -->
                        @auth
                        <div class="user-dropdown">
                            <button class="user-toggle btn btn-outline-light d-flex align-items-center gap-2"
                                onclick="toggleDropdown()">
                                <i class="fas fa-user"></i>
                                <span class="d-none d-sm-inline">Chào, {{ Auth::user()->name }}</span>
                            </button>
                            <div id="dropdownMenu" class="dropdown-menu shadow">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="logout-btn dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="action-btn btn btn-outline-light rounded-circle"
                            title="Đăng nhập">
                            <i class="fas fa-user"></i>
                        </a>
                        @endauth

                        <!-- Wishlist -->
                        <a href="#" class="action-btn btn btn-outline-light rounded-circle" title="Yêu thích">
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
                        <button class="cart-toggle btn btn-outline-light d-flex align-items-center gap-2"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                            aria-controls="offcanvasCart">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cart-details text-start">
                                <div class="cart-label small text-muted">Giỏ hàng</div>
                                <div class="cart-total fw-bold">$1,290.00</div>
                            </div>
                        </button>
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
                            @foreach ($navCategories as $category)
                            <li class="nav-item">
                                <a href="{{ url('category/' . $category->slug) }}"
                                    class="nav-link text-white px-3 py-2 rounded-pill">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>

                        <!-- More Categories Dropdown -->
                        <div class="more-categories">
                            <select class="form-select border-0 bg-transparent text-white"
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