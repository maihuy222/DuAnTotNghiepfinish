@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="text-danger">❌ Thanh toán thất bại!</h2>
    <p>Vui lòng thử lại hoặc chọn phương thức khác.</p>
    <a href="{{ route('cart.index') }}" class="btn btn-warning">Quay lại giỏ hàng</a>
</div>
@endsection