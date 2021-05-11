@extends('layouts.Backend.base')
@section('title', 'Ví Đối tác')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('wallet.index') }}">Ví Đối Tác</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-4 offset-md-4">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-tools">
                                            <span style="font-size: 16px;font-weight: 600">Tài khoản:</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-left">
                                        <span>{{ $wallet->user->name }}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('dashboards.transactionhistory', $wallet->id) }}" method="get">
                                            @csrf
                                        <button class="badge badge-warning">Lịch sử</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row pt-4 text-center">
                                    <div class="col-md-12">
                                        <span style="font-size: 16px;font-weight: 500">SỐ DƯ TẠM TÍNH(*)</span>
                                    </div>
                                </div>

                                <div class="row pt-2 pb-4 text-center">
                                    <div class="col-md-12">
                                        <span style="font-size: 16px;font-weight: 700">{{ number_format($wallet->monney) }} VNĐ</span>
                                    </div>
                                </div>

                                <div class="row pt-2 pb-4 text-center">
                                    <div class="col-md-12">
                                        <form action="{{ route('dashboards.tutorialmonney', $wallet->id) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">HƯỚNG DẪN NẠP TIỀN</button>
                                        </form>
                                    </div>
                                </div>
                                <hr class="pt-2">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <div class="row pl-3 pr-3">
                                            <div class="col-md-6">
                                                <span style="font-size: 16px;font-weight: 300">Tiền đang chờ duyệt:</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                {{ number_format($wallet->monney_confirm) }} VNĐ
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <div class="row pl-3  pr-3">
                                            <div class="col-md-6">
                                                <span style="font-size: 16px;font-weight: 300">Có thể rút:</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                {{ number_format($wallet->monney- $duytri) }} VNĐ
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-3" style="padding-bottom: 100px">
                                    <div class="col-md-12">
                                        <div class="row pl-3  pr-3">
                                            <div class="col-md-6">
                                                <span style="font-size: 16px;font-weight: 300">Tài khoản nạp tiền:</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                {{ $wallet->account }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span style="font-size: 12px; font-weight: 250">* Không thể rút {{ number_format($duytri) }} VNĐ - Phí duy trì tài khoản</span>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <form action="{{ route('dashboards.withdrawal') }}" method="get">
                                        @csrf
                                        <button type="submit" style="width: 100%" class="btn btn-warning">Rút Tiền</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 offset-1 pb-5 pt-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Tiền duy trì tài khoản: 500.000 VNĐ/Ô Tô và 100.000 VNĐ/Xe Máy.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Tiền đang chờ duyệt:<br>
                            &#160;&#160;&#160;&#160;+ Khách hàng thanh toán thẻ(Online) tiền sẽ đổ về "Tiền đang chờ duyệt" trong ví chủ chủ phương tiện<br>
                            &#160;&#160;&#160;&#160;+ Admin sau khi kiểm tra giao dịch hợp lễ sẽ xác nhận thông qua giao dịch thẻ.<br>
                            &#160;&#160;&#160;&#160;+ Admin đã xác nhận giao dịch thẻ tiền sẽ cộng vào số dư trong ví chủ phương tiện.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Nạp tiền:<br>
                            &#160;&#160;&#160;&#160;+ Chủ phương tiện nạp tiền vào tài khoản ví thông qua hai cách trong hướng dẫn nạp tiền.<br>
                            &#160;&#160;&#160;&#160;+ Sau khi nhận thông tin giao dịch từ ngân hàng Amin sẽ xác nhận giao dịch thông qua giao dịch gửi tiền.<br>
                            &#160;&#160;&#160;&#160;+ Admin đã xác nhận giao dịch gửi tiền sẽ cộng vào số dư trong ví chủ phương tiện.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Rút tiền:<br>
                            &#160;&#160;&#160;&#160;+ Chủ phương tiện rút tiền từ tài khoản ví số tiền rút trừ trực tiếp luôn từ số tiền trong tài khoản ví.<br>
                            &#160;&#160;&#160;&#160;+ Sau khi nhận thông tin giao dịch rút tiền Amin kiểm tra giao dịch hợp lệ sẽ chuyển khoản cho chủ phương tiện qua paypal.<br>
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>


    </div><!-- /#right-panel -->

@endsection




