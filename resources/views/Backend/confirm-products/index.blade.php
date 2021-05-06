@extends('layouts.Backend.base')
@section('title', 'Xác nhận đăng ký phương tiện')
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
                        <span style="float: left"><a href="{{ route('dashboards.confirmproduct') }}">Danh Sách Đăng Ký Phương Tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span style="font-size: 16px;font-weight: 700;">DANH SÁCH ĐĂNG KÝ PHƯƠNG TIỆN</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table table-hover text-nowrap" id="product_table" >
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên phương tiện</th>
                                        <th>Trạng thái</th>
                                        <th>Hãng phương tiện</th>
                                        <th>Danh mục</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td><img width="120" src="{{ $product->image }}" alt=""></td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if($product->status == "pending")
                                                    <a class="badge badge-warning">Chờ xác nhận</a>
                                                @endif
                                            </td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboards.showconfirm', $product->id) }}" class="btn btn-sm btn-light"><span ><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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




