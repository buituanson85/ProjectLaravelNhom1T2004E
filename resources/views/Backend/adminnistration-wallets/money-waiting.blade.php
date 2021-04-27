@extends('layouts.Backend.base')
@section('title', 'Giao dịch thẻ')
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
                        <span style="float: left"><a href="{{ route('dashboards.sendwallet') }}">Giao dịch thẻ</a></span>
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
                                            <span style="font-size: 16px;font-weight: 600">Lịch sử giao dịch thẻ:</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tài Khoản</th>
                                        <th>Tiền thẻ</th>
                                        <th>Tiền</th>
                                        <th>Tên Đối Tác</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày đăng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $wallets->perPage()*($wallets->currentPage() - 1);
                                    @endphp
                                    @foreach($wallets as $wallet)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td>{{ $wallet->account }}</td>
                                            <td>+ {{ $wallet->monney_confirm }} VNĐ</td>
                                            <td>{{ $wallet->monney }}</td>
                                            <td>{{ $wallet->user->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboards.sendmoneywaiting', $wallet->id) }}" class="badge badge-warning">pending</a>
                                            </td>
                                            <td>{{ $wallet->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $wallets->render('pagination::bootstrap-4') !!}
                            </div>
                            <div class="card-footer">
                                <div class="row pt-3 pl-3">
                                    <div class="col-md-12">
                                        {{--                                        <a href="{{ route('dashboards.walletpartners') }}" class="btn btn-primary">Về Ví</a>--}}
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








