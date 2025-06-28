@extends('admin.layout')
@section('content')
 <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item active"><a href="#"><b>Quản lý bình luận</b></a></li>
        </ul>
        <div id="clock"></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row element-button">
                <div class="col-sm-2">
                  <a class="btn btn-add btn-sm" href="#" title="Thêm"><i class="fas fa-plus"></i>
                    Tạo mới</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                      class="fas fa-file-upload"></i> Tải từ file</a>
                </div>
  
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                      class="fas fa-print"></i> In dữ liệu</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                      class="fas fa-copy"></i> Sao chép</a>
                </div>
  
                <div class="col-sm-2">
                  <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                      class="fas fa-file-pdf"></i> Xuất PDF</a>
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                      class="fas fa-trash-alt"></i> Xóa tất cả </a>
                </div>
              </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" id="all"></th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Sản phẩm</th>
                                    <th>Nội dung</th>
                                    <th>Điểm đánh giá</th>
                                    <th>Ngày bình luận</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($binhLuans as $binhLuan)
                                <tr>
                                    <td width="10"><input type="checkbox" name="check1" value="{{ $binhLuan['id'] }}"></td>
                                    <td>{{ $binhLuan['ten_nguoi_dung'] }}</td>
                                    <td>{{ $binhLuan['email'] }}</td>
                                    <td>{{ $binhLuan['san_pham'] }}</td>
                                    <td>{{ Str::limit($binhLuan['noi_dung'], 50) }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $binhLuan['diem_danh_gia'])
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        ({{ $binhLuan['diem_danh_gia'] }}/5)
                                    </td>
                                    <td>{{ $binhLuan['ngay_binh_luan'] }}</td>
                                    <td>
                                        @if($binhLuan['trang_thai'] == 'Đã duyệt')
                                            <span class="badge bg-success">{{ $binhLuan['trang_thai'] }}</span>
                                        @elseif($binhLuan['trang_thai'] == 'Chờ duyệt')
                                            <span class="badge bg-warning">{{ $binhLuan['trang_thai'] }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $binhLuan['trang_thai'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.binhluan.show', $binhLuan['id']) }}" class="btn btn-primary btn-sm" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-primary btn-sm trash" type="button" title="Xóa" data-id="{{ $binhLuan['id'] }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" data-id="{{ $binhLuan['id'] }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
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
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function () {
      jQuery(".trash").click(function () {
        var id = $(this).data('id');
        swal({
          title: "Cảnh báo",
          text: "Bạn có chắc chắn là muốn xóa bình luận này?",
          icon: "warning",
          buttons: ["Hủy bỏ", "Đồng ý"],
          dangerMode: true,
        })
          .then((willDelete) => {
            if (willDelete) {
              // Gọi API xóa bình luận
              $.ajax({
                url: '/admin/binhluan/' + id,
                type: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  if(response.success) {
                    swal("Đã xóa bình luận thành công!", {
                      icon: "success",
                    }).then(() => {
                      location.reload();
                    });
                  } else {
                    swal("Lỗi!", response.message, "error");
                  }
                },
                error: function(xhr) {
                  var message = "Có lỗi xảy ra khi xóa bình luận";
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                  }
                  swal("Lỗi!", message, "error");
                }
              });
            }
          });
      });
    });
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function (e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });

    //Thời Gian
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
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
    //In dữ liệu
    var myApp = new function () {
      this.printTable = function () {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }

    //Modal
    $("#show-emp").on("click", function () {
      $("#ModalUP").modal({ backdrop: false, keyboard: false })
    });
  </script>



@endsection
