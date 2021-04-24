@extends('layouts.Frontend.base')
@section('title', 'Verification Email')
@section('content')
    <section>
        <div class="container" style="padding: 50px 0">
            <div class="row">
                <div class="col-md-10 offset-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Xác Thực Tài Khoản</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-4 text-sm text-gray-600">
                                <span style="font-size: 16px;">Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết mà chúng tôi vừa gửi qua email cho bạn không? Nếu bạn không nhận được email, chúng tôi sẽ sẵn lòng gửi cho bạn một email khác.</span>
                            </div>
                        </div>
                        <div class="card-footer" style="max-height: 120px!important;">
                            <div class="mb-4 text-sm text-gray-600">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form method="POST" class="form-group" action="{{ route('verification.send') }}">
                                            @csrf

                                            <div>
                                                <button class="form-control btn btn-primary" type="submit">
                                                    {{ __('Resend Verification Email') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <form method="POST" class="form-group" action="{{ route('logout') }}">
                                            @csrf

                                            <button type="submit" class=" text-sm text-gray-600 hover:text-gray-900 btn btn-danger">
                                                <span>Log Out</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


