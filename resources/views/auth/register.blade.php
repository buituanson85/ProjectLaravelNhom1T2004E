@extends('layouts.Frontend.base')
@section('title', 'Login')
@section('content')
    <!--Navigation section-->
    <section>
        <div class="container-fluid" style="background-image: url('{{ asset('Frontend/assets/images/about.b5988b9a.jpg') }}')">
            <div class="row pt-5 pb-5 text-center">
                <div class="col-md-12">
                    <span style="color: #ffffff;font-size: 36px;">Đăng ký thành viên</span>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #f2f4f7">
        <div class="container">
            <div class="row" style="padding: 30px 0">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center pt-2">
                                <p class="text-center" style="font-size: 20px;color: lightseagreen"><span>ĐĂNG KÝ THÀNH VIÊN</span></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert-danger"></div>
                                    <form method="POST" action="{{ route('registers.store') }}" style="padding-left: 0!important;">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Họ Và Tên</label>
                                            <div class="col-md-8">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Vui lòng nhập họ và tên...">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Địa Chỉ Email</label>
                                            <div class="col-md-8">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Vui lòng nhập địa chỉ email...">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">Số Điện Thoại</label>
                                            <div class="col-md-8">
                                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Vui lòng nhập số điện thoại...">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-md-4 col-form-label text-md-right">Địa Chỉ</label>
                                            <div class="col-md-8">
                                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Vui lòng nhập địa chỉ...">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật Khẩu</label>
                                            <div class="col-md-8">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="************">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Nhập Lại Mật Khẩu</label>
                                            <div class="col-md-8">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="************">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button style="background-color: lightseagreen" type="submit" name="register" class="btn btn-primary">
                                                    Đăng ký
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pl-3">
                            <div class="row" style="padding: 20px 0">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <a style="background-color: lightseagreen" class="btn btn-info shadow-sm font-weight-bold" href="/">Về Trang chủ</a>
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
                                - Chungxe là một Startup tiên phong trong việc phát triển nền tảng trực tuyến cho thuê
                                và chia sẻ xe tự lái ở Việt Nam.
                            </p>
                            <p class="pl-2" style="font-weight: 500">
                                - Chungxe cho phép khách hàng có nhu cầu thuê xe tự lái (ô tô, xe máy) có thể kết nối
                                với các đơn vị cho thuê xe cũng như cá nhân có xe nhàn rỗi trên khắp cả nước thông qua
                                website hoặc ứng dụng di động. Khách hàng có thể tìm kiếm, so sánh và thuê xe một cách
                                dễ dàng, nhanh chóng.
                            </p>
                            <p class="pl-2" style="font-weight: 500">
                                - Chungxe được ra đời với sứ mệnh mang đến nền tảng công nghệ hiện đại cho phép việc thuê
                                và chia sẻ xe một cách Nhanh chóng, An toàn và Tiết kiệm. Chungxe hướng tới một cộng đồng
                                cho thuê và chia sẻ phương tiện đi lại một cách văn minh và thân thiện với môi trường.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

