@extends('frontend.layout')
@section('content')


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

<section class="py-3">
    <div class="container">
        <div class="main">
            <img src="{{ asset('frontend/assets/img/login.png') }}" alt="Food Image">


            <div class="login-box">
                <h2>Login</h2>

                {{-- Hiển thị thông báo lỗi chung --}}
                @if (session('status'))
                <div style="color: #facc15; text-align:center; margin-bottom: 10px;">
                    {{ session('status') }}
                </div>
                @endif

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                    <div style="color: red; font-size: 14px;">{{ $message }}</div>
                    @enderror

                    <div class="forgot">
                        <a href="{{ route('password.request') }}" style="color: #facc15;">Forgot Password?</a>
                    </div>

                    <button type="submit" class="login-btn">Sign in</button>
                </form>

                <div class="social-login">
                    <span>or continue with</span>
                    <div class="social-icons">
                        <div><img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo"></div>
                        <div><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook"></div>
                        <div><img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple"></div>
                    </div>
                </div>

                <div class="register">
                    Don’t have an account yet?
                    <a href="{{ route('register') }}">Register here</a>
                </div>
            </div>
        </div>
    </div>


    </section>


    <style>
       
      

      


        .close {
            position: absolute;
            right: 40px;
            font-size: 32px;
            color: #ea580c;
            /* ✅ Chữ X màu cam nổi bật */
            cursor: pointer;
        }

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
            /* ✅ Box login nền xám sáng */
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
            /* ✅ Tiêu đề màu đen */
        }

        .login-box label {
            display: block;
            margin: 15px 0 5px;
            font-size: 18px;
            color: #111;
            /* ✅ Label màu đen */
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

        .forgot {
            text-align: right;
            margin-bottom: 20px;
            color: #555;
            /* ✅ Màu chữ nhạt hơn */
            font-size: 14px;
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

        .social-login {
            margin-top: 30px;
            text-align: center;
        }

        .social-login span {
            display: block;
            margin-bottom: 15px;
            color: #555;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icons div {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-icons img {
            width: 60%;
            height: auto;
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