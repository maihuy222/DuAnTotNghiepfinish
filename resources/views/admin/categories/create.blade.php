@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Thêm danh mục</h2>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

    <hr>

    <h4>Danh mục hiện có</h4>
    <ul class="list-group">
        @forelse ($categories as $category)
        <li class="list-group-item">{{ $category->name }}</li>
        @empty
        <li class="list-group-item text-muted">Chưa có danh mục nào</li>
        @endforelse
    </ul>
</div>
<div class="form-group">
    <label>
        <input type="checkbox" name="show_in_nav" value="1" {{ old('show_in_nav', $category->show_in_nav ?? false) ? 'checked' : '' }}>
        Hiển thị trên thanh điều hướng
    </label>
</div>


@endsection