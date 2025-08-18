@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 mb-4">
            <article class="blog-post">
                <header class="mb-4">
                    <h1 class="display-5 fw-bold mb-2">{{ $post->title }}</h1>
                    <div class="text-muted small mb-3">
                        {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | Tác giả: {{ $post->author->name ?? 'Không rõ' }}
                    </div>
                </header>

                @if($post->image)
                <figure class="mb-4">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="max-height: 500px; object-fit: cover;">
                </figure>
                @endif

                <div class="lead mb-4">{!! $post->content !!}</div>

                <!-- Tags -->
                <div class="mb-4">
                    <h6 class="text-muted">Thẻ liên quan:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-secondary">#blog</span>
                        <span class="badge bg-secondary">#{{ strtolower($post->category->name ?? 'general') }}</span>
                        <span class="badge bg-secondary">#tin-tuc</span>
                    </div>
                </div>

                <!-- Share Button -->
                <div class="mb-4">
                    <button class="btn btn-primary" onclick="sharePost()">
                        <i class="bi bi-share me-1"></i> Chia sẻ bài viết
                    </button>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="sidebar-related-posts p-4 bg-light rounded shadow-sm">
                <h4 class="fw-bold mb-3">Bài viết liên quan</h4>
                <ul class="list-unstyled">
                    @forelse($ChitietPosts as $relatedPost)
                    <li class="mb-3 d-flex align-items-start">
                        <a href="{{ route('blog.show', $relatedPost->id) }}" class="flex-shrink-0 me-3">
                            <img src="{{ asset('storage/' . $relatedPost->image) }}" alt="{{ $relatedPost->title }}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                        </a>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <a href="{{ route('blog.show', $relatedPost->id) }}" class="text-decoration-none text-dark fw-semibold">
                                    {{ $relatedPost->title }}
                                </a>
                            </h6>
                            <p class="small text-muted mb-0">
                                {{ \Carbon\Carbon::parse($relatedPost->created_at)->format('d/m/Y') }}
                            </p>
                        </div>
                    </li>
                    @empty
                    <li>Không có bài viết liên quan.</li>
                    @endforelse
                </ul>
            </aside>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function sharePost() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $post->title }}',
                text: 'Đọc bài viết: {{ $post->title }}',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => alert('Đã sao chép link bài viết!'));
        }
    }
</script>
@endsection