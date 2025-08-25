@extends('frontend.layout')
@section('content')

<style>
    /* Tối ưu riêng cho slider đầu trang */
    .main-swiper .banner-content {
        min-height: 520px; /* tăng chiều cao để dễ căn giữa */
    }
    .main-swiper .banner-content .content-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: center; /* căn giữa theo trục dọc */
    }
    .main-swiper .banner-content .img-wrapper {
        display: flex;
        align-items: center; /* căn giữa dọc ảnh trong cột */
        justify-content: center; /* căn giữa ngang ảnh trong cột */
    }
    .main-swiper .banner-content .img-wrapper img {
        width: 100%;
        max-width: 520px; /* tăng kích thước ảnh tối đa */
        height: auto;
        object-fit: contain;
    }

    /* Responsive: giảm nhẹ kích thước trên màn hình nhỏ */
    @media (max-width: 991.98px) {
        .main-swiper .banner-content { min-height: 420px; }
        .main-swiper .banner-content .img-wrapper img { max-width: 420px; }
    }
    @media (max-width: 575.98px) {
        .main-swiper .banner-content { min-height: 360px; }
        .main-swiper .banner-content .img-wrapper img { max-width: 320px; }
    }

    /* Toast thông báo góc dưới phải (dùng cho yêu thích) */
    #notify-container-br {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-end;
    }
    .notify-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        min-width: 280px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        color: #0f5132;
        background: #d1e7dd;
        border: 1px solid #badbcc;
        animation: slideIn .25s ease-out;
    }
    .notify-card.error {
        color: #842029;
        background: #f8d7da;
        border-color: #f5c2c7;
    }
    .notify-icon {
        width: 28px; height: 28px; border-radius: 50%;
        display: grid; place-items: center; background: #198754; color: #fff;
    }
    .notify-card.error .notify-icon { background: #dc3545; }
    .notify-close { border: none; background: transparent; color: inherit; }
    @keyframes slideIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
</style>

<section class="py-3" style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="banner-blocks">

                    <div class="banner-ad large bg-info block-1">

                        <div class="swiper main-swiper">
                            <div class="swiper-wrapper">
                                @foreach($sliders as $slider)
                                <div class="swiper-slide">
                                    <div class="row banner-content p-5 align-items-center">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories my-3">100% natural</div>
                                            <h3 class="display-4">{{ $slider->title }}</h3>
                                            <p>Thực phẩm sạch đảm bảo sức khỏe cho bạn và gia đình.</p>
                                            <a href="{{ $slider->link }}" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop Now</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="{{ asset('storage/' . $slider->image) }}" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <div class="swiper-pagination"></div>

                        </div>
                    </div>

                    <div class="banner-ad bg-success-subtle block-2" style="background:url('images/ad-image-1.png') no-repeat;background-position: right bottom">
                        <div class="row banner-content p-5">

                            <div class="content-wrapper col-md-7">
                                <div class="categories sale mb-3 pb-3">20% off</div>
                                <h3 class="banner-title">Fruits & Vegetables</h3>
                                <a href="{{ url('category/do-chay') }}" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>

                    <div class="banner-ad bg-danger block-3" style="background:url('images/ad-image-2.png') no-repeat;background-position: right bottom">
                        <div class="row banner-content p-5">

                            <div class="content-wrapper col-md-7">
                                <div class="categories sale mb-3 pb-3">15% off</div>
                                <h3 class="item-title">Baked Products</h3>
                                <a href="{{ url('category/trang-mieng') }}" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg></a>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- / Banner Blocks -->

            </div>
        </div>
    </div>
</section>

<section class="py-4 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Category</h2>

                    <div class="d-flex align-items-center">
                        <a href="#" class="btn-link text-decoration-none">View All Categories →</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                            <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                {{-- Carousel danh mục --}}
                <div class="row">
                    <div class="col-md-12">

                        <div class="category-carousel swiper">
                            <div class="swiper-wrapper">
                                @foreach($categories as $category)
                                <a href="{{ url('category/' . $category->slug) }}" class="nav-link category-item swiper-slide">

                                    <h3 class="category-title">{{ $category->name }}</h3>
                                </a>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<section class="py-4">
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="bootstrap-tabs product-tabs">
                    <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                        <h3>Sản phẩm thịnh Hành</h3>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a href="#" class="nav-link text-uppercase fs-6 active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all">All</a>
                                <a href="#" class="nav-link text-uppercase fs-6" id="nav-fruits-tab" data-bs-toggle="tab" data-bs-target="#nav-fruits">Fruits & Veges</a>
                                <a href="#" class="nav-link text-uppercase fs-6" id="nav-juices-tab" data-bs-toggle="tab" data-bs-target="#nav-juices">Juices</a>
                            </div>
                        </nav>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

                            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">


                                @foreach ($trendingProducts as $product)
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
                                                    @auth
                                                    @php
                                                        $isFavorite = \App\Models\Favorite::where('user_id', Auth::id())
                                                            ->where('product_id', $product->id)
                                                            ->exists();
                                                    @endphp
                                                    <button type="button" class="btn btn-sm rounded-circle action-btn favorite-toggle {{ $isFavorite ? 'btn-danger' : 'btn-light' }}" data-product-id="{{ $product->id }}" title="{{ $isFavorite ? 'Bỏ yêu thích' : 'Thêm yêu thích' }}">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                    @else
                                                    <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-circle action-btn" title="Đăng nhập để yêu thích">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                    @endauth
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
                                                @php
                                                    $avg = round(($product->avg_rating ?? 0), 1);
                                                    $full = floor($avg);
                                                    $hasHalf = ($avg - $full) >= 0.5;
                                                @endphp
                                                <div class="small" style="color: #FFD700;"> <!-- vàng đậm -->
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
                            <!-- / product-grid -->

                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="banner-ad bg-info" style="background: url('{{ asset('assets/images/nenthucan.jpg') }}'); background-repeat: no-repeat; background-position: right bottom;">
                    <div class="banner-content p-5">

                        <div class="categories text-primary fs-3 fw-bold">Siêu siêu ngon</div>
                        <h3 class="banner-title">Đồ ăn</h3>
                        <p>"No bụng mới ấm lòng, chứ yêu đương không ăn được đâu!</p>
                        <a href="{{ url('category/do-an') }}" class="btn btn-dark text-uppercase">Mua ngay</a>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-ad bg-info" style="background: url('{{ asset('assets/images/nentrasua.jpg') }}'); background-repeat: no-repeat; background-position: right bottom;">
                    <div class="banner-content p-5">

                        <div class="categories text-primary fs-3 fw-bold">Siêu siêu ngon</div>
                        <h3 class="banner-title">Đồ uống</h3>
                        <p>Tiền không mua được tất cả, nhưng mua được trà sữa – là đủ rồi</p>
                        <a href="{{ url('category/do-uong')}}" class="btn btn-dark text-uppercase">Mua ngay</a>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<section class="py-4 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Section Header -->
                <div class="section-header d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <h2 class="section-title mb-0">🔥 Sản phẩm bán chạy nhất</h2>

                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="btn-link text-decoration-none">Xem tất cả danh mục →</a>
                        <div class="swiper-buttons d-flex gap-2">
                            <button class="swiper-prev products-carousel-prev btn btn-primary" aria-label="Trước">❮</button>
                            <button class="swiper-next products-carousel-next btn btn-primary" aria-label="Sau">❯</button>
                        </div>
                    </div>
                </div>

                <!-- Products Carousel -->
                <div class="row">
                    @foreach($bestSelling as $product)
                    <div class="col-2 mb-4">
                        <div class="card h-100 product-card shadow-sm">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
                                    <img src="{{ asset($product->image) }}" class="tab-image product-image" alt="{{ $product->name }}">
                                </a>

                                <div class="product-overlay d-flex align-items-center justify-content-center">
                                    <div class="d-flex gap-2">
                                        {{-- Nút xem chi tiết --}}
                                        <a href="{{ route('product.show', $product->slug) }}"
                                            class="btn btn-light btn-sm rounded-circle action-btn"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Nút yêu thích dùng AJAX đồng nhất --}}
                                        @auth
                                        <button type="button"
                                            class="btn btn-light btn-sm rounded-circle action-btn favorite-toggle"
                                            data-product-id="{{ $product->id }}"
                                            title="Thêm yêu thích">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('login') }}"
                                            class="btn btn-light btn-sm rounded-circle action-btn"
                                            title="Đăng nhập để yêu thích">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                        @endauth
                                    </div>
                                </div>

                                {{-- Badge giảm giá --}}
                                @if(isset($product->discount) && $product->discount > 0)
                                <div class="position-absolute top-0 start-0 p-2">
                                    <span class="badge bg-danger">-{{ $product->discount }}%</span>
                                </div>
                                @endif
                            </div>

                            <div class="card-body p-3">
                                <h6 class="card-title product-name">
                                    <a href="{{ route('product.show', $product->slug) }}"
                                        title="{{ $product->name }}"
                                        class="text-decoration-none text-dark">
                                        {{ $product->name }}
                                    </a>
                                </h6>

                                {{-- Đánh giá --}}
                                  <div class="d-flex align-items-center mb-2 rating-section">
                                                @php
                                                    $avg = round(($product->avg_rating ?? 0), 1);
                                                    $full = floor($avg);
                                                    $hasHalf = ($avg - $full) >= 0.5;
                                                @endphp
                                                <div class="small" style="color: #FFD700;"> <!-- vàng đậm -->
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


                                {{-- Giá --}}
                                <div class="price-section">
                                    <span style="font-weight: 800; color: #b20000; font-size: 0.8rem;">
                                        {{ number_format($product->price, 0, ',', '.') }}₫
                                    </span>

                                    @if(isset($product->original_price) && $product->original_price > $product->price)
                                    <div class="text-muted small text-decoration-line-through">
                                        {{ number_format($product->original_price, 0, ',', '.') }}₫
                                    </div>
                                    @endif
                                </div>

                                {{-- Nút thêm giỏ hàng --}}
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

                <!-- Swiper Controls -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- /products-carousel -->

        </div>
    </div>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <div class="bg-warning rounded-5 text-dark"
            style="background: url('images/food-banner.png') no-repeat right center/contain; min-height: 400px;">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-md-6 p-4">
                        <div class="section-header">
                            <h2 class="section-title display-5 fw-bold">
                                🚀 Giao hàng tận nơi 
                            </h2>
                        </div>
                        <p class="lead">
                            Đặt món ăn yêu thích chỉ với vài cú click.
                            Thức ăn nóng hổi, hương vị thơm ngon, phục vụ nhanh chóng ngay tại nhà bạn.
                        </p>
                        <div class="mt-4">
                            <a href="{{ url('/products') }}" class="btn btn-danger btn-lg rounded-pill px-4">
                                Xem thực đơn
                            </a>
                         
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('frontend/assets/img/giaohang.png') }}"
                            alt="Giao hàng nhanh"
                            class="img-fluid"
                            style="max-height: 320px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="py-5 overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex justify-content-between">

                    <h2 class="section-title">Sản phẩm nổi bật nhất </h2>

                    <div class="d-flex align-items-center">
                        <a href="#" class="btn-link text-decoration-none">View All Categories →</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                            <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="products-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($featuredProducts as $product)
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
                                            @auth
                                            @php
                                                $isFavorite = \App\Models\Favorite::where('user_id', Auth::id())
                                                    ->where('product_id', $product->id)
                                                    ->exists();
                                            @endphp
                                            <button type="button" class="btn btn-sm rounded-circle action-btn favorite-toggle {{ $isFavorite ? 'btn-danger' : 'btn-light' }}" data-product-id="{{ $product->id }}" title="{{ $isFavorite ? 'Bỏ yêu thích' : 'Thêm yêu thích' }}">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-circle action-btn" title="Đăng nhập để yêu thích">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                            @endauth
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
                                                @php
                                                    $avg = round(($product->avg_rating ?? 0), 1);
                                                    $full = floor($avg);
                                                    $hasHalf = ($avg - $full) >= 0.5;
                                                @endphp
                                                <div class="small" style="color: #FFD700;"> <!-- vàng đậm -->
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
                                    <span style="font-weight: 800; color: #ec1313ff; font-size: 0.8rem;">
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
                </div>
                <!-- / products-carousel -->

            </div>
        </div>
    </div>
