@extends('admin.layout')
@section('content')


<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách nhân viên</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div class="row element-button">
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="{{ route('posts.create') }}" title="Thêm"><i class="fas fa-plus"></i>
                                Tạo mới bài viết</a>
                        </div>
                        

                        
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                                    class="fas fa-trash-alt"></i> Xóa tất cả </a>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0"
                        id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox" id="all"></th>
                                <th>ID</th>
                                <th width="150">Tiêu đề</th>
                                <th width="20">Hình ảnh</th>
                                <th width="300">Nội dung</th>
                                <th>Ngày tạo</th>
                                <th>loại</th>
                    
                                

                                <th width="100">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $posts)
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td>{{ $posts -> id}}</td>
                                <td>{{ $posts -> title}}</td>
                                <td>
                                    @if ($posts->image)
                                    <img class="img-card-person" src="{{ asset('storage/' . $posts->image) }}" alt="" width="100">
                                    @else
                                    <span>Không có ảnh</span>
                                    @endif
                                </td>
                               <td>{!! $posts->content !!}</td>

                                 <td>{{ \Carbon\Carbon::parse($posts->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $posts->postcategory->name }}</td>
                             
                        
                                <td class="table-td-center">
                                    <a href="{{ route('posts.edit', $posts->id) }}" class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('posts.destroy', $posts->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
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


<!-- Essential javascripts for application to work-->

<script src="js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="src/jquery.table2excel.js"></script>

<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('admin/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable();
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

                    text: "Bạn có chắc chắn là muốn xóa nhân viên này?",
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
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function(e) {
        $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });
    var myApp = new function() {
        this.printTable = function() {
            var tab = document.getElementById('sampleTable');
            var win = window.open('', '', 'height=700,width=700');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }


    //Modal
    $("#show-emp").on("click", function() {
        $("#ModalUP").modal({
            backdrop: false,
            keyboard: false
        })
    });
</script>
@endsection