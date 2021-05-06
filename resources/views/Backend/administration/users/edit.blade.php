@extends('layouts.Backend.base')
    @section('title', 'Cập nhật roles nhân viên')
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
                        <span style="float: left"><a href="{{ route('users.edit', $user->id) }}">Cập nhật roles nhân viên</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Thêm roles nhân viên</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('users.index') }}" class="btn btn-danger pull-right"><i class="fas fa-shield-alt"></i> Danh sách nhân viên</a>
                                </div>
                            </div>
                        </div>
                        <form class="form-group pt-3" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" readonly required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">Roles</label>
                                    <div class="col-md-6">
                                        @foreach ($roles as $role)

                                            <div class="checkbox">
                                                <label>
                                                    {{ ucfirst($role->name) }}
                                                </label>
                                                @if($role->name === "Admin")

                                                @else
                                                    <input type="checkbox"
                                                           @foreach($user->roles as $key)
                                                           @if($key->name == $role->name)
                                                           checked="checked"
                                                           @else

                                                           @endif
                                                           @endforeach
                                                           name="roles[]" value="{{ $role->id }}">
                                                @endif
                                                <br>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection





