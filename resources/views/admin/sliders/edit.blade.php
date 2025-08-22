@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Quản lý quảng cáo</a></li>
            <li class="breadcrumb-item active"><a href="#"><b>Chỉnh sửa quảng cáo</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-header">
                    <h3 class="tile-title">Chỉnh sửa quảng cáo</h3>
                </div>
                <div class="tile-body">
                    <form id="editSliderForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $slider->title }}" required maxlength="100">
                                    <small class="form-text text-muted">Tối đa 100 ký tự</small>
                                </div>

                                <div class="form-group">
                                    <label for="link">Link (tùy chọn)</label>
                                    <input type="url" class="form-control" id="link" name="link" value="{{ $slider->link }}" placeholder="https://example.com">
                                    <small class="form-text text-muted">Link sẽ mở khi người dùng click vào quảng cáo</small>
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình ảnh mới (tùy chọn)</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                    <small class="form-text text-muted">Định dạng: JPEG, PNG, JPG, GIF. Tối đa 2MB. Để trống nếu không muốn thay đổi</small>
                                </div>

                                <div class="form-group">
                                    <label>Hình ảnh hiện tại:</label>
                                    @if($slider->image)
                                        <div class="current-image">
                                            <img src="{{ asset('storage/' . $slider->image) }}" 
                                                 alt="{{ $slider->title }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 300px; max-height: 200px;">
                                        </div>
                                    @else
                                        <p class="text-muted">Không có hình ảnh</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div id="imagePreview" style="display: none;">
                                        <label>Hình ảnh mới:</label>
                                        <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Thông tin quảng cáo</h6>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>ID:</strong> {{ $slider->id }}</p>
                                        <p><strong>Ngày tạo:</strong> {{ $slider->created_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>Cập nhật lần cuối:</strong> {{ $slider->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6>Hướng dẫn</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-info-circle text-info"></i> Tiêu đề là bắt buộc</li>
                                            <li><i class="fas fa-image text-success"></i> Hình ảnh là tùy chọn</li>
                                            <li><i class="fas fa-link text-warning"></i> Link là tùy chọn</li>
                                            <li><i class="fas fa-exclamation-triangle text-danger"></i> Kích thước tối đa: 2MB</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tile-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật quảng cáo
                            </button>
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </form>
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
// Preview hình ảnh mới
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});

// Submit form
$('#editSliderForm').on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    
    $.ajax({
        url: '{{ route("admin.sliders.update", $slider->id) }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                swal("Thành công!", response.message, "success").then(() => {
                    window.location.href = '{{ route("admin.sliders.index") }}';
                });
            } else {
                swal("Lỗi!", response.message, "error");
            }
        },
        error: function(xhr) {
            var message = "Có lỗi xảy ra khi cập nhật quảng cáo";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = [];
                for (var field in errors) {
                    errorMessages.push(errors[field][0]);
                }
                message = errorMessages.join('\n');
            }
            swal("Lỗi!", message, "error");
        }
    });
});

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