@extends('frontend.layout')
@section('content')

<section class="py-3" style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="banner-blocks">

                    <div class="banner-ad large bg-info block-1">

                        <div class="swiper main-swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories my-3">100% natural</div>
                                            <h3 class="display-4">Fresh Smoothie & Summer Juice</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                                            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Shop Now</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="images/product-thumb-1.png" class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories mb-3 pb-3">100% natural</div>
                                            <h3 class="banner-title">Fresh Smoothie & Summer Juice</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                                            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="images/product-thumb-1.png" class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="row banner-content p-5">
                                        <div class="content-wrapper col-md-7">
                                            <div class="categories mb-3 pb-3">100% natural</div>
                                            <h3 class="banner-title">Heinz Tomato Ketchup</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim massa diam elementum.</p>
                                            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Shop Collection</a>
                                        </div>
                                        <div class="img-wrapper col-md-5">
                                            <img src="images/product-thumb-2.png" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
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

<section class="py-5 overflow-hidden">
    <div class="container-fluid">
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
                <div class="category-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach ($categories as $category)
                        <a href="#" class="nav-link category-item swiper-slide">
                            <img src="{{ asset($category->image) }}" alt="Category Thumbnail">
                            <h3 class="category-title">{{ $category->name }}</h3>
                        </a>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>


<section class="py-5 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex flex-wrap flex-wrap justify-content-between mb-5">

                    <h2 class="section-title">Newly Arrived Brands</h2>

                    <div class="d-flex align-items-center">
                        <a href="#" class="btn-link text-decoration-none">View All Categories →</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev brand-carousel-prev btn btn-yellow">❮</button>
                            <button class="swiper-next brand-carousel-next btn btn-yellow">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="brand-carousel swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product-thumb-11.jpg" class="img-fluid rounded" alt="Card title">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-0">
                                            <p class="text-muted mb-0">Amber Jar</p>
                                            <h5 class="card-title">Honey best nectar you wish to get</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product-thumb-12.jpg" class="img-fluid rounded" alt="Card title">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-0">
                                            <p class="text-muted mb-0">Amber Jar</p>
                                            <h5 class="card-title">Honey best nectar you wish to get</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product-thumb-13.jpg" class="img-fluid rounded" alt="Card title">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-0">
                                            <p class="text-muted mb-0">Amber Jar</p>
                                            <h5 class="card-title">Honey best nectar you wish to get</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product-thumb-14.jpg" class="img-fluid rounded" alt="Card title">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-0">
                                            <p class="text-muted mb-0">Amber Jar</p>
                                            <h5 class="card-title">Honey best nectar you wish to get</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product-thumb-11.jpg" class="img-fluid rounded" alt="Card title">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-0">
                                            <p class="text-muted mb-0">Amber Jar</p>
                                            <h5 class="card-title">Honey best nectar you wish to get</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card mb-3 p-3 rounded-4 shadow border-0">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product-thumb-12.jpg" class="img-fluid rounded" alt="Card title">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-0">
                                            <p class="text-muted mb-0">Amber Jar</p>
                                            <h5 class="card-title">Honey best nectar you wish to get</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section class="py-5">
    <div class="container-fluid">

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




                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-biscuits.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- / product-grid -->

                        </div>

                        <div class="tab-pane fade" id="nav-fruits" role="tabpanel" aria-labelledby="nav-fruits-tab">

                            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                                <div class="col">
                                    <div class="product-item">
                                        <span class="badge bg-success position-absolute m-3">-30%</span>
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-cucumber.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <span class="badge bg-success position-absolute m-3">-30%</span>
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-milk.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <span class="badge bg-success position-absolute m-3">-30%</span>
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-orange-juice.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-raspberries.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-bananas.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-bananas.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- / product-grid -->

                        </div>
                        <div class="tab-pane fade" id="nav-juices" role="tabpanel" aria-labelledby="nav-juices-tab">

                            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-cucumber.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-milk.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-tomatoes.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-tomatoketchup.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-bananas.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product-item">
                                        <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                <use xlink:href="#heart"></use>
                                            </svg></a>
                                        <figure>
                                            <a href="index.html" title="Product Title">
                                                <img src="images/thumb-bananas.png" class="tab-image">
                                            </a>
                                        </figure>
                                        <h3>Sunstar Fresh Melon Juice</h3>
                                        <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                                <use xlink:href="#star-solid"></use>
                                            </svg> 4.5</span>
                                        <span class="price">$18.00</span>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </div>
                                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- / product-grid -->

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="banner-ad bg-danger mb-3" style="background: url('images/ad-image-3.png');background-repeat: no-repeat;background-position: right bottom;">
                    <div class="banner-content p-5">

                        <div class="categories text-primary fs-3 fw-bold">Upto 25% Off</div>
                        <h3 class="banner-title">Luxa Dark Chocolate</h3>
                        <p>Very tasty & creamy vanilla flavour creamy muffins.</p>
                        <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-ad bg-info" style="background: url('images/ad-image-4.png');background-repeat: no-repeat;background-position: right bottom;">
                    <div class="banner-content p-5">

                        <div class="categories text-primary fs-3 fw-bold">Upto 25% Off</div>
                        <h3 class="banner-title">Creamy Muffins</h3>
                        <p>Very tasty & creamy vanilla flavour creamy muffins.</p>
                        <a href="#" class="btn btn-dark text-uppercase">Show Now</a>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-5 overflow-hidden">
    <div class="container-fluid">
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
                <div class="products-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach($bestSelling as $product)
                        <div class="product-item swiper-slide">
                            <!-- Discount Badge -->
                            <span class="badge bg-success position-absolute m-3 z-1">-15%</span>

                            <!-- Wishlist Button -->
                            <button class="btn-wishlist" aria-label="Thêm vào yêu thích">
                                <svg width="20" height="20" fill="currentColor">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </button>

                            <!-- Product Image -->
                            <figure class="product-image">
                                <a href="{{ route('product.show', $product->id) }}" class="d-block text-decoration-none">
                                    <img src="{{ $product->image ?? 'images/thumb-tomatoes.png' }}"
                                        alt="{{ $product->name }}"
                                        class="img-fluid"
                                        loading="lazy">
                                </a>
                            </figure>

                            <!-- Product Info -->
                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <!-- Meta: Unit + Rating -->
                                <div class="product-meta d-flex justify-content-between align-items-center mb-2">
                                    <span class="qty">{{ $product->unit ?? '1 Unit' }}</span>
                                    <span class="rating d-flex align-items-center">
                                        <iconify-icon icon="material-symbols:star" width="16" class="me-1"></iconify-icon>
                                        {{ $product->rating ?? '4.5' }}
                                    </span>
                                </div>

                                <!-- Price -->
                                <div class="price-section mb-3">
                                    @if($product->original_price && $product->original_price > $product->price)
                                    <span class="original-price text-muted text-decoration-line-through me-2">
                                        ${{ number_format($product->original_price, 2) }}
                                    </span>
                                    @endif
                                    <span class="price">
                                        ${{ number_format($product->price ?? 18.00, 2) }}
                                    </span>
                                </div>

                                <!-- Quantity + Cart -->
                                <div class="product-actions d-flex align-items-center justify-content-between">
                                    <div class="input-group product-qty">
                                        <button type="button"
                                            class="quantity-left-minus btn-number"
                                            data-type="minus"
                                            aria-label="Giảm số lượng">
                                            <svg width="12" height="12">
                                                <use xlink:href="#minus"></use>
                                            </svg>
                                        </button>
                                        <input type="number"
                                            id="quantity_{{ $product->id }}"
                                            name="quantity"
                                            value="1"
                                            min="1"
                                            aria-label="Số lượng">
                                        <button type="button"
                                            class="quantity-right-plus btn-number"
                                            data-type="plus"
                                            aria-label="Tăng số lượng">
                                            <svg width="12" height="12">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                        </button>
                                    </div>

                                    <a href="#" class="btn-link ms-2"
                                        data-product-id="{{ $product->id }}"
                                        onclick="addToCart({{ $product->id }})">
                                        Add to Cart
                                        <iconify-icon icon="uil:shopping-cart" width="16" class="ms-1"></iconify-icon>
                                    </a>
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


