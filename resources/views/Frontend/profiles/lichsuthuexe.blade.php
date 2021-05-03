@extends('layouts.Frontend.base')
@section('title', 'Lịch sử thuê xe')
@section('content')
    <div class="container-fluid banner-product">
        <div class="container">
            <div class="content" style="height: auto">
                <div class="row">
                    <div class="col-4">
                        <div class="info-left"  style="background-color: white">
                            <div class="info-left-general-active ">
                                <a href="{{ route('pages.lichsuthuexe') }}"><i class="fas fa-folder-open"></i> Lịch sử thuê xe</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('pages.customerprofiles') }}"><i class="fas fa-user-alt"></i> Thông tin cá nhân</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('pages.doimatkhau') }}"><i class="fas fa-cog"></i> Đổi mật khẩu</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 " >
                        <div class="choice_vehicle" style="display: flex;">
                            <div class="choice_vehicle_radio-button" style=" border-radius: 5px;)">
                                <input type="radio" name="vehicle" id="car" checked>
                                <label for="car">
                                    Ô tô
                                </label>
                                <input type="radio" name="vehicle" id="motor" >
                                <label for="motor">
                                    Xe máy
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
