@extends('layouts.Backend.base')
@section('title', 'Thêm Role')
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
                        <span style="float: left"><a href="{{ route('roles.index') }}">Danh Sách Roles</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('roles.create') }}">Thêm Role</a></span>
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
                                    <h3 class="card-title">Thêm mới Role</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('roles.index') }}" class="btn btn-danger pull-right"><i class="fas fa-shield-alt"></i> Danh sách roles</a>
                                </div>
                            </div>
                        </div>
                        <div class="alert-danger"></div>
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên role</label>
                                    <input type="text" onkeyup="ChangeToSlug()" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Roles Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Role Slug</label>
                                    <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="Roles Slug">
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Tiêu đề role</label>
                                    <input type="text" name="title"  id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Roles Title">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Thêm role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection




