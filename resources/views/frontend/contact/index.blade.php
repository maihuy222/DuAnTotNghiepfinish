@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success">🍲 Liên hệ với <span class="text-danger">TakeXX</span></h2>
        <p class="text-muted">Hãy để lại thông tin, chúng tôi sẽ phản hồi sớm nhất cho bạn!</p>
    </div>

    <div class="row g-4">
        <!-- Form liên hệ -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <form action="{{ route('frontend.contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">👤 Họ và tên</label>
                        <input type="text" class="form-control rounded-pill px-3" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">📧 Email</label>
                        <input type="email" class="form-control rounded-pill px-3" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">✍️ Nội dung</label>
                        <textarea class="form-control rounded-4 px-3 py-2" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2">
                        🚀 Gửi liên hệ
                    </button>
                </form>
            </div>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 p-4 bg-light">
                <h5 class="fw-bold mb-3 text-success">📍 Thông tin liên hệ</h5>
                <p><b>🏠 Địa chỉ:</b> 123 Nguyễn Văn Linh, Đà Nẵng</p>
                <p><b>📞 Điện thoại:</b> <span class="text-danger">0123 456 789</span></p>
                <p><b>📧 Email:</b> support@takexx.com</p>

                <div class="rounded-4 overflow-hidden shadow-sm mt-3">
                   <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.911441244511!2d108.2162125153653!3d16.067759988882025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c496e64a3f%3A0x7f87c1c1c74b0f0f!2zMTIzIE5ndXnhu4VuIFbEg24gTGluaCwgQ-G6o25nIE5oxqFuLCDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1692361123456!5m2!1svi!2s"
    width="100%" 
    height="300" 
    style="border:0; border-radius: 12px;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
</iframe>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
