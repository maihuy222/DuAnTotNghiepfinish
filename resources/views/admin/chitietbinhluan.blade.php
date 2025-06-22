@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><a href="{{ route('admin.quanly.binhluan') }}">Quản lý bình luận</a></li>
            <li class="breadcrumb-item active"><a href="#"><b>Chi tiết bình luận</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Thông tin bình luận</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Mã bình luận:</th>
                                    <td>BL{{ $binhLuan['id'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tên người dùng:</th>
                                    <td>{{ $binhLuan['ten_nguoi_dung'] }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $binhLuan['email'] }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại:</th>
                                    <td>{{ $binhLuan['so_dien_thoai'] }}</td>
                                </tr>
                                <tr>
                                    <th>Sản phẩm:</th>
                                    <td>{{ $binhLuan['san_pham'] }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày bình luận:</th>
                                    <td>{{ $binhLuan['ngay_binh_luan'] }}</td>
                                </tr>
                                <tr>
                                    <th>Điểm đánh giá:</th>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $binhLuan['diem_danh_gia'])
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        ({{ $binhLuan['diem_danh_gia'] }}/5)
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái:</th>
                                    <td>
                                        @if($binhLuan['trang_thai'] == 'Đã duyệt')
                                            <span class="badge bg-success">{{ $binhLuan['trang_thai'] }}</span>
                                        @elseif($binhLuan['trang_thai'] == 'Chờ duyệt')
                                            <span class="badge bg-warning">{{ $binhLuan['trang_thai'] }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $binhLuan['trang_thai'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nội dung bình luận:</th>
                                    <td>
                                        <div class="border p-3 bg-light">
                                            {{ $binhLuan['noi_dung'] }}
                                        </div>
                                    </td>
                                </tr>
                                @if(isset($binhLuan['phan_hoi']) && $binhLuan['phan_hoi'])
                                <tr>
                                    <th>Phản hồi:</th>
                                    <td>
                                        <div class="border p-3 bg-info text-white">
                                            {{ $binhLuan['phan_hoi'] }}
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-4">
                            <h4>Thao tác</h4>
                            <div class="card">
                                <div class="card-body">
                                    <h6>Cập nhật trạng thái:</h6>
                                    <select class="form-control mb-3" id="trangThaiSelect">
                                        <option value="Chờ duyệt" {{ $binhLuan['trang_thai'] == 'Chờ duyệt' ? 'selected' : '' }}>Chờ duyệt</option>
                                        <option value="Đã duyệt" {{ $binhLuan['trang_thai'] == 'Đã duyệt' ? 'selected' : '' }}>Đã duyệt</option>
                                        <option value="Từ chối" {{ $binhLuan['trang_thai'] == 'Từ chối' ? 'selected' : '' }}>Từ chối</option>
                                    </select>
                                    <button class="btn btn-primary btn-block mb-3" onclick="updateStatus()">
                                        <i class="fas fa-save"></i> Cập nhật trạng thái
                                    </button>

                                    <hr>

                                    <h6>Phản hồi bình luận:</h6>
                                    <textarea class="form-control mb-3" id="phanHoiText" rows="4" placeholder="Nhập phản hồi...">{{ $binhLuan['phan_hoi'] ?? '' }}</textarea>
                                    <button class="btn btn-info btn-block mb-3" onclick="replyComment()">
                                        <i class="fas fa-reply"></i> Gửi phản hồi
                                    </button>

                                    <hr>

                                    <button class="btn btn-danger btn-block" onclick="deleteComment()">
                                        <i class="fas fa-trash"></i> Xóa bình luận
                                    </button>
                                </div>
                            </div>
                        </div>
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
function updateStatus() {
    var trangThai = $('#trangThaiSelect').val();
    
    $.ajax({
        url: '/admin/binhluan/{{ $binhLuan["id"] }}/status',
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            trang_thai: trangThai
        },
        success: function(response) {
            if(response.success) {
                swal("Thành công!", response.message, "success").then(() => {
                    location.reload();
                });
            } else {
                swal("Lỗi!", response.message, "error");
            }
        },
        error: function(xhr) {
            var message = "Có lỗi xảy ra khi cập nhật trạng thái";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            swal("Lỗi!", message, "error");
        }
    });
}

function replyComment() {
    var phanHoi = $('#phanHoiText').val();
    
    if(!phanHoi.trim()) {
        swal("Lỗi!", "Vui lòng nhập nội dung phản hồi", "error");
        return;
    }
    
    $.ajax({
        url: '/admin/binhluan/{{ $binhLuan["id"] }}/reply',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            phan_hoi: phanHoi
        },
        success: function(response) {
            if(response.success) {
                swal("Thành công!", response.message, "success").then(() => {
                    location.reload();
                });
            } else {
                swal("Lỗi!", response.message, "error");
            }
        },
        error: function(xhr) {
            var message = "Có lỗi xảy ra khi gửi phản hồi";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            swal("Lỗi!", message, "error");
        }
    });
}

function deleteComment() {
    swal({
        title: "Cảnh báo",
        text: "Bạn có chắc chắn muốn xóa bình luận này?",
        icon: "warning",
        buttons: ["Hủy bỏ", "Đồng ý"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/admin/binhluan/{{ $binhLuan["id"] }}',
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        swal("Thành công!", response.message, "success").then(() => {
                            window.location.href = '{{ route("admin.quanly.binhluan") }}';
                        });
                    } else {
                        swal("Lỗi!", response.message, "error");
                    }
                },
                error: function(xhr) {
                    var message = "Có lỗi xảy ra khi xóa bình luận";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    swal("Lỗi!", message, "error");
                }
            });
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