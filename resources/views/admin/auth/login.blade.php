<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập quản trị | Website quản trị v2.0</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Link CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/until.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('frontend/assets/img/login.png') }}" alt="Food Image">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf
                    <span class="login100-form-title">
                        <b>ĐĂNG NHẬP HỆ THỐNG ADMIN</b>
                    </span>

                    {{-- Thông báo lỗi --}}
                    @if ($errors->any())
                    <div class="alert alert-danger w-100">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Tài khoản --}}
                    <div class="wrap-input100 validate-input">
                        <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email admin" value="{{ old('email') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class='bx bx-user'></i>
                        </span>

                    
                    </div>


                    {{-- Mật khẩu --}}
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="password" name="password" placeholder="Mật khẩu" id="password-field" required>
                        <span toggle="#password-field" class="bx fa-fw bx-hide field-icon click-eye"></span>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class='bx bx-key'></i>
                        </span>
                    </div>

                    {{-- Nút đăng nhập --}}
                    <div class="container-login100-form-btn">
                        <button class="login-btn" type="submit">
                            Đăng nhập
                        </button>
                    </div>

                    {{-- Link quên mật khẩu (nếu cần) --}}
                    <div class="text-right p-t-12">
                        <a class="txt2" href="#">
                            Quên mật khẩu?
                        </a>
                    </div>

                    {{-- Footer --}}

                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        //show - hide mật khẩu
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text"
            } else {
                x.type = "password";
            }
        }
        $(".click-eye").click(function() {
            $(this).toggleClass("bx-show bx-hide");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

</body>

</html>