@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#"><b>Quản lý quảng cáo</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-header">
                    <h3 class="tile-title">Danh sách quảng cáo</h3>
                    <div class="tile-header-buttons">
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm quảng cáo mới
                        </a>
                    </div>
                </div>
                <div class="tile-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="slidersTable">
                            <thead>
                                <tr>
                                    <th width="50">ID</th>
                                    <th width="100">Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Link</th>
                                    <th>Trạng thái</th>
                                    <th width="150">Ngày tạo</th>
                                    <th width="120">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>
                                        @if($slider->image)
                                        <img src="{{ asset('storage/' . $slider->image) }}"
                                            alt="{{ $slider->title }}"
                                            class="img-thumbnail"
                                            style="max-width: 80px; max-height: 60px;">
                                        @else
                                        <span class="text-muted">Không có hình</span>
                                        @endif
                                    </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>
                                        @if($slider->link)
                                        <a href="{{ $slider->link }}" target="_blank" class="text-primary">
                                            {{ Str::limit($slider->link, 50) }}
                                        </a>
                                        @else
                                        <span class="text-muted">Không có link</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $slider->is_active ? 'bg-success' : 'bg-secondary' }}" id="status-badge-{{ $slider->id }}">
                                            {{ $slider->is_active ? 'Đang hiển thị' : 'Đang ẩn' }}
                                        </span>
                                    </td>
                                    <td>{{ $slider->created_at->format('d/m/Y H:i') }}</td>
                                    @php
                                    $eyeIcon = $slider->is_active ? 'fa-eye' : 'fa-eye-slash';
                                    @endphp

                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                class="btn btn-sm btn-info"
                                                title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="deleteSlider({{ (int) $slider->id }})"
                                                title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <button type="button"
                                                class="btn btn-sm btn-warning"
                                                onclick="toggleActiveSlider({{ $slider->id }})"
                                                title="Bật/Tắt hiển thị">
                                                <i class="fas {{ $eyeIcon }}"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có quảng cáo nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/plugins/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
    function deleteSlider(id) {
        swal({
            title: "Cảnh báo",
            text: "Bạn có chắc chắn muốn xóa quảng cáo này?",
            icon: "warning",
            buttons: ["Hủy bỏ", "Đồng ý"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/admin/sliders/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            swal("Thành công!", response.message, "success").then(() => {
                                location.reload();
                            });
                        } else {
                            swal("Lỗi!", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        var message = "Có lỗi xảy ra khi xóa quảng cáo";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        swal("Lỗi!", message, "error");
                    }
                });
            }
        });
    }

    function toggleActiveSlider(id) {
        $.ajax({
            url: '/admin/sliders/' + id + '/toggle-active',
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    let badge = $('#status-badge-' + id);
                    if (response.is_active) {
                        badge.removeClass('bg-secondary').addClass('bg-success').text('Đang hiển thị');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-secondary').text('Đang ẩn');
                    }
                    swal('Thành công!', response.message, 'success');
                } else {
                    swal('Lỗi!', response.message, 'error');
                }
            },
            error: function(xhr) {
                var message = 'Có lỗi xảy ra khi thay đổi trạng thái slider';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                swal('Lỗi!', message, 'error');
            }
        });
    }

    // Thời gian
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
        tmp = '<span class="date"> ' + today + ' - ' + nowTime + '</span>';
        document.getElementById("clock").innerHTML = tmp;
        clocktime = setTimeout("time()", "1000", "Javascript");

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
    }

    time();
</script>

@endsection