@extends('layouts.Backend.base')
@section('title', 'User')
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
                        <span style="float: left"><a href="{{ route('permissions.create') }}">Create Permission</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Profile User
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-uppercase">User name: {{ $users->name }}</th>
                                    <th scope="col"><img width="100" src="{{ asset('Backend/uploads/users') }}/{{ $users->profile_photo_path }}" alt=""></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $users->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
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
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection
