@extends('frontend.layout')

@section('content')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

<section class="py-3">
    <div class="container">
        <div class="main">
            <img src="{{ asset('frontend/assets/img/login.png') }}" alt="Reset Password Image">

            <div class="login-box">
                <h2>Đặt lại mật khẩu</h2>

                {{-- Thông báo trạng thái --}}
                @if (session('status'))
                <div style="color: #22c55e; text-align:center; margin-bottom: 10px;">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    {{-- Password Reset Token --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email Address --}}
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $request->email) }}"
                        required autofocus autocomplete="username">
                    @error('email')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror

                    {{-- Password --}}
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password">
                    @error('password')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror

                    {{-- Confirm Password --}}
                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="login-btn">Đặt lại mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .main {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 40px;
    }

    .main img {
        max-width: 45%;
        border-radius: 12px;
    }

    .login-box {
        background-color: #f3f4f6;
        padding: 40px;
        border-radius: 20px;
        width: 500px;
    }

    .login-box h2 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
        color: #111;
    }

    .login-box label {
        display: block;
        margin: 15px 0 5px;
        font-size: 16px;
        color: #111;
    }

    .login-box input {
        width: 100%;
        padding: 12px 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
        background-color: #fff;
        color: #111;
    }

    .login-btn {
        width: 100%;
        background-color: #ea580c;
        padding: 14px 0;
        border-radius: 5px;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        border: none;
        cursor: pointer;
    }
</style>

@endsection