<section class="py-5">
    <div class="container-fluid">

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
    <div class="container-fluid">
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



                        <div class="product-item swiper-slide">
                            <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                    <use xlink:href="#heart"></use>
                                </svg></a>
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/thumb-bananas.png" class="tab-image">
                                </a>
                            </figure>
                            <h3>Sunstar Fresh Melon Juice</h3>
                            <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary">
                                    <use xlink:href="#star-solid"></use>
                                </svg> 4.5</span>
                            <span class="price">$18.00</span>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="input-group product-qty">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                            <svg width="16" height="16">
                                                <use xlink:href="#minus"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                            <svg width="16" height="16">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- / products-carousel -->

            </div>
        </div>
    </div>
</section>

<section class="py-5 overflow-hidden">
    <div class="container-fluid">
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
                        <div class="product-item swiper-slide">
                            <a href="#" class="btn-wishlist">
                                <svg width="24" height="24">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </a>
                            <figure>
                                <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
                                    <img src="{{ asset($product->image) }}" class="tab-image" alt="{{ $product->name }}">
                                </a>
                            </figure>
                            <h3>{{ $product->name }}</h3>
                            <span class="qty">{{ $product->quantity }} Unit</span>
                            <span class="rating">
                                <svg width="24" height="24" class="text-primary">
                                    <use xlink:href="#star-solid"></use>
                                </svg>
                                {{ number_format($product->avg_rating ?? 0, 1) }}
                            </span>
                            <span class="price">${{ number_format($product->price, 2) }}</span>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="input-group product-qty">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                            <svg width="16" height="16">
                                                <use xlink:href="#minus"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                            <svg width="16" height="16">
                                                <use xlink:href="#plus"></use>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></iconify-icon></a>
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

