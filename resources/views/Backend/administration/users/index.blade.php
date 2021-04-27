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
                        <span style="float: left">Dashboard</span>
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
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card-tools">
                                            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm mới nhân viên</a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <form action="{{ route('users.index') }}" class="form-horizontal">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <input type="text" name="name" id="name" value="" placeholder="Users Name" class="form-control input-md">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>utype</th>
                                        <th style="width: 20px">Email</th>
                                        <th>Role</th>
                                        <th>Chi tiết</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $users->perPage()*($users->currentPage() - 1);
                                    @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td>{{ $user->name }}</td>
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
                                                <a href="{{ route('users.show', $user->id ) }}"><span class="btn btn-sm btn-info"><i class="fa fa-eye"></i>&nbsp;View</span></a>
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
                                {!! $users->render('pagination::bootstrap-4') !!}
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



