@extends('layouts.Backend.base')
@section('title', 'Giao dịch gửi tiền')
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
                        <span style="float: left"><a href="{{ route('dashboards.sendwallet') }}">Giao dịch gửi tiền</a></span>
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
                                            <span style="font-size: 16px;font-weight: 600">Lịch sử giao dịch:</span>
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
                                        <th>Tiền</th>
                                        <th>Ghi chú</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngân hàng</th>
                                        <th>Ngày đăng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $bankings->perPage()*($bankings->currentPage() - 1);
                                    @endphp
                                    @foreach($bankings as $banking)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td>{{ $banking->account }}</td>
                                            <td>+ {{ $banking->monney }} VNĐ</td>
                                            <td>{{ $banking->note }}</td>
                                            <td>
                                                @if($banking->account == "00100208980")
                                                    <a href="{{ route('dashboards.sendwallettwo', $banking->id) }}" class="badge badge-warning">{{ $banking->status }}</a>
                                                @else
                                                    <a href="{{ route('dashboards.sendwalletone', $banking->id) }}" class="badge badge-warning">{{ $banking->status }}</a>
                                                @endif

                                            </td>
                                            <td>{{ $banking->bank }}</td>
                                            <td>{{ $banking->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $bankings->render('pagination::bootstrap-4') !!}
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







