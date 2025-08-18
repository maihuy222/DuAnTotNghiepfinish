@extends('frontend.layout')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
<section class="py-3">
    <div class="container">
        <div class="main">
            <img src="{{ asset('frontend/assets/img/login.png') }}" alt="Forgot Password">

            <div class="login-box">
                <h2>Forgot Password</h2>

                {{-- Thông báo trạng thái --}}
                @if (session('status'))
                <div style="color: #facc15; text-align:center; margin-bottom: 10px;">
                    {{ session('status') }}
                </div>
                @endif

                {{-- Form quên mật khẩu --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="login-btn">Send Reset Link</button>
                </form>

                <div class="register">
                    <a href="{{ route('login') }}">← Back to Login</a>
                </div>
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
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
        color: #111;
    }

    .login-box label {
        display: block;
        margin: 15px 0 5px;
        font-size: 18px;
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

    .register {
        margin-top: 20px;
        text-align: center;
        color: #555;
    }

    .register a {
        color: #ea580c;
        font-weight: bold;
        text-decoration: underline;
        margin-left: 5px;
    }
</style>
@endsection