@extends('layouts.Backend.base')
@section('title', 'Giao dịch thẻ')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.moneywaiting') }}">Giao Dịch Thẻ</a></span>
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
                                    <div class="col-md-6">
                                        <div class="card-tools">
                                            <span style="font-size: 16px;font-weight: 600">Lịch sử giao dịch thẻ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table table-hover text-nowrap" id="product_table" >
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tài Khoản</th>
                                        <th>Tiền thẻ</th>
                                        <th>Tiền</th>
                                        <th>Tên Đối Tác</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày đăng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($wallets as $wallet)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $wallet->account }}</td>
                                            <td>+ {{ $wallet->monney_confirm }} VNĐ</td>
                                            <td>{{ $wallet->monney }}</td>
                                            <td>{{ $wallet->user->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboards.sendmoneywaiting', $wallet->id) }}" class="badge badge-warning">Xác nhận</a>
                                            </td>
                                            <td>{{ $wallet->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-1 pb-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Khi khách hàng thanh toán qua thẻ tiền sẽ gửi về tiền đang chờ duyệt trong ví.
                        </div>
                        <div class="col-md-12 pt-3">
                            - Nhấn nút <span class="badge badge-warning">Xác nhận</span> để tự động chuyển tiền xuống ví dưới tài khoản ví của chủ phương tiện.
                            - Nếu số tiền chuyển lớn hơn số tiền duy trì tài khoản,mở khóa tất cả các phương tiện của chủ xe do trước đó bị khóa vì tiền trong ví không đủ.
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







