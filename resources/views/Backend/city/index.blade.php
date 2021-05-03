@extends('layouts.Backend.base')
@section('title', 'Thành Phố')
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
                        <span style="float: left"><a href="{{ route('city.index') }}">Thành Phố</a></span>
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
                                    <h3 class="card-title">Danh sách thành phố</h3>

                                    <div class="card-tools">
                                        <a href="{{ route('city.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Thêm thành phố mới</a>
                                    </div>
                                </div>
                                <div class="col-md-8 mt-4">

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @include('partials.alert')
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên</th>
                                    <th>Slug</th>
                                    <th>Trạng thái</th>
                                    <th>Create at</th>
                                    <th>Update at</th>
                                    <th scope="col">Cập nhật</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($all_city as $city)
                                    <tr>
                                        <td>{{$city->id}}</td>
                                        <td>{{$city->name}}</td>

                                        <td>{{$city->slug}}</td>
                                        <td>{{$city->status}}</td>

                                        <td>{{$city->created_at}}</td>
                                        <td>{{$city->updated_at}}</td>
                                        <td><a class="btn btn-sm btn-warning"
                                               href="{{route('city.edit',$city->id)}}">Cập nhật</a></td>
                                        <td>

                                            <a class="btn btn-sm btn-danger"
                                               onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                                               href="{{route('city.delete',$city->id)}}">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

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
            jQuery('#example').DataTable();
        });
    </script>
@endsection



