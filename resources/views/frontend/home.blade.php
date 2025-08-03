@extends('frontend.layout')
@section('content')

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
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories my-3">100% natural</div>
                                            <h3 class="display-4">{{ $slider->title }}</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
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
                                <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24">
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
                                <a href="#" class="d-flex align-items-center nav-link">Shop Collection <svg width="24" height="24">
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
                            @foreach($categories as $category)
                            <div class="swiper-wrapper">
                                <a href="index.html" class="nav-link category-item swiper-slide">
                                    <img src="images/icon-vegetables-broccoli.png" alt="Category Thumbnail">
                                    <h3 class="category-title">Fruits & Veges</h3>
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
                                                    <button class="btn btn-light btn-sm rounded-circle action-btn">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-light btn-sm rounded-circle action-btn">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
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
                                                <div class="text-warning small">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="text-muted small ms-1">(4.5)</span>
                                            </div>

                                            <div class="price-section">
                                                <span class="h6 text-danger fw-bold mb-0">
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
                        <a href="#" class="btn btn-dark text-uppercase">Mua ngay</a>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-ad bg-info" style="background: url('{{ asset('assets/images/nentrasua.jpg') }}'); background-repeat: no-repeat; background-position: right bottom;">
                    <div class="banner-content p-5">

                        <div class="categories text-primary fs-3 fw-bold">Siêu siêu ngon</div>
                        <h3 class="banner-title">Trà sữa</h3>
                        <p>Tiền không mua được tất cả, nhưng mua được trà sữa – là đủ rồi</p>
                        <a href="#" class="btn btn-dark text-uppercase">Mua ngay</a>

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
                                        <button class="btn btn-light btn-sm rounded-circle action-btn">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-light btn-sm rounded-circle action-btn">
                                            <i class="fas fa-heart"></i>
                                        </button>
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
                                    <div class="text-warning small">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-muted small ms-1">(4.5)</span>
                                </div>

                                <div class="price-section">
                                    <span class="h6 text-danger fw-bold mb-0">
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

        <div class="bg-secondary py-5 my-5 rounded-5" style="background: url('images/bg-leaves-img-pattern.png') no-repeat;">
            <div class="container my-5">
                <div class="row">
                    <div class="col-md-6 p-5">
                        <div class="section-header">
                            <h2 class="section-title display-4">Get <span class="text-primary">25% Discount</span> on your first purchase</h2>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictumst amet, metus, sit massa posuere maecenas. At tellus ut nunc amet vel egestas.</p>
                    </div>
                    <div class="col-md-6 p-5">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text"
                                    class="form-control form-control-lg" name="name" id="name" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="abc@mail.com">
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <label class="form-check-label" for="subscribe">
                                    <input class="form-check-input" type="checkbox" id="subscribe" value="subscribe">
                                    Subscribe to the newsletter</label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark btn-lg">Submit</button>
                            </div>
                        </form>

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
                                            <button class="btn btn-light btn-sm rounded-circle action-btn">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-light btn-sm rounded-circle action-btn">
                                                <i class="fas fa-heart"></i>
                                            </button>
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
                                        <div class="text-warning small">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="text-muted small ms-1">(4.5)</span>
                                    </div>

                                    <div class="price-section">
                                        <span class="h6 text-danger fw-bold mb-0">
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
                                            <button class="btn btn-light btn-sm rounded-circle action-btn">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-light btn-sm rounded-circle action-btn">
                                                <i class="fas fa-heart"></i>
                                            </button>
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
                                        <div class="text-warning small">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="text-muted small ms-1">(4.5)</span>
                                    </div>

                                    <div class="price-section">
                                        <span class="h6 text-danger fw-bold mb-0">
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
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="blog-image">
                <div class="blog-content">
                    <span class="blog-category">{{ $post->postcategory->name }}</span>
                    <h2 class="blog-title">{{ $post->title }}</h2>
                    <p class="blog-excerpt">
                        {!! \Illuminate\Support\Str::limit($post->content, 100) !!}

                    </p>

                    <div class="blog-meta">
                        <div class="author-info">
                            <div class="author-avatar">{{ mb_substr($post->author_name, 0, 1) }}</div>
                            <span>{{ $post->author_name }}</span>
                        </div>
                        <span class="date">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</span>
                    </div>
                    <a href="{{ route('blog.show', $post->id) }}" class="read-more">Đọc tiếp</a>

                </div>
            </article>
            @endforeach
        </div>


</section>

<section class="py-5 my-5">
    <div class="container-fluid">

        <div class="bg-warning py-5 rounded-5" style="background-image: url('images/bg-pattern-2.png') no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/phone.png" alt="phone" class="image-float img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h2 class="my-5">Shop faster with foodmart App</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames semper erat ac in suspendisse iaculis. Amet blandit tortor praesent ante vitae. A, enim pretiummi senectus magna. Sagittis sed ptibus liberolectus non et psryroin.</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <img src="images/app-store.jpg" alt="app-store">
                            <img src="images/google-play.jpg" alt="google-play">
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

    // Initialize Swiper (if not already initialized globally)
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
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
    });
</script>
@endsection