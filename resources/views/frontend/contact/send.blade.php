@extends('frontend.layout')

@section('content')
<div class="container my-5 text-center">
    <h3 class="text-success">{{ $success ?? 'Gửi liên hệ thành công!' }}</h3>
    <p>Cảm ơn bạn đã liên hệ với TakeXX. Chúng tôi sẽ phản hồi sớm nhất.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Về trang chủ</a>
</div>
@endsection
