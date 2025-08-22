@extends('admin.layout')
@section('content')


<!-- Navbar-->


<main class="app-content">
    <div class="row">
        <div class="col-md-12">
            <div class="app-title">
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><b>Bảng điều khiển</b></a></li>
                </ul>
                <div id="clock"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <!--Left-->
        <div class="col-md-12 col-lg-6">
            <div class="row">
                <!-- col-6 -->
                <div class="col-md-6">
                    <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
                        <div class="info">
                            <h4>Tổng khách hàng</h4>
                            <p><b>{{ $totalCustomers }} khách hàng</b></p>
                            <p class="info-tong">Tổng số khách hàng được quản lý.</p>
                        </div>
                    </div>
                </div>
                <!-- col-6 -->
                <div class="col-md-6">
                    <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
                        <div class="info">
                            <h4>Tổng sản phẩm</h4>
                            <p><b>{{ $totalProducts }} sản phẩm</b></p>
                            <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
                        </div>
                    </div>
                </div>
                <!-- col-6 -->
                <div class="col-md-6">
                    <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
                        <div class="info">
                            <h4>Tổng đơn hàng</h4>
                            <p><b>{{ $totalOrders }} đơn hàng</b></p>
                            <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
                        </div>
                    </div>
                </div>
                <!-- col-6 -->
                <div class="col-md-6">
                    <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
                        <div class="info">
                            <h4>Sắp hết hàng</h4>
                            <p><b>{{ $lowStockCount }} sản phẩm</b></p>
                            <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
                        </div>
                    </div>
                </div>
                <!-- col-12 -->
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Tình trạng đơn hàng</h3>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>AL3947</td>
                                        <td>Phạm Thị Ngọc</td>
                                        <td>
                                            19.770.000 đ
                                        </td>
                                        <td><span class="badge bg-info">Chờ xử lý</span></td>
                                    </tr>
                                    <tr>
                                        <td>ER3835</td>
                                        <td>Nguyễn Thị Mỹ Yến</td>
                                        <td>
                                            16.770.000 đ
                                        </td>
                                        <td><span class="badge bg-warning">Đang vận chuyển</span></td>
                                    </tr>
                                    <tr>
                                        <td>MD0837</td>
                                        <td>Triệu Thanh Phú</td>
                                        <td>
                                            9.400.000 đ
                                        </td>
                                        <td><span class="badge bg-success">Đã hoàn thành</span></td>
                                    </tr>
                                    <tr>
                                        <td>MT9835</td>
                                        <td>Đặng Hoàng Phúc </td>
                                        <td>
                                            40.650.000 đ
                                        </td>
                                        <td><span class="badge bg-danger">Đã hủy </span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- / div trống-->
                    </div>
                </div>
                <!-- / col-12 -->
                <!-- col-12 -->
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Khách hàng mới</h3>
                        <div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khách hàng</th>
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentCustomers as $customer)
                                    <tr>
                                        <td>#{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($customer->birth_date)->format('d/m/Y') }}</td>
                                        <td><span class="tag tag-success">{{ $customer->phone }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
                <!-- / col-12 -->
            </div>
        </div>
        <!--END left-->
        <!--Right-->
        <div class="col-md-12 col-lg-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <h3 class="tile-title">Dữ liệu 6 tháng đầu vào</h3>
                        <div class="embed-responsive embed-responsive-16by9">                          
                            <canvas class="embed-responsive-item" id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
              
            </div>

        </div>
        <!--END right-->
    </div>


    <div class="text-center" style="font-size: 13px">
        <p><b>Copyright

            </b></p>
    </div>
</main>
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($months);
    const data = {
        labels: labels,
        datasets: [{
            label: 'Doanh thu theo tháng (VNĐ)',
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            data: @json($revenues),
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' đ';
                        }
                    }
                }
            }
        }
    };

    new Chart(document.getElementById('revenueChart'), config);
</script>

@endsection