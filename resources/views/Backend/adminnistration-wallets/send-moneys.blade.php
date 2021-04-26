@extends('layouts.Backend.base')
@section('title', 'Nạp Tiền')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Nạp tiền</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-6 offset-md-3">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-tools">
                                            <span style="font-size: 16px;font-weight: 600">Nạp Tiền:</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-left">

                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                            </div>
                            @include('partials.alert')
                            <form action="{{ route('dashboards.sendmoney') }}" method="post">
                                @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span>Nhập số tiền cần nạp:</span>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control" type="text" name="monney">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span>Nhập số điện thoại:</span>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control" type="text" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span>Nhập email:</span>
                                        </div>
                                        <div class="col-md-5">
                                            <input class="form-control" type="text" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <button type="submit" style="width: 100%" class="btn btn-warning">Gửi Tiền</button>
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





