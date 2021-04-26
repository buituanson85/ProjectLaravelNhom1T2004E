@extends('layouts.Backend.base')
@section('title', 'Hướng dẫn nạp tiền')
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
                        <span style="float: left"><a href="{{ route('wallet.index') }}">Hướng dẫn nạp tiền</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-tools">
                                            <span style="font-size: 16px;font-weight: 600">Hướng dẫn nạp tiền:</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <h3>Cách 1: Nạp tiền qua tài khoản đối tác -> <span style="font-size: 16px;font-weight: 700">{{ $wallet->account }}</span>.</h3>
                                    </div>
                                </div>
                                <div class="row pt-3 pb-3">
                                    <div class="col-md-12">
                                        <ul class="pl-3">
                                            <li> - Số tài khoản: <span style="font-size: 16px;font-weight: 700">{{ $wallet->account }}</span></li>
                                            <li> - Chủ tài khoản: <span style="font-size: 16px;font-weight: 700">Công ty cổ phần ChungXe</span></li>
                                            <li> - Ngân Hàng: <span style="font-size: 16px;font-weight: 700">Ngân hàng TMCP Quốc Dân (NCB)</span></li>
                                            <li> - Nội dung nộp tiền: <span style="font-size: 16px;font-weight: 700">['Bỏ trống']</span></li></li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <h3>Cách 2: Nạp tiền qua tài khoản CHUNGXE -> <span style="font-size: 16px;font-weight: 700">00100208980</span>.</h3>
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <ul class="pl-3">
                                            <li> - Số tài khoản: <span style="font-size: 16px;font-weight: 700">00100208980}</span></li>
                                            <li> - Chủ tài khoản: <span style="font-size: 16px;font-weight: 700">Công ty cổ phần ChungXe</span></li>
                                            <li> - Ngân Hàng: <span style="font-size: 16px;font-weight: 700">Ngân hàng TMCP Quốc Dân (NCB)</span></li>
                                            <li> - Nội dung nộp tiền: <span style="font-size: 16px;font-weight: 700">[ Điền số điện thoại,email đăng ký tài khoản chungxe của quý đối tác]</span></li></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <span>*Ví dụ nếu số điện thoại và email quý đối tác là:0906240410,buituanson@gmail.com thì nội dung nộp tiền ghi là:<span style="font-size: 16px;font-weight: 700">0906240410,buituanson@gmail.com</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 style="font-weight: 600">LƯU Ý:</h3>
                                    </div>
                                </div>
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                        <span> - Trong đa số các trường hợp,số tiền sẽ xuất hiện trong ví của quý đối tác trong tối đa 15ph sau khi chuyển tiền thành công.</span>
                                    </div>
                                </div>
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                        <span> - Nếu trong 15 phút mà vẫn chưa thấy số tiền xuất hiện,Quý đối tác vui lòng liên hệ tổng đài để hỗ trợ.</span>
                                    </div>
                                </div>
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                        <a href="{{ route('wallet.index') }}" class="btn btn-primary">Về Ví</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>


    </div><!-- /#right-panel -->

@endsection





