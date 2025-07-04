@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <div class="row g-5">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-lg-6">
            <div class="border p-4 rounded shadow-sm bg-white">
                <div class="main-image mb-3 text-center">
                    <img id="mainImage" src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                        class="img-fluid rounded" style="max-height: 450px; object-fit: contain;" />
                </div>

                @if ($product->images && count($product->images))
                <div class="swiper thumbnail-gallery">
                    <div class="swiper-wrapper">
                        @foreach ($product->images as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset($img->path) }}" alt="{{ $product->name }}"
                                class="img-fluid rounded thumb-img" />
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-lg-6">
            <div class="border p-4 rounded shadow bg-white">
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex flex-column gap-3 mb-4">
                    @csrf

                    {{-- Nếu có size --}}
                    @if ($product->sizes->isNotEmpty())
                    <div>
                        <label class="fw-bold">Chọn kích cỡ:</label>
                        <div class="d-flex flex-wrap gap-2 mt-2 size-options">
                            @foreach ($product->sizes as $size)
                            <label class="btn btn-outline-dark size-label">
                                <input type="radio" name="size_id" value="{{ $size->id }}"
                                    class="d-none size-radio" data-price="{{ $size->pivot->price }}">
                                <span>{{ $size->name }} - {{ number_format($size->pivot->price) }} đ</span>
                            </label>
                            @endforeach
                        </div>
                        <div id="selectedPrice" class="mt-2 fw-bold text-danger fs-4"></div>
                    </div>
                    @else
                    {{-- Nếu không có size, hiện giá mặc định --}}
                    <div class="mb-3 fs-4 text-danger fw-semibold">
                        {{ number_format($product->price) }} đ
                    </div>
                    @endif

                    <!-- Hidden input để gửi giá thực tế -->
                    <input type="hidden" name="price" id="priceInput" value="{{ $product->price }}">

                    <div class="d-flex align-items-center gap-3 mt-3">
                        <input type="number" name="quantity" class="form-control w-25" value="1" min="1" />
                        <button type="submit" class="btn btn-primary px-4">Thêm vào giỏ hàng</button>
                    </div>
                </form>

                <div class="text-muted">Đã bán: <strong>{{ $product->sold ?? 0 }}</strong> lần</div>
            </div>
        </div>
    </div>
</div>
<style>
    .thumb-img {
        max-height: 80px;
        cursor: pointer;
        object-fit: contain;
        padding: 3px;
    }

    .size-options .size-label {
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        transition: 0.2s;
        display: flex;
        align-items: center;
    }

    .size-radio:checked+span {
        background-color: #0d6efd;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
    }
</style>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('.size-radio');
        const selectedPrice = document.getElementById('selectedPrice');
        const priceInput = document.getElementById('priceInput');

        if (radios.length > 0) {
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const price = parseFloat(this.dataset.price);
                    selectedPrice.innerText = price.toLocaleString('vi-VN') + ' đ';
                    priceInput.value = price;
                });
            });

            // Mặc định chọn size đầu tiên
            radios[0].checked = true;
            radios[0].dispatchEvent(new Event('change'));
        }

        // Thay ảnh chính khi click thumbnail
        document.querySelectorAll('.thumb-img').forEach(img => {
            img.addEventListener('click', () => {
                document.getElementById('mainImage').src = img.src;
            });
        });
    });
</script>
@endsection