</section>

<section class="py-4 overflow-hidden">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex justify-content-between">

                    <h2 class="section-title">Sản phẩm mới nhất</h2>

                    <div class="d-flex align-items-center">
                        <a href="#" class="btn-link text-decoration-none">View All Categories →</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                            <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="products-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($latestProducts as $product)
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
                                            @auth
                                            @php
                                                $isFavorite = \App\Models\Favorite::where('user_id', Auth::id())
                                                    ->where('product_id', $product->id)
                                                    ->exists();
                                            @endphp
                                            <button type="button" class="btn btn-sm rounded-circle action-btn favorite-toggle {{ $isFavorite ? 'btn-danger' : 'btn-light' }}" data-product-id="{{ $product->id }}" title="{{ $isFavorite ? 'Bỏ yêu thích' : 'Thêm yêu thích' }}">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-circle action-btn" title="Đăng nhập để yêu thích">
                                                <i class="fas fa-heart"></i>
                                            </a>
                                            @endauth
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
                                                @php
                                                    $avg = round(($product->avg_rating ?? 0), 1);
                                                    $full = floor($avg);
                                                    $hasHalf = ($avg - $full) >= 0.5;
                                                @endphp
                                                <div class="small" style="color: #FFD700;"> <!-- vàng đậm -->
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


                                {{-- Giá --}}
                                <div class="price-section">
                                    <span style="font-weight: 800; color: #b20000; font-size: 0.8rem;">
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
                </div>
                <!-- / products-carousel -->

            </div>
        </div>
    </div>
