@extends('layouts.Backend.base')
@section('title', 'Thêm nhân viên')
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
                        <span style="float: left"><a href="{{ route('users.create') }}">Thêm Nhân Viên</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Thêm Mới Nhân Viên</h4>
                            <div class="card-tools">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-shield-alt"></i> Danh Nhân Viên</a>
                            </div>
                        </div>
                        <div class="alert-danger"></div>
                        <form class="form-group pt-3" method="POST" action="{{route('users.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10 offset-md-2">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Họ Và Tên:</label>
                                            <div class="col-md-6">
                                                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Địa Chỉ Email:</label>
                                            <div class="col-md-6">
                                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Số Điện Thoại</label>
                                            <div class="col-md-6">
                                                <input type="text" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Enter Phone">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Địa Chỉ</label>
                                            <div class="col-md-6">
                                                <input type="text" name="address"  id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Enter Address">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="birth_day" class="col-md-3 col-form-label pull-right">Ngày/Tháng/Năm Sinh</label>
                                            <div class="col-md-6">
                                                <input id="birth_day" type="date" class="form-control @error('birth_day') is-invalid @enderror" name="birth_day" value="{{ old('birth_day') }}" placeholder="Vui lòng nhập ngày tháng năm sinh...">
                                                @error('birth_day')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Mật Khẩu</label>
                                            <div class="col-md-6">
                                                <input type="password" name="password"  id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Enter Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Nhập Lại Mật Khẩu</label>
                                            <div class="col-md-6">
                                                <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Confirm Password">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="register"><i class="fas fa-save"></i>&nbsp;Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection




