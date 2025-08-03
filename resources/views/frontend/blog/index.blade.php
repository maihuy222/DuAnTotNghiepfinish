@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Blog</h2>

    {{-- Bộ lọc danh mục --}}
    <section class="filter-section mb-4 text-start">
        <button class="category-filter active" data-category="all">Tất cả</button>

        @foreach ($posts->pluck('category')->unique('id') as $category)
        @if ($category)
        <button class="category-filter" data-category="{{ $category->id }}">
            {{ $category->name }}
        </button>
        @endif
        @endforeach
    </section>


    {{-- Loader --}}
    <div class="loading-spinner" style="display: none;">
        <div class="spinner"></div>
    </div>

    {{-- Danh sách bài viết --}}
    <main class="blog-grid" id="blogGrid">
        @foreach ($posts as $post)
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
    </main>

    <div class="no-posts" id="noPosts" style="display: none;">
        Không tìm thấy bài viết nào trong danh mục này.
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allCards = document.querySelectorAll('.blog-card');
        const noPosts = document.getElementById('noPosts');
        const filters = document.querySelectorAll('.category-filter');

        filters.forEach(btn => {
            btn.addEventListener('click', function() {
                filters.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const cat = this.dataset.category;

                let found = false;
                allCards.forEach(card => {
                    if (cat === 'all' || card.dataset.category === cat) {
                        card.style.display = 'block';
                        found = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                noPosts.style.display = found ? 'none' : 'block';
            });
        });
    });
</script>


@endsection