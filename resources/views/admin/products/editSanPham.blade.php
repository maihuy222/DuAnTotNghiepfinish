@extends('admin.layout')
@section('content')
<style>
    .Choicefile {
        display: block;
        background: #14142B;
        border: 1px solid #fff;
        color: #fff;
        width: 150px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        padding: 5px 0px;
        border-radius: 5px;
        font-weight: 500;
        align-items: center;
        justify-content: center;
    }

    .Choicefile:hover {
        text-decoration: none;
        color: white;
    }

    #uploadfile,
    .removeimg {
        display: none;
    }

    #thumbbox {
        position: relative;
        width: 100%;
        margin-bottom: 20px;
    }

    .removeimg {
        height: 25px;
        position: absolute;
        background-repeat: no-repeat;
        top: 5px;
        left: 5px;
        background-size: 25px;
        width: 25px;
        /* border: 3px solid red; */
        border-radius: 50%;

    }

    .removeimg::before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        content: '';
        border: 1px solid red;
        background: red;
        text-align: center;
        display: block;
        margin-top: 11px;
        transform: rotate(45deg);
    }

    .removeimg::after {
        /* color: #FFF; */
        /* background-color: #DC403B; */
        content: '';
        background: red;
        border: 1px solid red;
        text-align: center;
        display: block;
        transform: rotate(-45deg);
        margin-top: -2px;
    }
</style>
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">Danh sách sản phẩm</li>
            <li class="breadcrumb-item"><a href="">Thêm sản phẩm</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo mới sản phẩm</h3>
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i
                                    class="fas fa-folder-plus"></i> Thêm nhà cung cấp</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#adddanhmuc"><i
                                    class="fas fa-folder-plus"></i> Thêm danh mục</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#addtinhtrang"><i
                                    class="fas fa-folder-plus"></i> Thêm tình trạng</a>
                        </div>
                    </div>

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Mã sản phẩm -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Mã sản phẩm (ID)</label>
                                <input class="form-control" type="text" value="{{ $product->id }}" disabled>
                            </div>

                            <!-- Tên sản phẩm -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <!-- Số lượng -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                            </div>

                            <!-- Tình trạng -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Tình trạng sản phẩm</label>
                                <select class="form-control" name="status" required>
                                    <option value="còn hàng" {{ $product->status == 'còn hàng' ? 'selected' : '' }}>Còn hàng</option>
                                    <option value="hết hàng" {{ $product->status == 'hết hàng' ? 'selected' : '' }}>Hết hàng</option>
                                    <option value="đang nhập hàng" {{ $product->status == 'đang nhập hàng' ? 'selected' : '' }}>Đang nhập hàng</option>
                                </select>
                            </div>

                            <!-- Giá bán -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Giá bán</label>
                                <input class="form-control" type="text" name="price" value="{{ old('price', $product->price) }}" required>
                            </div>

                            <!-- Danh mục -->
                            <div class="form-group col-md-6">
                                <label class="control-label">Danh mục</label>
                                <select class="form-control" name="category_id">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Kích thước / Size</label>
                                <div class="row">
                                    @foreach($sizes as $size)
                                    <div class="col-md-2 mb-2">
                                        <div class="form-check">
                                            <!-- Checkbox chọn size -->
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="sizes[{{ $size->id }}]"
                                                value="1"
                                                id="size{{ $size->id }}"
                                                {{ isset($productSizes[$size->id]) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="size{{ $size->id }}">
                                                {{ $size->name }}
                                            </label>

                                            <!-- Input giá size -->
                                            <input
                                                type="number"
                                                name="prices[{{ $size->id }}]"
                                                placeholder="Giá {{ $size->name }}"
                                                class="form-control mt-1"
                                                min="0"
                                                value="{{ old('prices.'.$size->id, $productSizes[$size->id] ?? '') }}">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>



                            <!-- Ảnh sản phẩm -->
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <input type="file" name="image" class="form-control">

                                @if($product->image)
                                <div style="margin-top: 10px;">
                                    <img src="{{ asset($product->image) }}" alt="Ảnh hiện tại" width="150" style="border-radius: 5px;">
                                </div>
                                @endif
                            </div>

                            <!-- Mô tả sản phẩm -->
                            <div class="form-group col-md-12">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="description" id="mota" rows="6">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy bỏ</a>
                    </form>

                    <!-- CKEditor -->
                    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace('mota');
                    </script>
                    <script>
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#thumbimage').attr('src', e.target.result).show();
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

</main>
@endsection