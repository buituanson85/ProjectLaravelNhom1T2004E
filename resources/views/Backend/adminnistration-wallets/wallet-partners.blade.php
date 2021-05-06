@extends('layouts.Backend.base')
@section('title', 'Giao dịch rút tiền')
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
                        <span style="float: left"><a href="{{ route('dashboards.walletpartners') }}">Giao dịch rút tiền</a></span>
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
                                    <div class="col-md-4">
                                        <div class="card-tools">
                                            <span style="font-size: 18px;font-weight: 700">Danh sách giao dịch:</span>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="{{ route('dashboards.walletpartners') }}" class="form-horizontal">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <input type="text" name="name" id="name" value="" placeholder="Số tài khoản" class="form-control input-md">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mã giao dịch</th>
                                        <th>Tiền</th>
                                        <th>Số Tài Khoản</th>
                                        <th>Tên Đối Tác</th>
                                        <th>Nội dung</th>
                                        <th>Trạng Thái</th>
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
                                            <td>- {{ $history->send_monney }} VNĐ</td>
                                            <td>{{ $history->wallet->account }}</td>
                                            <td>{{ $history->wallet->user->name }}</td>
                                            <td>{{ $history->note }}</td>
                                            <td>
                                                <div id="paypal-button_{{ $history->id }}" onclick="thanhtoan()"></div>
                                                <form id="pay-form_{{ $history->id }}"  action="{{ route('dashboards.paymoneywaiting', $history->id ) }}" method="get">
                                                    @csrf
                                                </form>
{{--                                                <a href="" class="badge badge-warning">{{ $history->status }}</a>--}}
                                            </td>
                                            <td>{{ $history->created_at }}</td>
                                        </tr>
                                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>

                                        <input type="hidden" id="vn_to_usd_{{ $history->id }}" value="{{ round($history->send_monney/32000,2) }}">
                                        <script>
                                            var usd = document.getElementById("vn_to_usd_{{ $history->id }}").value;
                                            console.log(usd)
                                            paypal.Button.render({
                                                // Configure environment
                                                env: 'sandbox',
                                                client: {
                                                    sandbox: 'AZ_tkdrgd1wA4aBOlzRDcuPS8zPW4wBkzSM1ATj6u3s5kxXQqwqhiKOc2EfKy2fwB3_BdAexC6IE--Lj',
                                                    production: 'demo_production_client_id'
                                                },
                                                // Customize button (optional)
                                                locale: 'en_US',
                                                style: {
                                                    size: 'small',
                                                    color: 'gold',
                                                    shape: 'pill',
                                                },

                                                // Enable Pay Now checkout flow (optional)
                                                commit: true,

                                                // Set up a payment
                                                payment: function(data, actions) {
                                                    return actions.payment.create({
                                                        transactions: [{
                                                            amount: {
                                                                total: `${usd}`,
                                                                currency: 'USD'
                                                            }
                                                        }]
                                                    });
                                                },
                                                // Execute the payment
                                                onAuthorize: function(data, actions) {
                                                    return actions.payment.execute().then(function() {
                                                        // Show a confirmation message to the buyer
                                                        window.alert('Xác nhận thanh toán thành công!');
                                                        thanhtoan();
                                                    });
                                                }
                                            }, '#paypal-button_{{ $history->id }}');
                                            function thanhtoan() {
                                                event.preventDefault();
                                                document.getElementById('pay-form_{{ $history->id }}').submit();
                                            }
                                        </script>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $histories->render('pagination::bootstrap-4') !!}
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






