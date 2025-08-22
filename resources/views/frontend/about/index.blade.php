@extends('frontend.layout')

@section('title', 'Về Quán TakeXX')
@section('content')
<div class="about-takexx text-gray-800">
    <!-- HERO -->
    <section class="relative bg-gradient-to-br from-orange-500 via-rose-500 to-pink-600 text-white overflow-hidden">
        <img src="https://images.unsplash.com/photo-1600891964093-4d2e6d93f6c3?w=1600" alt="Hero Banner" class="absolute inset-0 w-full h-full object-cover opacity-30 transition-opacity duration-500 hover:opacity-50">
        <div class="relative z-10 container mx-auto px-6 py-24 text-center animate-fade-in">
            <h1 class="text-5xl sm:text-6xl font-extrabold drop-shadow-lg leading-tight">TakeXX — Nơi Vị Ngon Lên Tiếng</h1>
            <p class="mt-6 text-xl max-w-3xl mx-auto leading-relaxed">Ẩm thực tinh hoa, giao nhanh, nóng hổi, phục vụ tận tâm 24/7 với đam mê và chất lượng hàng đầu.</p>
            <div class="mt-10 flex flex-wrap justify-center gap-6">
                <a href="{{ route('products.index') }}" class="px-8 py-3 rounded-full font-bold bg-white text-orange-600 shadow-lg hover:bg-orange-100 hover:shadow-xl transition-transform duration-300 transform hover:scale-105">🍽️ Xem Thực Đơn</a>
                <a href="{{ route('blog.index') }}" class="px-8 py-3 rounded-full font-bold border-2 border-white text-white hover:bg-white hover:text-rose-600 transition-colors duration-300">📖 Blog Ẩm Thực</a>
            </div>
        </div>
    </section>

    <!-- STORY -->
    <section class="bg-gray-50 py-24">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center animate-slide-up">
            <div class="order-2 md:order-1">
                <h2 class="text-4xl font-extrabold mb-6 text-gray-900">Câu Chuyện TakeXX</h2>
                <p class="text-lg text-gray-600 mb-4 leading-relaxed">
                    Thành lập từ 2020, TakeXX mong muốn mang đến trải nghiệm ẩm thực tiện lợi nhưng vẫn giữ trọn hương vị truyền thống và hiện đại.
                </p>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Với đội ngũ đầu bếp đam mê và dịch vụ giao hàng thần tốc, chúng tôi tự hào đem đến những món ăn ngon nhất mỗi ngày.
                </p>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-center"><span class="text-green-500 mr-2">✅</span> Nguyên liệu tươi sạch 100%</li>
                    <li class="flex items-center"><span class="text-blue-500 mr-2">⚡</span> Giao nhanh trong 30 phút</li>
                    <li class="flex items-center"><span class="text-red-500 mr-2">🛡️</span> An toàn thực phẩm chuẩn quốc tế</li>
                </ul>
            </div>
            <div class="order-1 md:order-2">
                <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=900" alt="Story Image" class="rounded-2xl shadow-lg hover:shadow-xl transition-transform duration-50 transform hover:scale-105">
            </div>
        </div>
    </section>

    <!-- SIGNATURE DISHES -->
    <section class="bg-white py-24">
        <div class="container mx-auto px-6 text-center animate-fade-in-up">
            <h2 class="text-4xl font-extrabold mb-12 text-gray-900">Món “Chữ Ký” Của TakeXX</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group bg-gray-50 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1601924582971-dbb1f19b1f2d?w=600" alt="Pizza" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-900">Pizza Bếp Lửa</h3>
                        <p class="text-gray-600 mt-2">Đế giòn, phô mai kéo sợi, sốt cà chua tươi ngon.</p>
                    </div>
                </div>
                <div class="group bg-gray-50 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=600" alt="Pho" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-900">Phở Bò Signature</h3>
                        <p class="text-gray-600 mt-2">Nước dùng trong, ngọt xương, thịt bò mềm tan.</p>
                    </div>
                </div>
                <div class="group bg-gray-50 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1556911220-e15b29be8c5d?w=600" alt="Salad" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="p-6 text-left">
                        <h3 class="text-2xl font-bold text-gray-900">Salad Green Day</h3>
                        <p class="text-gray-600 mt-2">Thanh mát, healthy, sốt đặc biệt nhà làm.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- GALLERY -->
    <section class="bg-gray-50 py-24">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center mb-12 text-gray-900 animate-fade-in">Khoảnh Khắc Tại Quán</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600" alt="Gallery 1" class="rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1546069901-eacef0df6022?w=600" alt="Gallery 2" class="rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1543353071-087092ec3934?w=600" alt="Gallery 3" class="rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=600" alt="Gallery 4" class="rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
                <img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=600" alt="Gallery 5" class="rounded-2xl shadow-md hover:shadow-lg transition-transform duration-300 transform hover:scale-105">
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-gradient-to-r from-orange-500 to-rose-600 py-20 text-white text-center animate-slide-up">
        <h2 class="text-4xl font-extrabold mb-4">Sẵn Sàng Thưởng Thức?</h2>
        <p class="text-lg mb-8">Đặt món ngay hôm nay — giao nhanh miễn phí với đơn từ 200.000đ.</p>
        <a href="{{ route('products.index') }}" class="px-8 py-3 rounded-full font-bold bg-white text-orange-600 shadow-lg hover:bg-orange-100 hover:shadow-xl transition-transform duration-300 transform hover:scale-105">Đặt Ngay 🍔</a>
    </section>
</div>
@endsection