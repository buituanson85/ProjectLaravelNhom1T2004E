@extends('layouts.Backend.base')

@section('title', 'Danh sách loại xe thuê:')
{{--@extends('layouts.Backend.function')--}}
@section('content')



    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="">
        <!-- Content Header (Page header) -->
    @include('layouts.Backend.header')


    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">List Category</h3>


                            <div class="box-tools">
                                <form action="{{route('cate.index')}}" type="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="table_search" class="form-control input-sm pull-right"
                                               style="width: 150px;" placeholder="Search"/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">

                            @include('partials.alert')
                            <table id="myTable" class="table table-hover">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Creat at</th>
                                    <th scope="col">Update at</th>
                                    <th scope="col"><a href="{{route('cate.create')}}" class="label label-primary">Add
                                            new</a></th>
                                    <th scope="col"><a href="{{route('cate.index')}}" class="label label-default">View
                                            all</a></th>

                                @foreach($list_category as $key => $cate)
                                    <tr>

                                        <td>{{$cate->id}}</td>
                                        <td>{{$cate->name}}</td>
                                        <td>{{$cate->slug}}</td>
                                        <td ><p class="label label-primary">{{$cate->status}}</p></td>
                                        <td>{{$cate->created_at}}</td>
                                        <td>{{$cate->updated_at}}</td>
                                        <td>
                                            <a class="label label-primary"
                                               href="{{route('cate.edit',$cate->id)}}">Edit</a>
                                            <a class="label label-danger"
                                               onclick="return confirm('Bạn có chắc chắn sẽ xóa?')"
                                               href="{{route('cate.delete',$cate->id)}}">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

            </div>

        </section><!-- /.content -->
@endsection
