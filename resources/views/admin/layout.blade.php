<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách nhân viên | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main CSS-->
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }}">



    <!-- Boxicons CDN (Dùng 1 cái thôi) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    



    <!-- Font Awesome (Dùng bản mới, không cần dùng cả 2 bản cũ/mới) -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- SweetAlert CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- jQuery Confirm CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">
    <header class="app-header">
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
            aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">


            <!-- User Menu-->
            <li>
                <a class="app-nav__item text-dark d-flex align-items-center gap-2" href="{{ route('admin.logout') }}">
                    <i class='bx bx-log-out bx-rotate-180'></i>
                    <span>Đăng xuất</span>
                </a>
            </li>

        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar avatar" src="{{ asset('admin/assets/images/admin.png') }}" width="50" alt="User Image">

            <div>
                @if(session()->has('admin'))
                <p class="app-sidebar__user-name">
                    <b>{{ session('admin')->name }}</b>
                </p>
                <p class="app-sidebar__user-designation text-success">Chào mừng bạn trở lại!</p>
                @else
                <p class="app-sidebar__user-name"><b>Khách</b></p>
                <p class="app-sidebar__user-designation text-danger">Bạn chưa đăng nhập</p>
                @endif
            </div>
        </div>

        <hr>
        <ul class="app-menu">
            <li>
                <a class="app-menu__item haha" href="{{ asset('phan-mem-ban-hang.html') }}">
                    <i class='app-menu__icon bx bx-cart-alt'></i>
                    <span class="app-menu__label">POS Bán Hàng</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item active" href="{{ route('admin.dashboard') }}">
                    <i class='app-menu__icon bx bx-tachometer'></i>
                    <span class="app-menu__label">Bảng điều khiển</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item" href="{{ route('admin.quanly.nguoidung') }}">
                    <i class='app-menu__icon bx bx-user-voice'></i>
                    <span class="app-menu__label">Quản lý khách hàng</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item" href="{{ route('products.index') }}">
                    <i class='app-menu__icon bx bx-purchase-tag-alt'></i>
                    <span class="app-menu__label">Quản lý sản phẩm</span>
                </a>
            </li>

            <li>
                <a class="app-menu__item" href="{{ route('admin.quanly.binhluan') }}">
                    <i class='app-menu__icon bx bx-comment-detail'></i>
                    <span class="app-menu__label">Quản lý bình luận</span>
                </a>
            </li>

            <li><a class="app-menu__item" href="table-data-oder.html"><i class='app-menu__icon bx bx-task'></i><span
                        class="app-menu__label">Quản lý đơn hàng</span></a></li>
            <li>
                <a class="app-menu__item" href="{{ route('categories.index') }}">
                    <i class="app-menu__icon bx bx-category"></i>
                    <span class="app-menu__label">Quản lý danh mục</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item" href="{{ route('admin.sliders.index') }}">
                    <i class="app-menu__icon bx bx-images"></i>
                    <span class="app-menu__label">Quản lý quảng cáo</span>
                </a>
            </li>



            <li><a class="app-menu__item" href="table-data-money.html"><i class='app-menu__icon bx bx-dollar'></i><span
                        class="app-menu__label">Bảng kê lương</span></a></li>
            <li><a class="app-menu__item" href="quan-ly-bao-cao.html"><i
                        class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo doanh thu</span></a>
            </li>
            <!-- <li><a class="app-menu__item" href="page-calendar.html"><i class='app-menu__icon bx bx-calendar-check'></i><span
                        class="app-menu__label">Lịch công tác </span></a></li> -->
            <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
                        đặt hệ thống</span></a></li>
        </ul>
    </aside>


  
        @yield('content')
  


    <script src="{{ asset('admin/assets/ckeditor/ckeditor.js') }}"></script>
    @yield('js')


    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admin/assets/js/boxicons.js') }}"></script>
    <!--===============================================================================================-->
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('admin/assets/js/plugins/pace.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('admin/assets/js/plugins/chart.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript">
        var data = {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
            datasets: [{
                    label: "Dữ liệu đầu tiên",
                    fillColor: "rgba(255, 213, 59, 0.767), 212, 59)",
                    strokeColor: "rgb(255, 212, 59)",
                    pointColor: "rgb(255, 212, 59)",
                    pointStrokeColor: "rgb(255, 212, 59)",
                    pointHighlightFill: "rgb(255, 212, 59)",
                    pointHighlightStroke: "rgb(255, 212, 59)",
                    data: [20, 59, 90, 51, 56, 100]
                },
                {
                    label: "Dữ liệu kế tiếp",
                    fillColor: "rgba(9, 109, 239, 0.651)  ",
                    pointColor: "rgb(9, 109, 239)",
                    strokeColor: "rgb(9, 109, 239)",
                    pointStrokeColor: "rgb(9, 109, 239)",
                    pointHighlightFill: "rgb(9, 109, 239)",
                    pointHighlightStroke: "rgb(9, 109, 239)",
                    data: [48, 48, 49, 39, 86, 10]
                }
            ]
        };
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var ctxb = $("#barChartDemo").get(0).getContext("2d");
        var barChart = new Chart(ctxb).Bar(data);
    </script>
    <script type="text/javascript">
        //Thời Gian
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ Nhật";
            weekday[1] = "Thứ Hai";
            weekday[2] = "Thứ Ba";
            weekday[3] = "Thứ Tư";
            weekday[4] = "Thứ Năm";
            weekday[5] = "Thứ Sáu";
            weekday[6] = "Thứ Bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + " giờ " + m + " phút " + s + " giây";
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;
            tmp = '<span class="date"> ' + today + ' - ' + nowTime +
                '</span>';
            document.getElementById("clock").innerHTML = tmp;
            clocktime = setTimeout("time()", "1000", "Javascript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }
    </script>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@flasher/flasher-toastr@1.1.1/dist/flasher-toastr.min.css" rel="stylesheet" />

    <!-- JS - Bắt buộc: flasher core trước -->



</body>

</html>