@extends('layouts.Backend.base')
@section('title', 'Thêm Permissions')
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
                        <span style="float: left"><a href="{{ route('permissions.create') }}">Thêm Permission</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm mới Permission</h3>
                            <div class="card-tools">
                                <a href="{{ route('permissions.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Danh sách permission</a>
                            </div>
                        </div>
                        @include('partials.alert')
                        <div class="alert-danger"></div>
                        <form method="POST" action="{{ route('permissions.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên Permission</label>
                                    <input type="text" name="name" onkeyup="ChangeToSlug()"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nhập tên permission">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Permission Slug</label>
                                    <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="Permission Slug">
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Permission URL</label>
                                    <input type="text" name="url"  id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}"  placeholder="Permission URL">
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="icon">Permission Icon</label>
                                    <input type="text" name="icon"  id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}"  placeholder="Permission Icon">
                                    @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Permission Thư mục</label>
                                    <select class="form-control" id="parent" name="parent">
                                        <option value="0">=== Permission Parent ===</option>
                                        @foreach($permissions as $permission)
                                            @if($permission->parent == 0)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @else

                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Thêm Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection


