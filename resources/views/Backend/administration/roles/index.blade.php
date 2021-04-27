@extends('layouts.Backend.base')
@section('title', 'Danh sách roles')
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
                        <span style="float: left"><a href="{{ route('roles.index') }}">Danh sách roles</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách roles</h3>
                            <div class="card-tools">
                                <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm mới role</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên role</th>
                                    <th>Slug</th>
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
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->slug }}</td>
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



