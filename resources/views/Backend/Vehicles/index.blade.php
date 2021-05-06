@extends('layouts.Backend.base')
@section('title', 'Đối tác')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Danh Sách Đối Tác</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-12">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="card-title" style="font-size: 20px;font-weight: 700">Danh sách đối tác</h3>
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
                                        <th>utype</th>
                                        <th>Trạng thái</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Chi tiết</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <span class="badge badge-primary">{{ $user->utype }}</span>
                                            </td>
                                            <td>
                                                @if($user->status == 'instock')
                                                    <a href="{{ route('dashboards.doitaclock', $user->id) }}" class="badge badge-warning">Đang hoạt động</a>
                                                @else
                                                    <a href="{{ route('dashboards.doitacunlock', $user->id) }}" class="badge badge-danger">Tạm khóa</a>
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <a href="/dashboards/table-products/{{ $user->id }}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
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
                <div class="col-md-10 offset-1 pb-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Trạng Thái: Sử dụng khi Admin muốn bật(<span class="badge badge-warning">Đang hoạt động</span>) hoặc ẩn(<span class="badge badge-danger">tạm khóa</span>) tài khoản chủ phương tiện.
                        </div>
                        <div class="col-md-12 pt-3">
                            - Nút <span class="btn btn-danger">Delete</span>: Sử dụng khi Đối tác chấm dứt hợp đồng hợp tác thanh lý tài khoảng.
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




