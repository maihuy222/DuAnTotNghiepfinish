@extends('frontend.layout')

@section('content')
<div class="product-detail-container">
    <div class="container">
        <div class="row">
            <!-- Cột trái - Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <div class="product-image-section">
                    <div class="main-image-wrapper">
                        <img id="mainImage" src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="main-product-image">
                    </div>
                    
                    @if ($product->images && count($product->images))
                    <div class="thumbnail-images">
                        <div class="thumbnail-item active" data-image="{{ asset($product->image) }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        </div>
                        @foreach ($product->images as $img)
                        <div class="thumbnail-item" data-image="{{ asset($img->path) }}">
                            <img src="{{ asset($img->path) }}" alt="{{ $product->name }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Cột phải - Thông tin sản phẩm -->
            <div class="col-md-6">
                <div class="product-info-section">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <div class="product-description">
                        <p>{{ $product->description ?? 'Mô tả sản phẩm sẽ được hiển thị ở đây.' }}</p>
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="order-form">
                        @csrf
                        
                        <!-- Chọn kích cỡ -->
                        <div class="form-group">
                            <label class="form-label">Chọn kích cỡ:</label>
                            <div class="size-options">
                                @if($product->sizes && count($product->sizes) > 0)
                                    @foreach($product->sizes as $size)
                                    <label class="size-option">
                                        <input type="radio" name="size_id" value="{{ $size->id }}" class="size-radio" data-price="{{ $size->pivot->price }}">
                                        <span class="size-text">{{ $size->name }}</span>
                                        <span class="size-price">{{ number_format($size->pivot->price, 0, ',', '.') }}₫</span>
                                    </label>
                                    @endforeach
                                @else
                                    <!-- Nếu không có size, hiển thị giá gốc của sản phẩm -->
                                    <label class="size-option">
                                        <input type="radio" name="size_id" value="" class="size-radio" data-price="{{ $product->price }}" checked>
                                        <span class="size-text">Mặc định</span>
                                        <span class="size-price">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                    </label>
                                @endif
                            </div>
                        </div>

                        <!-- Số lượng -->
                        <div class="form-group">
                            <label class="form-label">Số lượng:</label>
                            <div class="quantity-wrapper">
                                <button type="button" class="qty-btn minus">-</button>
                                <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                                <button type="button" class="qty-btn plus">+</button>
                            </div>
                        </div>

                        <!-- Giá -->
                        <div class="price-section">
                            <label class="price-label">Giá:</label>
                            <span class="total-price" id="totalPrice">
                                @if($product->sizes && count($product->sizes) > 0)
                                    {{ number_format($product->sizes->first()->pivot->price, 0, ',', '.') }}₫
                                @else
                                    {{ number_format($product->price, 0, ',', '.') }}₫
                                @endif
                            </span>
                        </div>

                        <!-- Hidden input để gửi giá thực tế -->
                        <input type="hidden" name="price" id="priceInput" 
                               value="@if($product->sizes && count($product->sizes) > 0){{ $product->sizes->first()->pivot->price }}@else{{ $product->price }}@endif">

                        <!-- Nút đặt món -->
                        <button type="submit" class="order-btn">Đặt món ngay</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Phần đánh giá và góp ý -->
        <div class="reviews-section">
            <h2 class="reviews-title">Đánh giá & Góp ý</h2>
            
            <!-- Hiển thị đánh giá hiện có -->
            <div class="existing-reviews" id="commentsList">
                @if($comments->count() > 0)
                    @foreach($comments as $comment)
                    <div class="review-item">
                        <div class="review-content">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                            <div class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</div>
                            
                            @if($comment->reply)
                            <div class="admin-reply">
                                <div class="reply-content">
                                    <strong><i class="fas fa-shield-alt"></i> Admin:</strong> {{ $comment->reply }}
                                    <div class="reply-date">{{ $comment->updated_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="no-comments">
                        <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                    </div>
                @endif
            </div>

            <!-- Form thêm đánh giá -->
            <div class="add-review-section">
                <h3 class="add-review-title">Thêm bình luận của bạn</h3>
                @auth
                    <form class="review-form" id="commentForm">
                        @csrf
                        <textarea class="review-textarea" name="content" placeholder="Viết đánh giá của bạn..." required></textarea>
                        <button type="submit" class="submit-review-btn">Gửi đánh giá</button>
                    </form>
                @else
                    <div class="login-required">
                        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận!</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
    .product-detail-container {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .product-image-section {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .main-image-wrapper {
        margin-bottom: 1rem;
    }

    .main-product-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }

    .thumbnail-images {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
    }

    .thumbnail-item {
        flex: 0 0 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .thumbnail-item.active {
        border-color: #667eea;
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info-section {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: fit-content;
    }

    .product-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .product-description {
        margin-bottom: 2rem;
        color: #666;
        line-height: 1.6;
    }

    .order-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1rem;
    }

    .size-options {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .size-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .size-option:hover {
        border-color: #667eea;
    }

    .size-option input[type="radio"] {
        display: none;
    }

    .size-option input[type="radio"]:checked + .size-text {
        color: #667eea;
        font-weight: 600;
    }

    .size-option:has(input[type="radio"]:checked) {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    .size-option:has(input[type="radio"]:checked) .size-text,
    .size-option:has(input[type="radio"]:checked) .size-price {
        color: white;
    }

    .size-text {
        font-weight: 500;
    }

    .size-price {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .quantity-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        width: fit-content;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border: 2px solid #e9ecef;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .qty-btn:hover {
        border-color: #667eea;
        background: #667eea;
        color: white;
    }

    .quantity-input {
        width: 80px;
        height: 40px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        text-align: center;
        font-size: 1rem;
        font-weight: 600;
        outline: none;
    }

    .quantity-input:focus {
        border-color: #667eea;
    }

    .price-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .price-label {
        font-weight: 600;
        color: #ff6b6b;
    }

    .total-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ff6b6b;
    }

    .order-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .order-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .reviews-section {
        margin-top: 3rem;
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .reviews-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 2rem;
    }

    .existing-reviews {
        margin-bottom: 2rem;
    }

    .review-item {
        margin-bottom: 1rem;
    }

    .review-content {
        padding: 1rem;
        border-radius: 8px;
        background: #e8f5e8;
        color: #2c3e50;
        line-height: 1.5;
    }

    .review-item:nth-child(2) .review-content {
        background: #e3f2fd;
    }

    .comment-date {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.5rem;
        font-style: italic;
    }

    .no-comments {
        text-align: center;
        padding: 2rem;
        color: #666;
        font-style: italic;
    }

    .login-required {
        text-align: center;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .login-required a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .login-required a:hover {
        text-decoration: underline;
    }

    .admin-reply {
        margin-top: 1rem;
        padding-left: 1rem;
        border-left: 3px solid #667eea;
    }

    .reply-content {
        background: #f8f9fa;
        padding: 0.75rem;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .reply-content strong {
        color: #667eea;
    }

    .reply-content i {
        margin-right: 0.5rem;
    }

    .reply-date {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.5rem;
        font-style: italic;
    }

    .add-review-section {
        border-top: 1px solid #e9ecef;
        padding-top: 2rem;
    }

    .add-review-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .review-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .review-textarea {
        width: 100%;
        min-height: 100px;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        resize: vertical;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .review-textarea:focus {
        border-color: #667eea;
    }

    .submit-review-btn {
        background: #667eea;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: fit-content;
    }

    .submit-review-btn:hover {
        background: #5a6fd8;
        transform: translateY(-1px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 0 10px;
        }

        .product-image-section,
        .product-info-section,
        .reviews-section {
            padding: 1rem;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .size-options {
            flex-direction: column;
        }

        .size-option {
            width: 100%;
        }

        .quantity-wrapper {
            width: 100%;
            justify-content: center;
        }

        .order-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Size selection
        const sizeRadios = document.querySelectorAll('.size-radio');
        const totalPrice = document.getElementById('totalPrice');
        const priceInput = document.getElementById('priceInput');

        if (sizeRadios.length > 0) {
            sizeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const price = parseFloat(this.dataset.price);
                    if (totalPrice) {
                        totalPrice.textContent = price.toLocaleString('vi-VN') + '₫';
                    }
                    if (priceInput) {
                        priceInput.value = price;
                    }
                });
            });

            // Auto select first size
            sizeRadios[0].checked = true;
            sizeRadios[0].dispatchEvent(new Event('change'));
        } else {
            // Nếu không có size nào, sử dụng giá gốc của sản phẩm
            const defaultPrice = {{ $product->price }};
            if (totalPrice) {
                totalPrice.textContent = defaultPrice.toLocaleString('vi-VN') + '₫';
            }
            if (priceInput) {
                priceInput.value = defaultPrice;
            }
        }

        // Xử lý trường hợp không có size được chọn
        const sizeFormGroup = document.querySelector('.form-group');
        if (sizeFormGroup) {
            const noSizeOption = sizeFormGroup.querySelector('input[value=""]');
            if (noSizeOption) {
                noSizeOption.addEventListener('change', function() {
                    if (this.checked) {
                        const defaultPrice = {{ $product->price }};
                        if (totalPrice) {
                            totalPrice.textContent = defaultPrice.toLocaleString('vi-VN') + '₫';
                        }
                        if (priceInput) {
                            priceInput.value = defaultPrice;
                        }
                    }
                });
            }
        }

        // Thumbnail gallery
        const thumbnails = document.querySelectorAll('.thumbnail-item');
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

        // Review form submission
        const reviewForm = document.getElementById('commentForm');
        const reviewTextarea = document.querySelector('.review-textarea');
        const submitReviewBtn = document.querySelector('.submit-review-btn');
        const commentsList = document.getElementById('commentsList');

        if (reviewForm && submitReviewBtn) {
            reviewForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const reviewText = reviewTextarea.value.trim();
                if (!reviewText) {
                    alert('Vui lòng nhập nội dung đánh giá!');
                    return;
                }

                // Disable button while submitting
                submitReviewBtn.disabled = true;
                submitReviewBtn.textContent = 'Đang gửi...';

                // Get product ID from URL - URL format: /product/{slug}
                const pathParts = window.location.pathname.split('/');
                const slug = pathParts[pathParts.length - 1];
                
                // We need to get the actual product ID, not the slug
                // For now, let's use the product ID from the form or data attribute
                const productId = {{ $product->id }};
                
                console.log('Product ID:', productId);
                console.log('Comment content:', reviewText);

                // Send AJAX request
                const formData = new FormData();
                formData.append('content', reviewText);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch(`/product/${productId}/comment`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear textarea
                        reviewTextarea.value = '';
                        
                        // Show success message
                        alert(data.message);
                        
                        // Optionally reload page to show new comment
                        // window.location.reload();
                    } else {
                        alert(data.message || 'Có lỗi xảy ra!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                })
                .finally(() => {
                    // Re-enable button
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.textContent = 'Gửi đánh giá';
                });
            });
        }
    });
</script>
@endsection