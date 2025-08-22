@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Đóng">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="row element-button">
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="{{ route('products.create') }}" title="Thêm"><i class="fas fa-plus"></i>
                                Tạo mới sản phẩm</a>
                        </div>
                         <div class="col-sm-2">

                            <a class="btn btn-danger btn-sm" href="{{ route('products.trash') }}" title="xóa"><i class="fas fa-trash-alt"></i>
                                sản phẩm đã xóa</a>
                        </div>

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox" id="all"></th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Tình trạng</th>
                                <th>Giá tiền</th>
                                <th>Danh mục</th>
                                <th>Size</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td>{{ $product -> id }}</td>
                                <td> {{ $product -> name }}</td>
                                <td>
                                    @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100px">
                                    @else
                                    <span>Không có ảnh</span>
                                    @endif
                                </td>

                                <td>{{ $product -> quantity }}</td>
                                <td><span class="badge bg-success">{{ $product -> status }}</span></td>
                                <td>{{ $product -> price }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>
                                    @if(isset($product->sizes) && count($product->sizes) > 0)
                                    @foreach($product->sizes as $size)
                                    {{ $size->name }} - {{ number_format($size->price) }}₫<br>
                                    @endforeach
                                    @else
                                    <span>Chưa có size</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" title="Xóa vĩnh viễn">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                 <form action="{{ route('products.restore', ['id' => $product->id]) }}" 
                                                method="POST" 
                                                style="display:inline-block;" 
                                                onsubmit="return confirm('Bạn có muốn khôi phục sản phẩm này không ?')">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-success btn-sm" type="submit" title="Khôi phục">
                                                    <i class="fas fa-undo"></i>
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
<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="src/jquery.table2excel.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('admin/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable();
    //Thời Gian
</script>
<script>
    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function() {
        jQuery(".trash").click(function() {
            swal({
                    title: "Cảnh báo",
                    text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
                    buttons: ["Hủy bỏ", "Đồng ý"],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Đã xóa thành công.!", {

                        });
                    }
                });
        });
    });
    oTable = $(document).ready(function() {
        // Khởi tạo DataTable
        var table = $('#sampleTable').DataTable({
            // Tùy chọn nếu muốn
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true
        });

        // Chức năng chọn/bỏ chọn tất cả checkbox
        $('#all').on('click', function() {
            var checked = $(this).is(':checked');
            $('#sampleTable tbody input[type="checkbox"]').prop('checked', checked);
        });
    });
    $(document).ready(function() {
        // Khởi tạo DataTable
        var table = $('#sampleTable').DataTable({
            // Tùy chọn nếu muốn
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true
        });

        // Chức năng chọn/bỏ chọn tất cả checkbox
        $('#all').on('click', function() {
            var checked = $(this).is(':checked');
            $('#sampleTable tbody input[type="checkbox"]').prop('checked', checked);
        });
    });
</script>
@endsection