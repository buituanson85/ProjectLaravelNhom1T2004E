@extends('layouts.Backend.base')
@section('title', 'Danh sách đăng ký đối tác')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left">Dashboard</span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('pages.confirmpartner') }}">Danh Sách Đăng Ký Đối Tác</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="card-title" style="font-size: 20px;font-weight: 700">Danh sách đăng ký đối tác</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table table-hover text-nowrap" id="product_table" >
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Địa Chỉ</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Action</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($partners as $partner)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $partner->name }}</td>
                                            <td>{{ $partner->email }}</td>
                                            <td>{{ $partner->address }}</td>
                                            <td>{{ $partner->phone }}</td>
                                            <td>
                                                @if($partner->status == "outofstock")
                                                    <a href="{{ route('dashboards.confirmlock', $partner->id) }}" class="badge badge-warning">Create</a>
                                                @else
                                                    <span class="badge badge-success">Success</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('dashboards.deleteconfirmpartner') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="partner_id" id="partner_id" value="{{ $partner->id }}">
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>
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
                <div class="col-md-10 offset-1 pb-5 pt-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Đăng ký làm đối tác tại webbis: <a href="http://localhost:8000/pages/register-partners">chungxe.vn</a>.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Đối tác điền đẩy đủ thông tin hệ thống sẽ gửi mail ghi nhận và thông báo chờ xác nhận và sẽ liên hệ để làm thủ tục ký kết hợp đồng hợp tác giữa hai bên.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - sau khi đạt thỏa thuận và ký kết hợp đồng, Hệ thống tự tạo tài khoản đăng nhập(Bấm vào nút <span class="badge badge-warning">create</span>)và Tài khoản ví(khách hàng phải đóng 500.000 VNĐ phí duy trì tài khoản) cho đối tác dựa vào thông tin khách hàng đã đăng ký,account đăng nhập sẽ là email đối tác đăng ký và mật khẩu sẽ gửi vào email đó
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Sau khi tiến hành xác nhận email và cập nhật hồ sơ cá nhân đối tác có thể đăng ký phương tiện cho thuê trên hệ thống.
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>

    </div><!-- /#right-panel -->

@endsection
@section('addjs')
    <script type="text/javascript">
        jQuery(document).ready( function () {
            jQuery('#product_table').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi 1 trang",
                    "zeroRecords": "Không có bản ghi - sorry",
                    "info": "Trang số _PAGE_ trên tổng số _PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(Lọc từ _MAX_ bản ghi)",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "search": "Tìm kiếm:",
                }
            });
        } );
        jQuery(document).ready(function () {
            jQuery('.dataTables_filter input[type="search"]').css(
                {'width':'400px','display':'inline-block'}
            );
        });
    </script>
@endsection



