@extends('layouts.Backend.base')
@section('title', 'Thay đổi mật khẩu')
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
                        <span style="float: left"><a href="{{ route('dashboards.getpassword') }}">Đổi mật khẩu</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <section class="content pt-5">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Cập nhật mật khẩu</h4>
                            </div>
                            @include('partials.alert')
                            <div class="card-body">
                                <div>
                                    <div>
                                        <form class="form-horizontal" method="POST" action="{{ route('dashboards.editpassword') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="newpassword">Nhập mật khẩu mới</label>
                                                        <input type="password" name="newpassword"  id="newpassword" class="form-control @error('newpassword') is-invalid @enderror" value="" required placeholder="New Password">
                                                        @error('newpassword')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="newpassword_confirmation">Nhập lại mật khẩu</label>
                                                        <input type="password" name="newpassword_confirmation"  id="newpassword_confirmation" class="form-control @error('newpassword_confirmation') is-invalid @enderror" value="" required placeholder="Confirm Password">
                                                        @error('newpassword_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button">
                                                        <button type="submit" class="btn btn-primary"><i class="fas fa-lock"></i> Cập nhật</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div><!-- /#right-panel -->

@endsection
