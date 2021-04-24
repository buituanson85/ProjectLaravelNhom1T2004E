@extends('layouts.Frontend.base')
@section('title', 'Login')
@section('content')
    <!--Navigation section-->
    <section>
        <div class="container-fluid" style="background-image: url('{{ asset('Frontend/assets/images/about.b5988b9a.jpg') }}')">
            <div class="row pt-5 pb-5 text-center">
                <div class="col-md-12">
                    <span style="color: #ffffff;font-size: 36px;">Đăng nhập</span>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #f2f4f7">
        <div class="container">
            <div class="row pl-5" style="padding: 30px 0">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <p class="text-center" style="font-size: 20px; color: lightseagreen"><span>Đăng Nhập</span></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row justify-content-center custom-margin">
                                    <div class="col-md-12">
                                        <form name="frm-login" method="post" action="{{route('login')}}">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">Địa Chỉ Email:</label>

                                                <div class="col-md-8">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">Mật Khẩu:</label>

                                                <div class="col-md-8">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            Nhớ mật khẩu
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button style="background-color: lightseagreen"n type="submit" class="btn btn-primary">
                                                        Đăng Nhập
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pl-3">
                            <div class="row" style="padding: 20px 0">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a style="background-color: lightseagreen" class="btn btn-info shadow-sm font-weight-bold" href="/">Về Trang Chủ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row pl-2">
                        <div class="col-md-12">
                            <img width="100%" src="{{ asset('Frontend/assets/images/pexels-photo-862734.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="row pl-2 pt-3">
                        <div class="col-md-12">
                            <p class="pl-2" style="font-weight: 500">
                                - Công ty chúng tôi lắng nghe và hiểu được nhu cầu của khách hàng để từ đó phục vụ khách
                                hàng tốt hơn.
                            </p>
                            <p class="pl-2" style="font-weight: 500">
                                - Xây dựng một chiến lược kinh doanh định hướng đến khách hàng trên cơ sở tôn trọng
                                khách hàng.
                            </p>
                            <p class="pl-2" style="font-weight: 500">
                                - Coi khách hàng là bạn đồng hành trong quá trình phát triển của công ty, là
                                ưu tiên hàng đầu trong mọi hoạt động.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
