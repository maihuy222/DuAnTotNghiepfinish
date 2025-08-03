@extends('frontend.layout')

@section('content')
<div class="product-hero">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-lg-7">
                <div class="product-gallery">
                    <div class="main-image-container">
                        <img id="mainImage"
                            src="{{ asset($product->image) }}"
                            alt="{{ $product->name }}"
                            class="main-image" />
                        <div class="image-overlay">
                            <button class="zoom-btn">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </div>
                    </div>

                    @if ($product->images && count($product->images))
                    <div class="thumbnail-gallery">
                        <div class="thumbnail active" data-image="{{ asset($product->image) }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                        </div>
                        @foreach ($product->images as $img)
                        <div class="thumbnail" data-image="{{ asset($img->path) }}">
                            <img src="{{ asset($img->path) }}" alt="{{ $product->name }}" />
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-lg-5">
                <div class="product-info">
                    <div class="product-badge">
                        <span class="badge-new">Mới</span>
                        <span class="badge-popular">Phổ biến</span>
                    </div>

                    <h1 class="product-title">{{ $product->name }}</h1>

                    <div class="product-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="rating-text">(4.9) • 127 đánh giá</span>
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="product-form">
                        @csrf

                        {{-- Nếu có size --}}
                        @if ($product->sizes->isNotEmpty())
                        <div class="size-selection">
                            <h3 class="selection-label">
                                <i class="fas fa-ruler"></i>
                                Chọn kích cỡ
                            </h3>
                            <div class="size-options">
                                @foreach ($product->sizes as $size)
                                <label class="size-option">
                                    <input type="radio" name="size_id" value="{{ $size->id }}"
                                        class="size-radio" data-price="{{ $size->pivot->price }}">
                                    <div class="size-content">
                                        <span class="size-name">{{ $size->name }}</span>
                                        <span class="size-price">{{ number_format($size->pivot->price) }}đ</span>
                                    </div>
                                    <div class="size-checkmark">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="price-display">
                            <span class="current-price" id="selectedPrice"></span>
                            <span class="price-label">Giá hiện tại</span>
                        </div>
                        @else
                        {{-- Nếu không có size, hiện giá mặc định --}}
                        <div class="price-display">
                            <span class="current-price">{{ number_format($product->price) }}đ</span>
                            <span class="price-label">Giá bán</span>
                        </div>
                        @endif

                        <!-- Hidden input để gửi giá thực tế -->
                        <input type="hidden" name="price" id="priceInput" value="{{ $product->price }}">

                        <div class="quantity-section">
                            <h3 class="selection-label">
                                <i class="fas fa-cubes"></i>
                                Số lượng
                            </h3>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn minus">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" class="quantity-input" value="1" min="1" />
                                <button type="button" class="qty-btn plus">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn-add-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Thêm vào giỏ hàng</span>
                                <div class="btn-ripple"></div>
                            </button>
                            <button type="button" class="btn-wishlist">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </form>

                    <div class="product-stats">
                        <div class="stat-item">
                            <i class="fas fa-shopping-bag"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ $product->sold ?? 0 }}</span>
                                <span class="stat-label">Đã bán</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-eye"></i>
                            <div class="stat-content">
                                <span class="stat-number">1,234</span>
                                <span class="stat-label">Lượt xem</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-truck"></i>
                            <div class="stat-content">
                                <span class="stat-number">Miễn phí</span>
                                <span class="stat-label">Vận chuyển</span>
                            </div>
                        </div>
                    </div>

                    <div class="product-features">
                        <div class="feature-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Bảo hành 12 tháng</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-undo"></i>
                            <span>Đổi trả trong 30 ngày</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-medal"></i>
                            <span>Chất lượng cao cấp</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    

    .product-hero {
        background: linear-gradient(135deg, #000000ff 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    .product-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        pointer-events: none;
    }

    

    .product-gallery {
        padding: 3rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .main-image-container {
        position: relative;
        aspect-ratio: 1;
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .main-image-container:hover .image-overlay {
        opacity: 1;
    }

    .main-image-container:hover .main-image {
        transform: scale(1.1);
    }

    .zoom-btn {
        background: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 1.2rem;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .zoom-btn:hover {
        transform: scale(1.1);
    }

    .thumbnail-gallery {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding: 1rem 0;
    }

    .thumbnail {
        flex: 0 0 80px;
        height: 80px;
        border-radius: var(--radius-sm);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        position: relative;
    }

    .thumbnail:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-sm);
    }

    .thumbnail.active {
        border-color: var(--primary-color);
        transform: translateY(-5px);
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info {
        padding: 3rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .product-badge {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .product-badge span {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-new {
        background: linear-gradient(45deg, var(--success-color), #40c057);
        color: white;
    }

    .badge-popular {
        background: linear-gradient(45deg, var(--accent-color), #ff5252);
        color: white;
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        line-height: 1.2;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stars {
        display: flex;
        gap: 0.25rem;
        color: #ffd43b;
        font-size: 1.2rem;
    }

    .rating-text {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .product-form {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .selection-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .selection-label i {
        color: var(--primary-color);
    }

    .size-options {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .size-option {
        position: relative;
        cursor: pointer;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: var(--radius-sm);
        padding: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-width: 120px;
    }

    .size-option:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .size-radio {
        display: none;
    }

    .size-radio:checked+.size-content {
        color: var(--primary-color);
    }

    .size-option:has(.size-radio:checked) {
        border-color: var(--primary-color);
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    .size-option:has(.size-radio:checked) .size-content {
        color: white;
    }

    .size-content {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .size-name {
        font-weight: 600;
        font-size: 1rem;
    }

    .size-price {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .size-checkmark {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .size-option:has(.size-radio:checked) .size-checkmark {
        opacity: 1;
    }

    .price-display {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem;
        border-radius: var(--radius-md);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .price-display::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .price-display:hover::before {
        left: 100%;
    }

    .current-price {
        font-size: 2.5rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.5rem;
    }

    .price-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    .quantity-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        width: fit-content;
    }

    .qty-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .qty-btn:hover {
        background: var(--secondary-color);
        transform: scale(1.1);
    }

    .quantity-input {
        width: 80px;
        height: 40px;
        border: 2px solid #e9ecef;
        border-radius: var(--radius-sm);
        text-align: center;
        font-weight: 600;
        font-size: 1.1rem;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .quantity-input:focus {
        border-color: var(--primary-color);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn-add-cart {
        flex: 1;
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-add-cart:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-add-cart:active {
        transform: translateY(0);
    }

    .btn-wishlist {
        background: white;
        color: var(--accent-color);
        border: 2px solid var(--accent-color);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .btn-wishlist:hover {
        background: var(--accent-color);
        color: white;
        transform: scale(1.1);
    }

    .product-stats {
        display: flex;
        gap: 2rem;
        padding: 1.5rem;
        background: var(--bg-light);
        border-radius: var(--radius-md);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-item i {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .stat-content {
        display: flex;
        flex-direction: column;
    }

    .stat-number {
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--text-primary);
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .product-features {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        background: white;
        border-radius: var(--radius-sm);
        border-left: 4px solid var(--primary-color);
    }

    .feature-item i {
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .feature-item span {
        color: var(--text-primary);
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .product-gallery,
        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 2rem;
        }

        .current-price {
            font-size: 2rem;
        }

        .size-options {
            flex-direction: column;
        }

        .size-option {
            min-width: 100%;
        }

        .product-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-add-cart {
            width: 100%;
        }
    }

    /* Animation cho button */
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }

        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    .btn-ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }
</style>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Size selection
        const sizeRadios = document.querySelectorAll('.size-radio');
        const selectedPrice = document.getElementById('selectedPrice');
        const priceInput = document.getElementById('priceInput');

        if (sizeRadios.length > 0) {
            sizeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const price = parseFloat(this.dataset.price);
                    if (selectedPrice) {
                        selectedPrice.textContent = price.toLocaleString('vi-VN') + 'đ';
                    }
                    if (priceInput) {
                        priceInput.value = price;
                    }
                });
            });

            // Auto select first size
            sizeRadios[0].checked = true;
            sizeRadios[0].dispatchEvent(new Event('change'));
        }

        // Thumbnail gallery
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('mainImage');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Remove active class from all thumbnails
                thumbnails.forEach(t => t.classList.remove('active'));

                // Add active class to clicked thumbnail
                this.classList.add('active');

                // Update main image
                const newImageSrc = this.dataset.image;
                if (mainImage && newImageSrc) {
                    mainImage.src = newImageSrc;
                }
            });
        });

        // Quantity controls
        const quantityInput = document.querySelector('.quantity-input');
        const minusBtn = document.querySelector('.qty-btn.minus');
        const plusBtn = document.querySelector('.qty-btn.plus');

        if (minusBtn && quantityInput) {
            minusBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        }

        if (plusBtn && quantityInput) {
            plusBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });
        }

        // Add to cart button ripple effect
        const addToCartBtn = document.querySelector('.btn-add-cart');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                const ripple = document.createElement('span');
                ripple.className = 'btn-ripple';
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        }

        // Wishlist toggle
        const wishlistBtn = document.querySelector('.btn-wishlist');
        if (wishlistBtn) {
            wishlistBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('fas')) {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.color = '#ff6b6b';
                    this.style.borderColor = '#ff6b6b';
                } else {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.background = '#ff6b6b';
                    this.style.color = 'white';
                    this.style.borderColor = '#ff6b6b';
                }
            });
        }

        // Smooth animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        const animateElements = document.querySelectorAll('.product-info > *');
        animateElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(el);
        });
    });
</script>
@endsection