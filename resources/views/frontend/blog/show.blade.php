@extends('frontend.layout')

@section('content')
<div class="blog-detail-wrapper">
    <!-- Hero Section with Image -->
    <div class="blog-hero position-relative">
        <div class="blog-hero-image">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-100">
            <div class="blog-hero-overlay"></div>
        </div>
        <div class="container">
            <div class="blog-hero-content position-absolute">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <span class="badge blog-category-badge">
                                {{ $post->category->name ?? 'Không có danh mục' }}
                            </span>
                        </div>
                        <h1 class="blog-hero-title text-white mb-4">{{ $post->title }}</h1>
                        <div class="blog-meta d-flex align-items-center">
                            <div class="author-info d-flex align-items-center me-4">
                                <div class="author-avatar me-3">
                                    <div class="avatar-circle">
                                        {{ mb_substr($post->author->name ?? 'A', 0, 1) }}
                                    </div>
                                </div>
                                <div class="author-details">
                                    <div class="author-name text-white fw-semibold">
                                        {{ $post->author->name ?? 'Không rõ' }}
                                    </div>
                                    <div class="author-role text-white-50 small">Tác giả</div>
                                </div>
                            </div>
                            <div class="blog-date text-white-50">
                                <i class="bi bi-calendar-event me-2"></i>
                                {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="blog-content-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Blog Content -->
                    <div class="blog-content-wrapper">
                        <div class="blog-content prose">
                            {!! $post->content !!}
                        </div>

                        <!-- Tags Section (if you have tags) -->
                        <div class="blog-tags mt-5 pt-4 border-top">
                            <h6 class="mb-3 text-muted">Thẻ liên quan:</h6>
                            <div class="tags-list">
                                <!-- Example tags - replace with actual tags if available -->
                                <span class="tag-item">#blog</span>
                                <span class="tag-item">#{{ strtolower($post->category->name ?? 'general') }}</span>
                                <span class="tag-item">#tin-tuc</span>
                            </div>
                        </div>

                        <!-- Author Bio Section -->
                        <div class="author-bio mt-5 p-4 bg-light rounded-3">
                            <div class="d-flex align-items-start">
                                <div class="author-avatar-large me-4">
                                    <div class="avatar-circle-large">
                                        {{ mb_substr($post->author->name ?? 'A', 0, 1) }}
                                    </div>
                                </div>
                                <div class="author-bio-content">
                                    <h5 class="mb-2">{{ $post->author->name ?? 'Không rõ' }}</h5>
                                    <p class="text-muted mb-3">
                                        Tác giả có nhiều năm kinh nghiệm trong lĩnh vực viết lách và chia sẻ kiến thức.
                                        Đam mê tạo ra những nội dung chất lượng và hữu ích cho độc giả.
                                    </p>
                                    <div class="author-social">
                                        <a href="#" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="bi bi-envelope"></i> Liên hệ
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-person-lines-fill"></i> Xem thêm bài viết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="blog-navigation mt-5 pt-4 border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-lg w-100">
                                        <i class="bi bi-arrow-left me-2"></i>
                                        Quay lại danh sách
                                    </a>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <button class="btn btn-primary btn-lg w-100" onclick="sharePost()">
                                        <i class="bi bi-share me-2"></i>
                                        Chia sẻ bài viết
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

<style>
    /* Blog Detail Styles */
    .blog-detail-wrapper {
        background-color: #f8f9fa;
    }

    .blog-hero {
        height: 70vh;
        min-height: 500px;
        overflow: hidden;
    }

    .blog-hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .blog-hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
        z-index: 2;
    }

    .blog-hero-content {
        bottom: 80px;
        left: 0;
        right: 0;
        z-index: 3;
    }

    .blog-hero-title {
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .blog-category-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
    }

    .author-avatar .avatar-circle,
    .author-avatar-large .avatar-circle-large {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        text-transform: uppercase;
    }

    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        font-size: 1.2rem;
    }

    .avatar-circle-large {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        font-size: 1.8rem;
    }

    .blog-content-section {
        background: white;
        margin-top: -50px;
        position: relative;
        z-index: 4;
        border-radius: 20px 20px 0 0;
    }

    .blog-content-wrapper {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .prose {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }

    .prose p {
        margin-bottom: 1.5rem;
    }

    .prose h1,
    .prose h2,
    .prose h3,
    .prose h4,
    .prose h5,
    .prose h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .prose img {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }

    .prose blockquote {
        border-left: 4px solid #667eea;
        padding-left: 1.5rem;
        font-style: italic;
        color: #666;
        margin: 2rem 0;
    }

    .tags-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .tag-item {
        background: #e9ecef;
        color: #495057;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .tag-item:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .author-bio {
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .author-bio:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .blog-navigation .btn {
        transition: all 0.3s ease;
        border-radius: 10px;
    }

    .blog-navigation .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .blog-hero {
            height: 50vh;
            min-height: 400px;
        }

        .blog-hero-title {
            font-size: 2rem;
        }

        .blog-hero-content {
            bottom: 40px;
        }

        .blog-content-wrapper {
            padding: 20px;
            margin: 0 15px;
        }

        .author-info {
            flex-direction: column;
            align-items: flex-start !important;
            margin-bottom: 1rem;
        }

        .blog-date {
            margin-top: 0.5rem;
        }
    }

    /* Print Styles */
    @media print {

        .blog-hero,
        .blog-navigation,
        .author-bio {
            display: none;
        }

        .blog-content-section {
            margin-top: 0;
        }
    }
</style>

<script>
    function sharePost() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $post->title }}',
                text: 'Đọc bài viết hay này: {{ $post->title }}',
                url: window.location.href
            });
        } else {
            // Fallback - copy URL to clipboard
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Đã sao chép link bài viết vào clipboard!');
            });
        }
    }

    // Add reading progress indicator
    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.createElement('div');
        progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        z-index: 9999;
        transition: width 0.3s ease;
    `;
        document.body.appendChild(progressBar);

        window.addEventListener('scroll', function() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + '%';
        });
    });
</script>
@endsection