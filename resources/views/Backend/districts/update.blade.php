@extends('layouts.Backend.base')
@section('title', 'Cập nhật quận huyện')
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
                        <span style="float: left"><a href="{{ route('district.index') }}">Danh Sách Quận Huyện</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('district.index') }}">Cập Nhật Quận Huyện</a></span>
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
                                    <h3 class="card-title">Cập nhật quận huyện</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('district.index')}}" class="btn btn-danger pull-right"><i class="fas fa-shield-alt"></i> Danh sách quận huyện</a>
                                </div>
                            </div>
                        </div>
                        @include('partials.alert')
                        <div class="alert-danger"></div>
                        <form method="post" action="{{route('district.update',$district->id)}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên quận huyện </label>
                                    <input type="text" name="name" onkeyup="ChangeToSlug()"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{$district->name}}" placeholder="District">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label >Thành phố:</label>
                                    <select class="form-control" name="city" >

                                        @foreach($city as $city1)
                                            <option value="{{$city1->id}} {{$district->city_id == $city1->id ? 'selected' : ''}}">{{$city1->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label >Location</label>
                                    <input type="text" name="location"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $district->location}}" placeholder="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Quận huyện Slug</label>
                                    <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $district->slug}}" placeholder=" Slug">
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="instock" {{$district->status == 'instock' ? 'selected' : ''}}>InStock</option>
                                        <option value="outofstock" {{$district->status == 'outofstock' ? 'selected' : ''}}>Out of Stock</option>
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


