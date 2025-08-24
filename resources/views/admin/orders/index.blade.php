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

                            <a class="btn btn-add btn-sm" href="{{ route('admin.orders.create') }}" title="Tạo đơn hàng">
                                <i class="fas fa-plus"></i> Tạo đơn hàng mới
                            </a>

                        </div>
                        
                    </div>
                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0"
                        id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox" id="all"></th>
                                <th>ID Đơn hàng </th>
                                <th width="150">Khách hàng</th>
                                <th width="20">Ngày đặt</th>
                                <th width="300">Trạng Thái</th>                                                    
                                <th>Thanh toán</th>
                               
                              <th>Tổng tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td>{{ $order -> id}}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->order_date ?? $order->created_at->format('d/m/Y H:i') }}</td>
                                 @php
                                        $statusText = [
                                            'pending'    => 'Chờ xử lý',
                                            'paid'       => 'Đã thanh toán',
                                            'processing' => 'Chuẩn bị hàng',
                                            'shipping'   => 'Đang giao hàng',
                                            'delivered'  => 'Đã giao',
                                            'completed'  => 'Hoàn thành',
                                            'cancelled'  => 'Đã hủy',
                                        ];
                                    @endphp
                               <td>{{ $statusText[$order->status] ?? $order->status }}</td>
                                <td>{{ $order->payment->method ?? '---' }}</td>                            
                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                                
                               <td width="10"class="d-flex align-items-center gap-2">
    {{-- Nút Chi tiết --}}
    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-eye"></i> Chi tiết
    </a>

    {{-- Nút Xóa --}}
    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
          onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');"
          style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i> Xóa
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

<!--
  MODAL
-->

<!--
  MODAL
-->

<!-- Essential javascripts for application to work-->
>
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

    //EXCEL
    // $(document).ready(function () {
    //   $('#').DataTable({

    //     dom: 'Bfrtip',
    //     "buttons": [
    //       'excel'
    //     ]
    //   });
    // });


    //Thời Gian

    //In dữ liệu
    var myApp = new function() {
        this.printTable = function() {
            var tab = document.getElementById('sampleTable');
            var win = window.open('', '', 'height=700,width=700');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }
    //     //Sao chép dữ liệu
    //     var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    // copyTextareaBtn.addEventListener('click', function(event) {
    //   var copyTextarea = document.querySelector('.js-copytextarea');
    //   copyTextarea.focus();
    //   copyTextarea.select();

    //   try {
    //     var successful = document.execCommand('copy');
    //     var msg = successful ? 'successful' : 'unsuccessful';
    //     console.log('Copying text command was ' + msg);
    //   } catch (err) {
    //     console.log('Oops, unable to copy');
    //   }
    // });


    //Modal
    $("#show-emp").on("click", function() {
        $("#ModalUP").modal({
            backdrop: false,
            keyboard: false
        })
    });
</script>
@endsection