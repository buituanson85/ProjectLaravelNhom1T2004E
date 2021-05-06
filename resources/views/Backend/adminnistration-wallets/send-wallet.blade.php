@extends('layouts.Backend.base')
@section('title', 'Giao dịch gửi tiền')
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
                        <span style="float: left"><a href="{{ route('dashboards.sendwallet') }}">Giao Dịch Gửi Tiền</a></span>
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
                                            <span style="font-size: 20px;font-weight: 700">Lịch sử giao dịch</span>
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
                                        <th>Tiền</th>
                                        <th>Ghi chú</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngân hàng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($bankings as $banking)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $banking->account }}</td>
                                            <td>+ {{ $banking->monney }} VNĐ</td>
                                            <td>{{ $banking->note }}</td>
                                            <td>
                                                @if($banking->account == "00100208980")
                                                    <a href="{{ route('dashboards.sendwallettwo', $banking->id) }}" class="badge badge-warning">{{ $banking->status }}</a>
                                                @else
                                                    <a href="{{ route('dashboards.sendwalletone', $banking->id) }}" class="badge badge-warning">{{ $banking->status }}</a>
                                                @endif

                                            </td>
                                            <td>
                                                @if($banking->bank == "Ngân hàng TMCP Quốc Dân (NCB)")
                                                    NBC
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






