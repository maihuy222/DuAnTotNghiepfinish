@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">📊 Báo cáo tổng hợp</h3>

    <form action="{{ route('admin.baocao') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="from_date">Từ ngày:</label>
                <input type="date" name="from_date" id="from_date" class="form-control"
                    value="{{ request('from_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-3">
                <label for="to_date">Đến ngày:</label>
                <input type="date" name="to_date" id="to_date" class="form-control"
                    value="{{ request('to_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary">Xem báo cáo</button>
            </div>
        </div>
    </form>

    <h5 class="mb-4">
        📅 Từ ngày {{ \Carbon\Carbon::parse(request('from_date', now()))->format('d/m/Y') }}
        đến {{ \Carbon\Carbon::parse(request('to_date', now()))->format('d/m/Y') }}
    </h5>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-light p-3">
                <strong>🛒 Đơn hàng:</strong>
                <div class="h5 mb-0">{{ $todayOrdersCount }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light p-3">
                <strong>👤 Khách hàng mới:</strong>
                <div class="h5 mb-0">{{ $todayCustomersCount }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light p-3">
                <strong>📦 Sản phẩm bán ra:</strong>
                <div class="h5 mb-0">{{ $todayProductsSold }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light p-3">
                <strong>💰 Doanh thu:</strong>
                <div class="h5 mb-0 text-success">{{ number_format($todayRevenue, 0, ',', '.') }}₫</div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h5>📈 Biểu đồ doanh thu</h5>
        <canvas id="revenueChart" height="100"></canvas>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const canvas = document.getElementById('revenueChart');
        if (!canvas) {
            console.error('Không tìm thấy canvas');
            return;
        }

        const ctx = canvas.getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {
                    !!json_encode($revenueDates) !!
                },
                datasets: [{
                    label: 'Doanh thu (₫)',
                    data: {
                        !!json_encode($revenueValues) !!
                    },
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat().format(value) + '₫';
                            }
                        }
                    }
                }
            }
        });
    });
</script>




@endsection