<section id="latest-blog" class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="section-header d-flex align-items-center justify-content-between my-5">
                <h2 class="section-title">Our Recent Blog</h2>
                <div class="btn-wrap align-right">
                    <a href="#" class="d-flex align-items-center nav-link">Read All Articles <svg width="24" height="24">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                <article class="post-item card border-0 shadow-sm p-3">
                    <div class="image-holder zoom-effect">
                        <a href="#">
                            <img src="images/post-thumb-2.jpg" alt="post" class="card-img-top">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
                            <div class="meta-date"><svg width="16" height="16">
                                    <use xlink:href="#calendar"></use>
                                </svg>25 Aug 2021</div>
                            <div class="meta-categories"><svg width="16" height="16">
                                    <use xlink:href="#category"></use>
                                </svg>trending</div>
                        </div>
                        <div class="post-header">
                            <h3 class="post-title">
                                <a href="#" class="text-decoration-none">Latest trends of wearing street wears supremely</a>
                            </h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipi elit. Aliquet eleifend viverra enim tincidunt donec quam. A in arcu, hendrerit neque dolor morbi...</p>
                        </div>
                    </div>
                </article>
            </div>

        </div>
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


<section class="py-5">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
            <div class="col">
                <div class="card mb-3 border-0">
                    <div class="row">
                        <div class="col-md-2 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M21.5 15a3 3 0 0 0-1.9-2.78l1.87-7a1 1 0 0 0-.18-.87A1 1 0 0 0 20.5 4H6.8l-.33-1.26A1 1 0 0 0 5.5 2h-2v2h1.23l2.48 9.26a1 1 0 0 0 1 .74H18.5a1 1 0 0 1 0 2h-13a1 1 0 0 0 0 2h1.18a3 3 0 1 0 5.64 0h2.36a3 3 0 1 0 5.82 1a2.94 2.94 0 0 0-.4-1.47A3 3 0 0 0 21.5 15Zm-3.91-3H9L7.34 6H19.2ZM9.5 20a1 1 0 1 1 1-1a1 1 0 0 1-1 1Zm8 0a1 1 0 1 1 1-1a1 1 0 0 1-1 1Z" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-0">
                                <h5>Free delivery</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border-0">
                    <div class="row">
                        <div class="col-md-2 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-0">
                                <h5>100% secure payment</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border-0">
                    <div class="row">
                        <div class="col-md-2 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M22 5H2a1 1 0 0 0-1 1v4a3 3 0 0 0 2 2.82V22a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-9.18A3 3 0 0 0 23 10V6a1 1 0 0 0-1-1Zm-7 2h2v3a1 1 0 0 1-2 0Zm-4 0h2v3a1 1 0 0 1-2 0ZM7 7h2v3a1 1 0 0 1-2 0Zm-3 4a1 1 0 0 1-1-1V7h2v3a1 1 0 0 1-1 1Zm10 10h-4v-2a2 2 0 0 1 4 0Zm5 0h-3v-2a4 4 0 0 0-8 0v2H5v-8.18a3.17 3.17 0 0 0 1-.6a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3.17 3.17 0 0 0 1 .6Zm2-11a1 1 0 0 1-2 0V7h2ZM4.3 3H20a1 1 0 0 0 0-2H4.3a1 1 0 0 0 0 2Z" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-0">
                                <h5>Quality guarantee</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border-0">
                    <div class="row">
                        <div class="col-md-2 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 8.35a3.07 3.07 0 0 0-3.54.53a3 3 0 0 0 0 4.24L11.29 16a1 1 0 0 0 1.42 0l2.83-2.83a3 3 0 0 0 0-4.24A3.07 3.07 0 0 0 12 8.35Zm2.12 3.36L12 13.83l-2.12-2.12a1 1 0 0 1 0-1.42a1 1 0 0 1 1.41 0a1 1 0 0 0 1.42 0a1 1 0 0 1 1.41 0a1 1 0 0 1 0 1.42ZM12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20Zm0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20Z" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-0">
                                <h5>guaranteed savings</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 border-0">
                    <div class="row">
                        <div class="col-md-2 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M18 7h-.35A3.45 3.45 0 0 0 18 5.5a3.49 3.49 0 0 0-6-2.44A3.49 3.49 0 0 0 6 5.5A3.45 3.45 0 0 0 6.35 7H6a3 3 0 0 0-3 3v2a1 1 0 0 0 1 1h1v6a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-6h1a1 1 0 0 0 1-1v-2a3 3 0 0 0-3-3Zm-7 13H8a1 1 0 0 1-1-1v-6h4Zm0-9H5v-1a1 1 0 0 1 1-1h5Zm0-4H9.5A1.5 1.5 0 1 1 11 5.5Zm2-1.5A1.5 1.5 0 1 1 14.5 7H13ZM17 19a1 1 0 0 1-1 1h-3v-7h4Zm2-8h-6V9h5a1 1 0 0 1 1 1Z" />
                            </svg>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body p-0">
                                <h5>Daily offers</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipi elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="footer-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>© 2023 Foodmart. All rights reserved.</p>
            </div>
            <div class="col-md-6 credit-link text-start text-md-end">
                <p>Free HTML Template by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distributed by <a href="https://themewagon">ThemeWagon</a></p>
            </div>
        </div>
    </div>
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