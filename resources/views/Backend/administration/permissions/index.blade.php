@extends('layouts.Backend.base')
@section('title', 'Permissions')
@section('content')

    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('permissions.index') }}">Danh Sách Permissions</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5 m-0">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">Danh sách Permissions</h3>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-5">
                                    <a class="btn btn-primary pull-right" href="{{ route('permissions.create') }}"><i class="fas fa-plus-circle"></i>&#160;Thêm permission</a></span>
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
                                    <th>URL</th>
                                    <th>Thư mục</th>
                                    <th>Date Posted</th>
                                    <th>Cập nhật</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($permissions as $permission)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td style="font-weight: 600">{{ $permission->name }}</td>
                                        <td>{{ $permission->url }}</td>
                                        <td>
                                            @if($permission->parent == 0)
                                                <span class="badge badge-danger">Cha</span>
                                            @else
                                                <span class="badge badge-success">Con</span>
                                            @endif
                                        </td>
                                        <td>{{ $permission->created_at }}</td>
                                        <td>
                                            <a href="{{ route('permissions.edit', $permission->id) }}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Cập nhật</span></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>Không có dữ liệu</tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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



