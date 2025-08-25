@extends('frontend.layout')
@section('title', 'Về Quán TakeXX')
@section('content')

<div class="about-takexx text-gray-800" style="padding-top: 0; margin-top: 0;">
    <!-- HERO -->
    <section class="relative bg-gradient-to-br from-orange-500 via-rose-500 to-pink-600 text-white overflow-hidden" style="margin-top: 0;">
        <img src="https://images.unsplash.com/photo-1600891964093-4d2e6d93f6c3?w=1600"
             alt="Hero Banner"
             class="absolute inset-0 w-full h-full object-cover opacity-30">
        <div class="relative z-10 container mx-auto px-6 py-24 text-center">
            <h1 class="text-5xl sm:text-6xl font-extrabold drop-shadow-lg animate-fade-in">TakeXX — Nơi Vị Ngon Lên Tiếng</h1>
            <p class="mt-6 text-xl max-w-2xl mx-auto animate-slide-up">Ẩm thực tinh hoa, giao nhanh, nóng hổi, phục vụ tận tâm 24/7 với đam mê và chất lượng hàng đầu.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('products.index') }}" class="btn-primary inline-block px-8 py-4 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-full shadow-lg transition duration-300">🍽️ Xem Thực Đơn</a>
                <a href="{{ route('blog.index') }}" class="btn-outline inline-block px-8 py-4 bg-transparent border-2 border-white hover:bg-white hover:text-orange-600 text-white font-semibold rounded-full transition duration-300">📖 Blog Ẩm Thực</a>
            </div>
        </div>
    </section>
    
    <!-- OUR STORY - CHỈ GIỮ LẠI 1 SECTION -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800">Câu Chuyện TakeXX</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Từ một ý tưởng nhỏ, TakeXX đã trở thành điểm đến yêu thích của những tín đồ ẩm thực, mang đến trải nghiệm độc đáo với những món ăn và đồ uống đậm chất riêng.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="order-2 md:order-1">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800"
                         alt="Our Story"
                         class="rounded-lg shadow-lg w-full object-cover h-96">
                </div>
                <div class="order-1 md:order-2">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Hành Trình Hương Vị</h3>
                    <p class="text-gray-600">Ra đời vào năm 2020, TakeXX bắt đầu từ niềm đam mê mang đến những món ăn ngon, chất lượng và dịch vụ tận tâm. Chúng tôi tin rằng mỗi món ăn không chỉ là thực phẩm, mà còn là câu chuyện, cảm xúc và sự kết nối. Từ những nguyên liệu tươi ngon nhất đến bàn tay tài hoa của đội ngũ đầu bếp, TakeXX cam kết mang lại trải nghiệm ẩm thực khó quên.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR MISSION -->
    <section class="py-16 bg-gradient-to-r from-orange-50 to-pink-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">Sứ Mệnh Của Chúng Tôi</h2>
                <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">
                    TakeXX luôn hướng đến việc mang lại trải nghiệm ẩm thực tốt nhất cho khách hàng: ngon, nhanh và tận tâm.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="p-5 bg-white rounded-2xl shadow-md hover:shadow-xl transition text-center">
                    <div class="flex items-center justify-center w-14 h-14 bg-orange-100 text-orange-600 rounded-full mx-auto mb-3 text-2xl shadow">
                        🍴
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Chất Lượng Hàng Đầu</h3>
                    <p class="mt-2 text-gray-600">Nguyên liệu tươi ngon, chọn lọc kỹ lưỡng từ những nguồn cung cấp uy tín nhất.</p>
                </div>
                
                <!-- Card 2 -->
                <div class="p-5 bg-white rounded-2xl shadow-md hover:shadow-xl transition text-center">
                    <div class="flex items-center justify-center w-14 h-14 bg-orange-100 text-orange-600 rounded-full mx-auto mb-3 text-2xl shadow">
                        🚀
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Giao Hàng Nhanh Chóng</h3>
                    <p class="mt-2 text-gray-600">Dịch vụ giao hàng 24/7, đảm bảo món ăn luôn nóng hổi khi đến tay khách hàng.</p>
                </div>
                
                <!-- Card 3 -->
                <div class="p-5 bg-white rounded-2xl shadow-md hover:shadow-xl transition text-center">
                    <div class="flex items-center justify-center w-14 h-14 bg-orange-100 text-orange-600 rounded-full mx-auto mb-3 text-2xl shadow">
                        ❤️
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Phục Vụ Tận Tâm</h3>
                    <p class="mt-2 text-gray-600">Đội ngũ TakeXX luôn sẵn sàng mang đến trải nghiệm tuyệt vời nhất cho khách hàng.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- OUR TEAM -->
    <section class="py-16 bg-gradient-to-br from-orange-100 to-pink-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">Đội Ngũ TakeXX</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                    Gặp gỡ những người đứng sau những món ăn và đồ uống tuyệt hảo của TakeXX.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400"
                         alt="Anna Nguyễn"
                         class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover mx-auto"
                         loading="lazy">
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">Anna Nguyễn</h3>
                    <p class="text-gray-500 text-sm">Đầu Bếp Trưởng</p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400"
                         alt="Minh Hoàng"
                         class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover mx-auto"
                         loading="lazy">
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">Minh Hoàng</h3>
                    <p class="text-gray-500 text-sm">Quản Lý Nhà Hàng</p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400"
                         alt="Thu Hà"
                         class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover mx-auto"
                         loading="lazy">
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">Thu Hà</h3>
                    <p class="text-gray-500 text-sm">Chuyên Viên Phục Vụ</p>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-2xl p-6 text-center shadow hover:shadow-lg transition">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400"
                         alt="Đức Anh"
                         class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover mx-auto"
                         loading="lazy">
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">Đức Anh</h3>
                    <p class="text-gray-500 text-sm">Trưởng Bộ Phận Giao Hàng</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="py-16 bg-orange-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold">Tham Gia Cùng TakeXX</h2>
            <p class="mt-4 text-lg max-w-2xl mx-auto">Hãy thưởng thức những món ăn và đồ uống tuyệt vời từ TakeXX ngay hôm nay. Đặt hàng để trải nghiệm ẩm thực đỉnh cao!</p>
            <div class="mt-8">
                <a href="{{ route('products.index') }}" class="inline-block px-8 py-4 bg-white text-orange-600 font-semibold rounded-full shadow-lg hover:bg-gray-100 transition duration-300">Đặt Hàng Ngay</a>
            </div>
        </div>
    </section>
</div>

<!-- Thêm vào layout chung -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<!-- Custom CSS for Animations -->
<style>
    /* Reset any potential margin/padding issues */
    .about-takexx {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    
    /* If navbar is fixed, add padding to compensate */
    body.has-fixed-navbar .about-takexx {
        padding-top: 4rem; /* 64px navbar height */
    }
    
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }
    .animate-slide-up {
        animation: slideUp 1s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    body {
        font-family: "Segoe UI Emoji", "Noto Color Emoji", sans-serif;
    }
</style>
@endsection