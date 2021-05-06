@extends('layouts.Backend.base')
@section('title', 'Khách hàng')
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
                        <span style="float: left"><a href="{{ route('customers.index') }}">Danh Sách Khách Hàng</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-10 offset-1">
                    <div>
                        <div class="card">
                            <div class="card-header" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="card-title" style="font-size: 20px;font-weight: 700">Danh sách khách hàng</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table table-hover text-nowrap" id="product_table" >
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Tên</th>
                                        <th>utype</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Chi tiết</th>
                                        <th>Delete</th>
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
                                                <span class="badge badge-secondary">{{ $user->utype }}</span>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <a href="{{ route('customers.show', $user->id) }}"><span class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
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



