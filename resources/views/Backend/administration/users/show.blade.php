@extends('layouts.Backend.base')
@section('title', 'Nhân viên')
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
                        <span style="float: left"><a href="{{ route('users.index') }}">Danh Sách Nhân Viên</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('users.show', $users->id ) }}">Chi Tiết Nhân Viên</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3 pt-5">
                                    <span style="font-size: 20px;font-weight: 700">Hồ sơ Nhân viên</span>
                                </div>
                                <div class="col-md-9">
                                    <img width="150" class="img-thumbnail pull-right" src="{{ $users->profile_photo_path }} " alt="">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <th scope="col" class="text-uppercase">Tên:</th>
                                            <td>{{ $users->name }}</td>
                                        </div>
                                    </div>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $users->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Số điện thoại</th>
                                    <td>{{ $users->phone }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Role</th>
                                    <td>
                                        @foreach($users->roles as $role)
                                            {{ $role->name }},
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Permission</th>
                                    <td>
                                        @foreach($users->roles as $role)
                                            @foreach ($role->permissions as $permission )
                                                {{ $permission->name }} ,
                                            @endforeach
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Địa chỉ</th>
                                    <td>{{ $users->address }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Created At</th>
                                    <td>{{ $users->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated At</th>
                                    <td>{{ $users->updated_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('users.index') }}" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection
