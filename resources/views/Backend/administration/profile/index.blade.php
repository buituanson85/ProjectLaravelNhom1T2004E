@extends('layouts.Backend.base')
@section('title', 'Profile')
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
                        <span style="float: left"><a href="{{ route('dashboards.profile') }}">Photofile Usesr</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="alert-danger"></div>
            <form class="form-horizontal" method="POST" action="{{ route('dashboards.updateprofile') }}" enctype="multipart/form-data">
                @csrf
                <section style="padding: 60px 20px;">
                    <div class="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center pb-3">
                                            <div class="image-preview" id="imagePreview">
                                                <img class="image-preview__image img-fluid img-circle profile-user-img" style="width: 200px;" src="{{ auth()->user()->profile_photo_path }}" id="img_thumbnail" alt="">
                                                <span id="store_image" class="image-preview__default-text"></span>
                                            </div>
                                            <input class="input-file pt-5" name="image" id="image" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card">
                                    @include('partials.alert')
                                    <div class="card-header">
                                        <h4>Cập nhật Profile</h4>
                                    </div>
                                    <div class="card-body">
                                        <div>

                                            <div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Tên</label>
                                                            <input type="text" name="name"  id="name" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->name }}" placeholder="Name" readonly>
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Địa chỉ email</label>
                                                            <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" placeholder="E-mail Address" readonly>
                                                            @error('siteemail')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="phone">Số điện thoại</label>
                                                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                                                            @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="phone">Địa chỉ</label>
                                                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address" value="{{ auth()->user()->address }}">
                                                            @error('address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group button">
                                                            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Cập nhật Profile</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>


    </div><!-- /#right-panel -->

<section style="padding: 30px 0;">
    <div class="container-fluid">


    </div>
</section>
@endsection

