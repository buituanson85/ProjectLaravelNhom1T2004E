@extends('layouts.Frontend.base')
@section('title', 'Đổi mật khẩu')
@section('content')
    <div class="container-fluid banner-product">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-4">
                        <div class="info-left"  style="background-color: white">
                            <div class="info-left-general ">
                                <a href="{{ route('pages.lichsuthuexe') }}"><i class="fas fa-folder-open"></i> Lịch sử thuê xe</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('pages.customerprofiles') }}"><i class="fas fa-user-alt"></i> Thông tin cá nhân</a>
                            </div>
                            <div class="info-left-general-active ">
                                <a href="{{ route('pages.doimatkhau') }}"><i class="fas fa-cog"></i> Đổi mật khẩu</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>                            </div>
                        </div>
                    </div>
                    <div class="col-8" >
                        <div class="info-right" style="height: auto">
                            <p style="text-align: center;color: cadetblue;font-weight: 600;font-size: 40px;padding-top: 30px">Đổi mật khẩu</p>
                            <div class="container info-right-password" style="margin-top: -25px">
                                @include('partials.alert')
                                <form method="post" action="{{ route('doimatkhaustore') }}">
                                @csrf
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label" style="font-weight: 600">Mật khẩu cũ</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu cũ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpassword" class="col-sm-4 col-form-label" style="font-weight: 600">Mật khẩu mới</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Nhập mật khẩu mới">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpassword_confirmation" class="col-sm-4 col-form-label" style="font-weight: 600">Nhập lại mật khẩu</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="newpassword_confirmation" name="newpassword_confirmation" placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                    <button  type="submit" class="form_submit_info" style="background-color: cadetblue; padding: 10px;border-radius: 5px;color: white;font-weight: 600; margin-left: 250px; "><i class="fas fa-key" style="padding-right: 5px"></i>   Đổi mật khẩu</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
