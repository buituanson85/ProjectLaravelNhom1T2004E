@extends('layouts.Backend.base')
@section('title', 'Đối tác')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Ví đối tác</a></span>
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
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mã giao dịch</th>
                                        <th>Tiền</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đăng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $histories->perPage()*($histories->currentPage() - 1);
                                    @endphp
                                    @foreach($histories as $history)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td>{{ $history->trading_code }}</td>
                                            <td>{{ $history->send_monney }}</td>
                                            <td>{{ $history->note }}</td>
                                            <td>
                                                @if($history->status == "pending")
                                                    <span class="badge badge-warning">Đang chờ xử lý</span>
                                                @elseif($history->status == "refuse")
                                                    <span class="badge badge-danger">Từ chối</span>
                                                @else
                                                    <span class="badge badge-primary">Đã duyệt</span>
                                                @endif
                                            </td>
                                            <td>{{ $history->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $histories->render('pagination::bootstrap-4') !!}
                            </div>
                            <div class="card-footer">
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





