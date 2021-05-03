@extends('layouts.Backend.base')
@section('title', 'Loại danh mục')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left">Dashboard</span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('city.index') }}">Loại Danh Mục</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">Danh sách loại danh mục</h3>

                                    <div class="card-tools">
                                        <a href="{{ route('cate.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Thêm loại danh mục mới</a>
                                    </div>
                                </div>
                                <div class="col-md-8 mt-4">

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @include('partials.alert')
                            <table id="myTable" class="table table-hover">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Creat at</th>
                                    <th scope="col">Update at</th>
                                    <th scope="col">Cập nhật</th>
                                    <th scope="col">Xóa</th>

                                @foreach($list_category as $key => $cate)
                                    <tr>

                                        <td>{{$cate->id}}</td>
                                        <td>{{$cate->name}}</td>
                                        <td>{{$cate->slug}}</td>
                                        <td ><p class="label label-primary">{{$cate->status}}</p></td>
                                        <td>{{$cate->created_at}}</td>
                                        <td>{{$cate->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                               href="{{route('cate.edit',$cate->id)}}">Cập nhật</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                                               href="{{route('cate.delete',$cate->id)}}">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection

@section('addjs')
    <script>
        jQuery(document).ready(function () {
            jQuery('#myTable').DataTable();
        });
    </script>
@endsection
