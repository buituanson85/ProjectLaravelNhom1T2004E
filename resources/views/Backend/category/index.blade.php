@extends('layouts.Backend.base')
@section('title', 'Loại Danh Mục')
@section('content')

    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-md-10">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('cate.index') }}">Danh Sách Loại Danh Mục</a></span>
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
                                <div class="col-md-6">
                                    <h3 class="card-title">Danh sách loại danh mục</h3>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-primary pull-right" href="{{ route('cate.create') }}"><i class="fas fa-plus-circle"></i>&#160;Thêm loại danh mục</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap" id="product_table" >
                                <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Creat at</th>
                                    <th scope="col">Update at</th>
                                    <th scope="col">Cập nhật</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse($list_category as $key => $cate)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{$cate->name}}</td>
                                        <td ><p class="label label-primary">{{$cate->status}}</p></td>
                                        <td>{{$cate->created_at}}</td>
                                        <td>{{$cate->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                               href="{{route('cate.edit',$cate->id)}}"><i class="fa fa-edit"></i>&nbsp;Cập nhật</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                                               href="{{route('cate.delete',$cate->id)}}">Xóa</a>
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


