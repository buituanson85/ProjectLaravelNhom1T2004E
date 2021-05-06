@extends('layouts.Backend.base')
@section('title', 'Nhân Viên')
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
                        <span style="float: left"><a href="{{ route('users.index') }}">Danh sách nhân viên</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-12">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="card-title" style="font-size: 24px;font-weight: 600">Danh sách nhân viên</h3>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                        <a class="btn btn-primary pull-right" href="{{ route('users.create') }}"><i class="fas fa-plus-circle"></i>&#160;Thêm nhân viên</a></span>
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
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Chi tiết</th>
                                        <th>Sửa</th>
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
                                            <td style="font-weight: 600">{{ $user->name }}</td>
                                            <td>
                                                <span class="badge badge-success">ADM</span>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    <button class="badge badge-secondary" role="button">{{ $role->name }}</button>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id ) }}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;View</span></a>
                                            </td>
                                            <td>
                                                @if(count($user->roles)>0)
                                                    @foreach($user->roles as $role)
                                                        @if($role->name == "Admin")
                                                            @break
                                                        @else
                                                            <a href="{{ route('users.edit', $user->id) }}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Thêm Role</span></a>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($user->roles)>0)
                                                    @foreach($user->roles as $role)
                                                        @if($role->name == "Admin")
                                                            @break
                                                        @else
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                                            </form>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @endif
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