</section>

<section id="latest-blog" class="py-4">
    <div class="container py-4">
        <div class="row">
            <div class="section-header d-flex align-items-center justify-content-between my-5">
                <h2 class="section-title">Bài viết </h2>
                <div class="btn-wrap align-right">
                    <a href="{{ route('blog.index') }}" class="d-flex align-items-center nav-link">
                        Read All Articles
                        <svg width="24" height="24">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="blog-grid">
            @foreach($posts as $post)
            <article class="blog-card" data-category="{{ $post->category_id }}">
                <a  href="{{ route('blog.show', $post->id) }}">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="blog-image">
                </a>
                <div class="blog-content">
                    <a href="{{ route('blog.show', $post->id) }}"><span class="blog-category">{{ $post->postcategory->name }}</span></a>
                        <a href="{{ route('blog.show', $post->id) }}" style="text-decoration:none; color:inherit;">
                        <h2 class="blog-title">{{ $post->title }}</h2>
                    </a>

                    <p class="blog-excerpt">
                        {!! \Illuminate\Support\Str::limit($post->content, 100) !!}

                    </p>

                    <div class="blog-meta">
                       
                        <span class="date">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</span>
                    </div>
                    <a href="{{ route('blog.show', $post->id) }}" class="read-more">Đọc tiếp</a>

                </div>
            </article>
            @endforeach
        </div>


</section>


</div>


<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>

<script>
    // Add to Cart Function
    function addToCart(productId) {
        const quantityInput = document.getElementById(`quantity_${productId}`);
        const quantity = quantityInput ? quantityInput.value : 1;

        // Show loading state
        const button = document.querySelector(`[data-product-id="${productId}"]`);
        const originalText = button.innerHTML;
        button.innerHTML = '<iconify-icon icon="eos-icons:loading" width="16"></iconify-icon> Adding...';
        button.style.pointerEvents = 'none';

        // Gọi đúng route có id
        fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    quantity: quantity
                    // Nếu cần thêm price, size_id thì truyền thêm ở đây
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.innerHTML = '<iconify-icon icon="material-symbols:check" width="16"></iconify-icon> Added!';
                    button.style.color = '#28a745';
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.style.color = '';
                        button.style.pointerEvents = '';
                    }, 2000);
                    showNotification('Product added to cart successfully!', 'success');
                } else {
                    throw new Error(data.message || 'Failed to add product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.innerHTML = originalText;
                button.style.pointerEvents = '';
                showNotification('Error adding product to cart', 'error');
            });
    }

    // Quantity Controls
    document.addEventListener('DOMContentLoaded', function() {
        // Minus button
        document.querySelectorAll('.quantity-left-minus').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                const currentValue = parseInt(input.value) || 1;
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });

        // Plus button
        document.querySelectorAll('.quantity-right-plus').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const currentValue = parseInt(input.value) || 1;
                input.value = currentValue + 1;
                input.dispatchEvent(new Event('change'));
            });
        });

        // Input validation
        document.querySelectorAll('input[name="quantity"]').forEach(input => {
            input.addEventListener('change', function() {
                const value = parseInt(this.value) || 1;
                if (value < 1) {
                    this.value = 1;
                } else if (value > 99) {
                    this.value = 99;
                }
            });
        });
    });

    // Notification Function
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    // Notification bottom-right for favorites
    function ensureNotifyContainerBR() {
        let container = document.getElementById('notify-container-br');
        if (!container) {
            container = document.createElement('div');
            container.id = 'notify-container-br';
            document.body.appendChild(container);
        }
        return container;
    }

    function showNotificationBR(message, type = 'success') {
        const container = ensureNotifyContainerBR();
        const card = document.createElement('div');
        card.className = `notify-card ${type === 'error' ? 'error' : ''}`;
        card.innerHTML = `
            <span class="notify-icon">
                <i class="fas ${type === 'error' ? 'fa-times' : 'fa-check'}"></i>
            </span>
            <span>${message}</span>
            <button class="notify-close" aria-label="Đóng">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(card);
        const closer = card.querySelector('.notify-close');
        closer.addEventListener('click', () => card.remove());
        setTimeout(() => card.remove(), 4000);
    }

    // Initialize Swiper (if not already initialized globally)
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            // Main header slider
            new Swiper('.main-swiper', {
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                }
            });

            new Swiper('.products-carousel', {
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 5,
                    }
                }
            });
        }

        // Toggle yêu thích qua AJAX cho mọi nút .favorite-toggle
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
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.text();
                })
                .then((html) => {
                    // Nếu server trả về redirect HTML, vẫn coi là thành công
                    const isRemoving = btn.classList.contains('btn-danger');
                    if (isRemoving) {
                        showNotificationBR('Đã bỏ yêu thích sản phẩm', 'success');
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-light');
                        btn.setAttribute('title', 'Thêm yêu thích');
                    } else {
                        showNotificationBR('Đã thêm sản phẩm yêu thích', 'success');
                        btn.classList.remove('btn-light');
                        btn.classList.add('btn-danger');
                        btn.setAttribute('title', 'Bỏ yêu thích');
                    }
                })
                .catch(() => {
                    showNotification('Có lỗi khi thêm yêu thích', 'error');
                });
            });
        });
    });
</script>
@endsection