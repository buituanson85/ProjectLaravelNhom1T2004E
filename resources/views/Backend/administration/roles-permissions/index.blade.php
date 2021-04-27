@extends('layouts.Backend.base')
@section('title', 'Thêm permissions vào role')
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
                        <span style="float: left"><a href="{{ route('roles-permissions.index') }}">Thêm permissions vào role</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách roles</h3>
                            <div class="card-tools">
                                {{--                                <a href="{{ route('addroles.create') }}" class="btn btn-primary"><i class="fas fa-shield-alt"></i> Add Role</a>--}}
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            @include('partials.alert')
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="5%">Role</th>
                                    <th width="55%" >Permission</th>
                                    <th width="20%">Date Posted</th>
                                    <th width="5%">Thêm permissions</th>
                                    <th width="5%">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse ($roles as $role )
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td style="line-height: 40px">
                                            @foreach ($role->permissions as $permission )
                                                <button class="badge badge-warning" role="button"><i class="fas fa-shield-alt"></i> {{ $permission->name }}</button>&nbsp &nbsp
                                            @endforeach
                                        </td>
                                        <td><span class="tag tag-success">{{ $role->created_at }}</span></td>
                                        @if($role->name === "Admin")

                                        @else
                                        <td><a href="{{ route('roles-permissions.show', $role->id) }}"><span class="btn btn-sm btn-info"><i class="fa fa-edit"></i>&nbsp;Thêm permission</span></a></td>
                                        @endif
                                        <td>
                                            @if($role->name === "Admin")

                                            @else
                                            <form action="{{ route('roles-permissions.destroy', $role->id) }}" method="post">
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



