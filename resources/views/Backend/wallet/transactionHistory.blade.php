@extends('layouts.Backend.base')
@section('title', 'Ví đối tác')
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
                        <span style="float: left"><a href="{{ route('wallet.index') }}">Ví đối tác</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.transactionhistory', $wallet_id) }}">Lịch Sử Giao Dịch</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-12">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-tools">
                                            <span style="font-size: 18px;font-weight: 700">Lịch sử giao dịch ví</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover text-nowrap" id="product_table" >
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã giao dịch</th>
                                        <th>Tiền</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($histories as $history)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $history->trading_code }}</td>
                                            <td>{{ $history->send_monney }}&#160;VNĐ</td>
                                            <td>{{ $history->note }}</td>
                                            <td>
                                                @if($history->status == "pending")
                                                    <span class="badge badge-warning">Đang chờ xử lý</span>
                                                @elseif($history->status == "refuse")
                                                    <span class="badge badge-danger">Từ chối</span>
                                                @else
                                                    <span class="badge badge-primary">Đã duyệt</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                        <a href="{{ route('wallet.index') }}" class="btn btn-primary">Về Ví</a>
                                    </div>
                                </div>
                            </div>
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




