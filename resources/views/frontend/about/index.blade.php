@extends('frontend.layout')

@section('title', 'Về TakeXX - Nơi Vị Ngon Lên Tiếng')

@push('styles')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')
<div class="bg-light">
  <!-- HERO SECTION -->
<section class="position-relative text-white text-center overflow-hidden" 
         style="background: linear-gradient(135deg, #fd7e14, #f43f5e, #ec4899);">
    <div class="position-relative container py-5">
        <h1 class="display-3 fw-bold mb-4 animate-bounce" data-aos="fade-down">
            TakeXX 🍽️
        </h1>
        <p class="h4 mb-3" data-aos="fade-up" data-aos-delay="200">
            Nơi Vị Ngon Lên Tiếng
        </p>
        <p class="lead mb-5 opacity-75" data-aos="fade-up" data-aos-delay="400">
            Ẩm thực tinh hoa, giao nhanh như chớp, phục vụ tận tâm 24/7 với đam mê và chất lượng hàng đầu tại {{ config('app.city', 'Đà Nẵng') }}
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="zoom-in" data-aos-delay="600">
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg fw-bold shadow">
                🍕 Xem Thực Đơn
            </a>
            <a href="{{ route('frontend.contact.index') }}" class="btn btn-outline-light btn-lg fw-bold">
                📞 Liên Hệ Ngay
            </a>
        </div>
    </div>
</section>

<!-- STORY SECTION -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="fw-bold mb-4 h1">Câu Chuyện TakeXX 📖</h2>
                <p class="mb-3 fs-5 text-muted">
                    Ra đời vào năm {{ date('Y') - 4 }} tại thành phố {{ config('app.city', 'Đà Nẵng') }} xinh đẹp, TakeXX khởi đầu chỉ là một căn bếp nhỏ với niềm đam mê ẩm thực và mong muốn mang đến cho mọi người những bữa ăn chất lượng, an toàn và giàu cảm xúc. Trải qua chặng đường không dài nhưng đầy thử thách, chúng tôi đã dần trở thành một địa chỉ quen thuộc cho những ai yêu thích sự mới mẻ trong hương vị.
                </p>
                <p class="mb-3 fs-5 text-muted">
                    Chúng tôi tin rằng mỗi món ăn không chỉ đơn thuần là thực phẩm, mà còn chứa đựng câu chuyện, cảm xúc và sự kết nối giữa con người với con người. Từng nguyên liệu được chọn lựa kỹ càng, từng công đoạn chế biến được chăm chút tỉ mỉ, tất cả đều nhằm mang đến cho khách hàng trải nghiệm trọn vẹn nhất. 
                </p>
                <p class="mb-3 fs-5 text-muted">
                    Với đội ngũ đầu bếp sáng tạo, nhân viên nhiệt huyết và hệ thống phục vụ linh hoạt, TakeXX không ngừng đổi mới để làm hài lòng ngay cả những thực khách khó tính nhất. Hành trình này mới chỉ bắt đầu, và chúng tôi mong muốn được tiếp tục đồng hành cùng bạn trong những khoảnh khắc ấm áp bên bàn ăn.
                </p>

                <div class="d-flex gap-4">
                    @php
                        $stats = [
                            ['number' => '5000+', 'label' => 'Khách hàng hài lòng'],
                            ['number' => '50+', 'label' => 'Món ăn đặc sắc'],
                            ['number' => '24/7', 'label' => 'Phục vụ không ngừng']
                        ];
                    @endphp
                    @foreach($stats as $stat)
                    <div class="text-orange">
                        <h3 class="fw-bold text-warning">{{ $stat['number'] }}</h3>
                        <p class="small text-muted">{{ $stat['label'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="{{ asset('images/restaurant-interior.jpg') }}" 
                         class="img-fluid rounded shadow-lg"
                         onerror="this.src='https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&h=400'" />
                    <div class="position-absolute bottom-0 end-0 bg-warning text-dark p-3 rounded shadow">
                        <p class="fw-bold mb-0">⭐ {{ config('app.rating', '4.9') }}/5.0</p>
                        <small>Đánh giá khách hàng</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STORY SECTION -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-4">
            <!-- ẢNH BÊN TRÁI -->
            <div class="col-lg-6 order-lg-1 order-2" data-aos="fade-right">
                <div class="position-relative">
                    <img src="{{ asset('images/restaurant-interior.jpg') }}" 
                         class="img-fluid rounded shadow-lg"
                         onerror="this.src='https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=600&fit=crop'" />
                    <div class="position-absolute bottom-0 start-0 bg-warning text-dark p-3 rounded shadow">
                        <p class="fw-bold mb-0">⭐ {{ config('app.rating', '4.8') }}/5.0</p>
                        <small>Đánh giá khách hàng</small>
                    </div>
                </div>
            </div>

     <!-- NỘI DUNG BÊN PHẢI -->
<div class="col-lg-6 order-lg-2 order-1" data-aos="fade-left">
    <h2 class="fw-bold mb-4 h1">Hành Trình Hương Vị TakeXX 🍽️</h2>
    <p class="mb-3 fs-5 text-muted">
        TakeXX không chỉ đơn thuần là một quán ăn, mà là nơi gửi gắm tình yêu với ẩm thực và sự chăm chút trong từng chi tiết.
        Mỗi món ăn được chế biến với tâm huyết của đầu bếp, mang lại sự hòa quyện giữa hương vị quen thuộc và nét sáng tạo mới lạ.
    </p>
    <p class="mb-3 fs-5 text-muted">
        Chúng tôi tin rằng một bữa ăn ngon không chỉ làm no bụng, mà còn gắn kết con người,
        tạo nên những kỷ niệm ấm áp bên bạn bè và gia đình. Với TakeXX, mỗi bữa ăn chính là một trải nghiệm đầy cảm xúc.
    </p>
    <div class="d-flex gap-4">
        @php
            $stats = [
                ['number' => '5000+', 'label' => 'Khách hàng hài lòng'],
                ['number' => '50+', 'label' => 'Món ăn đa dạng'],
                ['number' => '24/7', 'label' => 'Phục vụ tận tâm']
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="text-orange">
            <h3 class="fw-bold text-warning">{{ $stat['number'] }}</h3>
            <p class="small text-muted">{{ $stat['label'] }}</p>
        </div>
        @endforeach
    </div>
</div>


        </div>
    </div>
</section>

    <!-- MISSION SECTION -->
    <section class="py-5 bg-light">
        <div class="container text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold h1 mb-3">Sứ Mệnh Của Chúng Tôi 🎯</h2>
            <p class="lead text-muted">TakeXX luôn hướng đến việc mang lại trải nghiệm ẩm thực tốt nhất...</p>
        </div>
        <div class="container">
            <div class="row g-4">
                @php
                    $missions = [
                        ['icon' => '🍴', 'title' => 'Chất Lượng Hàng Đầu', 'description' => 'Nguyên liệu tươi ngon...', 'delay' => '100'],
                        ['icon' => '🚀', 'title' => 'Giao Hàng Siêu Tốc', 'description' => 'Dịch vụ giao hàng...', 'delay' => '200'],
                        ['icon' => '❤️', 'title' => 'Phục Vụ Tận Tâm', 'description' => 'Đội ngũ TakeXX...', 'delay' => '300']
                    ];
                @endphp
                @foreach($missions as $mission)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $mission['delay'] }}">
                    <div class="card border-0 shadow h-100">
                        <div class="card-body text-center">
                            <div class="fs-1 mb-3">{{ $mission['icon'] }}</div>
                            <h5 class="fw-bold mb-3">{{ $mission['title'] }}</h5>
                            <p class="text-muted">{{ $mission['description'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SPECIALTIES SECTION -->
    <section class="py-5 bg-white">
        <div class="container text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold h1 mb-3">Đặc Sản TakeXX 🍽️</h2>
            <p class="lead text-muted">Những món ăn và đồ uống được yêu thích nhất</p>
        </div>
        <div class="container">
            <div class="row g-4">
                @php
                    $specialties = [
                        ['icon' => '🍕', 'title' => 'Pizza Đặc Biệt', 'description' => 'Bánh pizza thủ công...', 'delay' => '100'],
                        ['icon' => '🍔', 'title' => 'Burger Bò Úc', 'description' => 'Thịt bò Úc thượng hạng...', 'delay' => '200'],
                        ['icon' => '🧋', 'title' => 'Trà Sữa Premium', 'description' => 'Trà sữa cao cấp...', 'delay' => '300'],
                        ['icon' => '🍰', 'title' => 'Bánh Ngọt Tươi', 'description' => 'Bánh ngọt handmade...', 'delay' => '400']
                    ];
                @endphp
                @foreach($specialties as $specialty)
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $specialty['delay'] }}">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="fs-1 mb-3">{{ $specialty['icon'] }}</div>
                            <h5 class="fw-bold  mt-2">{{ $specialty['title'] }}</h5>
                            <p class="text-dark small">{{ $specialty['description'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- TEAM SECTION -->
    <section class="py-5 bg-light">
        <div class="container text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold h1 mb-3">Đội Ngũ TakeXX 👥</h2>
            <p class="lead text-muted">Những người tài năng đứng sau thành công của TakeXX</p>
        </div>
        <div class="container">
            <div class="row g-4">
               @php
$team = [
    [
        'name' => 'Đình Nhân',
        'position' => '👩‍🍳 Đầu Bếp Trưởng',
        'description' => '10+ năm kinh nghiệm...',
        'image' => 'dinhnhan.png',
        'delay' => 100,
    ],
    [
        'name' => 'Hữu Huy',
        'position' => '👨‍💼 Quản Lý Nhà Hàng',
        'description' => 'Chuyên gia quản lý...',
        'image' => 'huuhuy.png',
        'delay' => 200,
    ],
    [
        'name' => 'Cửu Bình',
        'position' => '👩‍💻 Trưởng Phòng Marketing',
        'description' => 'Chuyên gia truyền thông...',
        'image' => 'cuubinh.png',
        'delay' => 300,
    ],
    [
        'name' => 'Minh Đức',
        'position' => '🏍️ Trưởng Bộ Phận Giao Hàng',
        'description' => 'Đảm bảo giao hàng nhanh...',
        'image' => 'minhduc.png',
        'delay' => 400,
    ],
    [
        'name' => 'Tuấn Vũ',
        'position' => '👩‍🎨 Thiết Kế Thực Đơn',
        'description' => 'Mang đến trải nghiệm mới mẻ cho thực khách...',
        'image' => 'tuanvu.png',
        'delay' => 540,
    ],
];
@endphp

<div class="row justify-content-center">
    @foreach($team as $member)
        <div class="col-md-6 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $member['delay'] }}">
            <div class="card text-center border-0 shadow h-100">
                <div class="card-body">
                <img src="{{ asset('assets/images/team/' . $member['image']) }}"
     alt="{{ $member['name'] }}"
     class="mb-3"
     style="
        width: 300px;
        height: 300px;
        border-radius: 50%;
        object-fit: cover;
        object-position: center;
     ">


                    <h5 class="fw-bold">{{ $member['name'] }}</h5>
                    <p class="text-dark small mb-1">{{ $member['position'] }}</p>
                    <p class="text-muted small">{{ $member['description'] }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="py-5 text-white" style="background: linear-gradient(90deg, #fd7e14, #ec4899);">
        <div class="container">
            <div class="row text-center g-4">
                @php
                    $statsData = [
                        ['number' => '5000+', 'label' => 'Khách hàng hài lòng', 'delay' => '100'],
                        ['number' => '50+', 'label' => 'Món ăn đặc sắc', 'delay' => '200'],
                        ['number' => '24/7', 'label' => 'Phục vụ không ngừng', 'delay' => '300'],
                        ['number' => config('app.rating', '4.9') . '⭐', 'label' => 'Đánh giá trung bình', 'delay' => '400']
                    ];
                @endphp
                @foreach($statsData as $stat)
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="{{ $stat['delay'] }}">
                    <h3 class="fw-bold">{{ $stat['number'] }}</h3>
                    <p class="small text-light">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-5 bg-white text-black text-center">
        <div class="container" data-aos="fade-up">
            <h2 class="fw-bold h1 mb-3">Thưởng Thức TakeXX Ngay Hôm Nay! 🎉</h2>
            <p class="lead text-muted mb-4">Đặt hàng ngay để trải nghiệm...</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg fw-bold shadow">📱 Đặt Hàng Online</a>
              
                <a href="tel:{{ config('app.phone') }}" class="btn hotline-btn btn-lg fw-bold">
    📞 Hotline: {{ config('app.phone', '0236.123.456') }}
</a>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
</script>
@endpush
