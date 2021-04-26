@extends('layouts.Backend.base')
@section('title', 'Rút tiền')
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
                        <span style="float: left"><a href="{{  route('wallet.index')  }}">Rút tiền</a></span>
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
                                            <a href="{{ route('wallet.index') }}" class="badge badge-warning" style="font-size: 16px">Về Ví</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('partials.alert')
                            <form action="{{ route('dashboards.withdrawalmonney') }}" method="post">
                                @csrf
                            <div class="card-body">
                                <div class="row pt-4 text-center">
                                    <div class="col-md-12">
                                        <span style="font-size: 16px;font-weight: 500">SỐ TIỀN CÓ THỂ RÚT</span>
                                    </div>
                                </div>

                                <div class="row pt-2 pb-4 text-center">
                                    <div class="col-md-12">
                                        <span style="font-size: 16px;font-weight: 700">{{ number_format($wallet->monney) }} VNĐ</span>
                                    </div>
                                </div>

                                <div class="row pt-2 pb-2">
                                    <div class="col-md-12">
                                        <span style="font-size: 16px;font-weight: 700">Số tiền rút:</span>
                                    </div>
                                </div>
                                <div class="row pt-2 pb-4">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="send_monney" id="send_monney">
                                    </div>
                                </div>

                                <div class="row pt-2 pb-2">
                                    <div class="col-md-12">
                                        <span style="font-size: 16px;font-weight: 700">Số tài khoản:</span>
                                    </div>
                                </div>
                                <div class="row pt-2 pb-4">
                                    <div class="col-md-6">
                                        <input style="border: none" type="text" class="form-control" placeholder="Ngân hàng NBC:" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input style="border: none;font-weight: bold" type="text" class="form-control" value="{{ $wallet->account }}" readonly>
                                    </div>
                                </div>
                                <div class="row pt-2 pb-4">
                                    <div class="col-md-6">
                                        <input style="border: none" type="text" class="form-control" placeholder="Chủ tài khoản:" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input style="border: none;font-weight: bold" type="text" class="form-control" value="{{ $wallet->user->name }}" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span style="font-size: 12px; font-weight: 250">* Không thể rút 50.000 VNĐ - Phí duy trì tài khoản</span>
                                    </div>
                                </div>
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-warning">Rút</button>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>


    </div><!-- /#right-panel -->

@endsection




