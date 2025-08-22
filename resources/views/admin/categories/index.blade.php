@extends('admin.layout')
@section('content')

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách danh mục</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div class="row element-button">
                        <div class="col-sm-2">
                            <!-- Nút mở modal -->
                            <button class="btn btn-add btn-sm" data-toggle="modal" data-target="#adddanhmuc">
                                <i class="fas fa-plus"></i> Tạo mới danh mục
                            </button>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-hover table-bordered js-copytextarea" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox" id="all"></th>
                                <th>#</th>
                                <th>Tên danh mục</th>
                                <th>Slug</th>
                                <th width="150">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                            <tr>
                                <td><input type="checkbox" name="check1" value="{{ $item->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td class="table-td-center">
                                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xoá danh mục này?')" title="Xoá">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal thêm danh mục -->
<div class="modal fade" id="adddanhmuc" tabindex="-1" role="dialog" aria-labelledby="addDanhMucLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDanhMucLabel">Thêm mới danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{-- Thông báo lỗi tổng --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Tên danh mục --}}
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input class="form-control" name="name" type="text" value="{{ old('name') }}">
                        @error('name')
                        <div style="color: red; font-size: 14px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ảnh danh mục --}}
                    <div class="form-group">
                        <label for="image">Ảnh danh mục</label>
                        <input type="file" class="form-control-file" name="image" accept="image/*">
                        @error('image')
                        <div style="color: red; font-size: 14px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('admin/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>
    $('#sampleTable').DataTable();

    $('#all').click(function(e) {
        $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });

    // Tự mở modal nếu có lỗi
</script>
@endsection