@extends('layouts.Backend.base')
@section('title', 'Roles')
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
                        <span style="float: left"><a href="{{ route('roles.index') }}">Roles</a></span>
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
                                    <h3 class="card-title">Danh sách Roles</h3>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-5">
                                    <a class="btn btn-primary pull-right" href="{{ route('roles.create') }}"><i class="fas fa-plus-circle"></i>&#160;Thêm role</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap" id="product_table" >
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên role</th>
                                    <th>Tiêu đề</th>
                                    <th>Date Posted</th>
                                    <th>Cập nhật</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($roles as $role )
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td style="font-weight: 600">{{ $role->name }}</td>
                                        <td>{{ $role->title }}</td>
                                        <td><span class="tag tag-success">{{ $role->created_at }}</span></td>
                                        <td>
                                            @if($role->name === "Admin")

                                            @else
                                                <a href="{{ route('roles.edit', $role->id) }}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Cập nhật</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($role->name === "Admin")

                                            @else
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td><i class="fas fa-folder-open"></i> Không có dữ liệu</td>
                                    </tr>
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


