@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">Danh sách người dùng</li>
            <li class="breadcrumb-item"><a href="">Thêm người dùng</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo mới người dùng</h3>
                <div class="tile-body">
                    <form class="row" method="POST" action="{{ route('admin.storenguoidung') }}">
                        @csrf
                        <div class="form-group col-md-3">
                            <label class="control-label">Tên người dùng</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nhập tên người dùng">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Email</label>
                            <input name="email" type="email" value="{{ old('email') }}"
                                placeholder="Nhập email"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Địa chỉ</label>
                            <input name="address" type="text" value="{{ old('address') }}"
                                placeholder="Nhập địa chỉ"
                                class="form-control @error('address') is-invalid @enderror">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Mật khẩu</label>
                            <input name="password" type="password"
                                placeholder="Nhập mật khẩu"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <button class="btn btn-primary" type="submit">Lưu lại</button>
                            <a class="btn btn-secondary" href="">Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection