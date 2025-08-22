@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Blog</h2>

    {{-- Bộ lọc danh mục --}}
    <section class="filter-section mb-4 text-start">
        <button class="category-filter active" data-category="all">Tất cả</button>

        @foreach ($posts->pluck('postcategory')->unique('id') as $category)
        @if ($category)
        <button class="category-filter" data-category="{{ $category->id }}">
            {{ $category->name }}
        </button>
        @endif
        @endforeach
    </section>

    {{-- Loader --}}
    <div class="loading-spinner" id="loadingSpinner" style="display: none;">
        <div class="spinner"></div>
    </div>

    {{-- Danh sách bài viết được hiển thị trong form --}}
    <main class="blog-list" id="blogList">
        @forelse ($posts as $post)
        <article class="blog-item" data-category="{{ $post->postcategory->id ?? 'no-category' }}">
            <div class="card p-3 d-flex flex-row align-items-start mb-4">
                {{-- Ảnh bên trái với kích thước cố định --}}
                <div class="flex-shrink-0 me-4" style="width: 200px; height: 150px;">
                    <a href="{{ route('blog.show', $post->id) }}">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                </div>

                {{-- Nội dung bên phải --}}
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2">
                        <a href="{{ route('blog.show', $post->id) }}" class="text-dark text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </h5>
                    <p class="text-muted small mb-2">
                        <span class="blog-category me-2">{{ $post->postcategory->name ?? 'Không có danh mục' }}</span>
                        <span>|</span>
                        <span class="ms-2">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</span>
                    </p>
                    <p class="blog-excerpt">
                        {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 200) !!}
                    </p>
                    <a href="{{ route('blog.show', $post->id) }}" class="read-more text-decoration-none fw-bold mt-2 d-inline-block">
                        Đọc tiếp
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="no-posts">
            Không có bài viết nào để hiển thị.
        </div>
        @endforelse
    </main>

    <div class="no-posts" id="noPosts" style="display: none;">
        Không tìm thấy bài viết nào trong danh mục này.
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allItems = document.querySelectorAll('.blog-item');
        const noPostsMessage = document.getElementById('noPosts');
        const filters = document.querySelectorAll('.category-filter');
        const loadingSpinner = document.getElementById('loadingSpinner');

        filters.forEach(btn => {
            btn.addEventListener('click', function() {
                loadingSpinner.style.display = 'block';
                filters.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const cat = this.dataset.category;

                setTimeout(() => {
                    let found = false;
                    allItems.forEach(item => {
                        if (cat === 'all' || item.dataset.category === cat) {
                            item.style.display = 'block';
                            found = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    loadingSpinner.style.display = 'none';
                    noPostsMessage.style.display = found ? 'none' : 'block';
                }, 500);
            });
        });
    });
</script>
@endsection