@extends('layouts.Backend.base')
@section('title', 'Thêm permissions vào role')
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
                        <span style="float: left"><a href="{{ route('roles-permissions.index') }}">Role Theo Permissions</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('roles-permissions.show',$role->id) }}">Thêm Permissions Vào Role</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Thêm permission</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('roles-permissions.index') }}" class="btn btn-danger pull-right"><i class="fas fa-shield-alt"></i> Danh sách role với permissions</a>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('roles-permissions.store') }}">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $role->id }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên role</label>
                                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}" readonly required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    @foreach ($permissions as $permission)

                                        <div class="checkbox">
                                            <label>
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                            <input
                                                @foreach($role->permissions as $key)
                                                @if($key->name == $permission->name)
                                                checked="checked"
                                                @else

                                                @endif
                                                @endforeach
                                                type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                            <br>
                                        </div>

                                    @endforeach
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Thêm permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection










