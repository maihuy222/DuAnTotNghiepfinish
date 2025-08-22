@extends('admin.layout')

@section('content')
<main class="app-content">
    <div class="container">
        <h2>sửa thuộc tính</h2>
        <form method="POST" action="{{ route('admin.thuoctinh.update', ['id' =>$data ->id] ) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Tên Thuộc tính</label>
                <input type="text" name="name" class="form-control" value="{{ $data ->name}}">
                @error('name')
                <div class="text-danger">{{ $message}}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label>
                    <input type="checkbox" name="show_in_nav" value="1" {{ old('show_in_nav', $category->show_in_nav ?? false) ? 'checked' : '' }}>
                    Hiển thị trên thanh điều hướng
                </label>
            </div>

            <button class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.thuoctinh') }}" class="btn btn-secondary">Quay lại</a>
        </form>
        <hr>
</main>
@endsection