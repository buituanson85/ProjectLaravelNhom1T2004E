@extends('layouts.Backend.base')
@section('title', 'Cập nhật permissions')
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
                        <span style="float: left"><a href="{{ route('permissions.index') }}">Danh Sách Permissions</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('permissions.edit', $permission->id) }}">Cập Nhật Permission</a></span>
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
                                    <h3 class="card-title">Cập nhật permission</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('permissions.index') }}" class="btn btn-danger pull-right"><i class="fas fa-shield-alt"></i> Danh sách Permission</a>
                                </div>
                            </div>
                        </div>
                        <div class="alert-danger"></div>
                        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên permission</label>
                                    <input type="text" onkeyup="ChangeToSlug()" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $permission->name }}" placeholder="Nhập tên permission">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Permission Slug</label>
                                    <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $permission->slug }}" placeholder="Permission Slug">
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="url">Permission URL</label>
                                    <input type="text" name="url"  id="url" class="form-control @error('url') is-invalid @enderror" value="{{ $permission->url }}" placeholder="Permission url">
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="icon">Permission Icon</label>
                                    <input type="text" name="icon"  id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ $permission->icon }}" placeholder="Permission Icon">
                                    @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Permission thư mục</label>
                                    <select class="form-control" id="parent" name="parent">
                                        <option value="0">=== Permission Parent ===</option>

                                        @foreach($permissions as $permissionp)
                                            @if($permissionp->parent == 0)
                                                <option
                                                    @if($permissionp->id === $permission->parent)
                                                    selected
                                                    @else

                                                    @endif
                                                    value="{{ $permissionp->id }}">{{ $permissionp->name }}
                                                </option>
                                            @else
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection



