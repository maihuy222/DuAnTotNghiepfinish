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
                    <form class="row" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label class="control-label">Tên sản phẩm</label>
                            <input name="name" class="form-control" type="text" placeholder="Nhập tên sản phẩm" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Số lượng</label>
                            <input name="quantity" class="form-control" type="number" min="0" placeholder="Nhập số lượng" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Giá bán</label>
                            <input name="price" class="form-control" type="number" step="0.01" placeholder="Nhập giá bán" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Tình trạng</label>
                            <select name="status" class="form-control" required>
                                <option value="">-- Chọn tình trạng --</option>
                                <option value="còn hàng">Còn hàng</option>
                                <option value="hết hàng">Hết hàng</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Danh mục</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group col-md-12">
                            <label class="control-label">Ảnh sản phẩm</label>

                            <div id="myfileupload" style="display: none;">
                                <input type="file" id="uploadfile" name="image" accept="image/*" onchange="readURL(this);" />
                            </div>

                            <div id="thumbbox" style="margin-top: 10px;">
                                <img height="300" width="auto" alt="Thumb image" id="thumbimage" style="display: none; border: 1px solid #ccc; padding: 5px; border-radius: 5px;" />
                                <a class="removeimg" href="javascript:;" style="display:none; color:red; font-weight:bold; font-size:20px; margin-left:10px;">&times;</a>
                            </div>

                            <div id="boxchoice" style="margin-top: 10px;">
                                <a href="javascript:;" class="Choicefile btn btn-outline-primary">
                                    <i class="fas fa-cloud-upload-alt"></i> Chọn ảnh
                                </a>
                                <span class="filename" style="margin-left: 10px; font-style: italic; color: #666;"></span>
                            </div>
                        </div>

                        <!-- Trong form chỉ để textarea thôi -->
                        <div class="form-group col-md-12">
                            <label class="control-label">Mô tả sản phẩm</label>
                            <textarea class="form-control" name="description" id="mota" rows="6" placeholder="Nhập mô tả sản phẩm..."></textarea>
                        </div>


                        <!-- Thêm CKEditor 4 -->
                        


                        <div class="form-group col-md-12">
                            <button class="btn btn-primary" type="submit">Lưu lại</button>
                            <a class="btn btn-secondary" href="{{ route('products.index') }}">Hủy bỏ</a>


                        </div>
                    </form>

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


<!--
  MODAL CHỨC VỤ 
-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
                        <span class="thong-tin-thanh-toan">
                            <h5>Thêm mới nhà cung cấp</h5>
                        </span>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Nhập tên chức vụ mới</label>
                        <input class="form-control" type="text" required>
                    </div>
                </div>
                <BR>
                <button class="btn btn-save" type="button">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                <BR>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--
MODAL
-->



<!--
  MODAL DANH MỤC
-->
<div class="modal fade" id="adddanhmuc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
                        <span class="thong-tin-thanh-toan">
                            <h5>Thêm mới danh mục </h5>
                        </span>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Nhập tên danh mục mới</label>
                        <input class="form-control" type="text" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Danh mục sản phẩm hiện đang có</label>
                        <ul style="padding-left: 20px;">
                            <li>Bàn ăn</li>
                            <li>Bàn thông minh</li>
                            <li>Tủ</li>
                            <li>Ghế gỗ</li>
                            <li>Ghế sắt</li>
                            <li>Giường người lớn</li>
                            <li>Giường trẻ em</li>
                            <li>Bàn trang điểm</li>
                            <li>Giá đỡ</li>
                        </ul>
                    </div>
                </div>
                <BR>
                <button class="btn btn-save" type="button">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                <BR>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--
MODAL
-->




<!--
  MODAL TÌNH TRẠNG
-->
<div class="modal fade" id="addtinhtrang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
                        <span class="thong-tin-thanh-toan">
                            <h5>Thêm mới tình trạng</h5>
                        </span>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Nhập tình trạng mới</label>
                        <input class="form-control" type="text" required>
                    </div>
                </div>
                <BR>
                <button class="btn btn-save" type="button">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                <BR>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--
MODAL
-->



<!-- Thư viện jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Thư viện CKEditor -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

<script>
    // ======== Khởi tạo CKEditor cho phần mô tả sản phẩm ========
    CKEDITOR.replace('mota', {
        height: 300,
        toolbarCanCollapse: true
    });

    // ======== Xử lý upload ảnh, xem trước và xóa ========
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#thumbimage").attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
            $('.filename').text(input.files[0].name);
            $(".removeimg").show();
        }
    }

    $(document).ready(function() {
        $(".Choicefile").on('click', function() {
            $("#uploadfile").click();
        });

        $(".removeimg").on('click', function() {
            $("#thumbimage").attr('src', '').hide();
            $("#uploadfile").val(''); // Reset input file
            $(".filename").text('');
            $(this).hide();
        });
    });
</script>




@endsection