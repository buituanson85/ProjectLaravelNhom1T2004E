@extends('layouts.Backend.base')
@section('title', 'Cập nhật loại danh mục')
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
                        <span style="float: left"><a href="{{ route('cate.index') }}">Danh Sách Loại Danh Mục</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{route('cate.edit',$cate->id)}}">Cập Nhật Loại Danh Mục</a></span>
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
                                    <h3 class="card-title">Cập nhật loại danh mục</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('cate.index') }}" class="btn btn-danger pull-right"><i class="fas fa-shield-alt"></i> Danh sách danh mục</a>
                                </div>
                            </div>
                        </div>
                        @include('partials.alert')
                        <div class="alert-danger"></div>
                        <form method="post" action="{{route('cate.update',$cate->id)}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên loại danh mục</label>
                                    <input type="text" name="name" onkeyup="ChangeToSlug()"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{$cate->name}}" placeholder="Category Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Danh mục Slug</label>
                                    <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $cate->slug}}" placeholder="Category Slug">
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">


                                        <option value="instock" {{$cate->status == 'instock' ? 'selected' : ''}}>InStock</option>
                                        <option value="outofstock" {{$cate->status == 'outofstock' ? 'selected' : ''}}>Out of Stock</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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


