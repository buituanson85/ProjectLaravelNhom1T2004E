@extends('layouts.Backend.base')
@section('title', 'Dashboard')
@section('content')
    <style type="text/css">
        p.title_thongke{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('layouts.Backend.header')
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
{{--        Admin + Support--}}
            @foreach($user_id->roles as $role)
            @if($role->name == "Support")
            <div class="content mt-3">
            <div class="row">
                <div class="col-md-12">
                    <p class="title_thongke">THỐNG KÊ ĐỐI TÁC</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div id="donut" style="min-height: 200px;max-height: 200px"></div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-1" style="min-height: 200px;max-height: 200px">
                    <div class="card-header">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="{{ route('pages.confirmpartner') }}">Xác nhận đăng ký đối tác</a>
                                    <a class="dropdown-item" href="{{ route('dashboards.confirmproduct') }}">Xác nhận đăng ký phương tiện</a>
                                </div>
                            </div>
                        </div>
                        <p class="text-light pt-2 text-center">XÁC NHẬN ĐĂNG KÝ</p>
                    </div>
                    <div class="card-body pb-0 text-center">
                        <div class="row">
                            <div class="col-md-6 pt-1 pb-4" style="border-right: 1px solid #ffffff">
                                <span style="font-size: 16px">Đối tác</span>
                                <h4 class="mb-0 pt-3">
                                    <span class="count" style="font-size: 20px">{{ $partners }}</span>
                                </h4>
                            </div>
                            <div class="col-md-6 pt-1 pb-4">
                                <span style="font-size: 16px">Phương tiện</span>
                                <h4 class="mb-0 pt-3">
                                    <span class="count" style="font-size: 20px">{{ $products }}</span>
                                </h4>
                            </div>
                        </div>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-4" style="min-height: 200px;max-height: 200px">
                    <div class="card-header">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="{{ route('dashboards.sendwallet') }}">Giao dịch gửi tiền</a>
                                    <a class="dropdown-item" href="{{ route('dashboards.walletpartners') }}">Giao dịch rút tiền</a>
                                    <a class="dropdown-item" href="{{ route('dashboards.moneywaiting') }}">Giao dịch thẻ</a>
                                </div>
                            </div>
                        </div>
                        <p class="text-light pt-2 text-center">XÁC NHẬN GIAO DỊCH</p>
                    </div>
                    <div class="card-body pb-0 text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 style="font-size: 16px">Gửi tiền</h3>
                                <h4 class="mb-0 pt-3">
                                    <span class="count" style="font-size: 20px">{{ $bankings }}</span>
                                </h4>
                            </div>
                            <div class="col-md-4 pb-4" style="border-right: 1px solid #ffffff;border-left: 1px solid #ffffff">
                                <h3 style="font-size: 16px">Rút tiền</h3>
                                <h4 class="mb-0 pt-3">
                                    <span class="count" style="font-size: 20px">{{ $histories }}</span>
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <h3 style="font-size: 16px">Thẻ tiền</h3>
                                <h4 class="mb-0 pt-3">
                                    <span class="count" style="font-size: 20px">{{ $wallets }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
            @else
            @endif
            @endforeach

{{-- Admin + Staff--}}
        @foreach($user_id->roles as $role)
        @if($role->name == "Staff")
        <div class="content mt-3" style="padding: 0 35px">
            <div class="row">
                <div class="col-md-12">
                    <p class="title_thongke">THỐNG KÊ KHÁCH HÀNG</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div id="chart-container" data-new-customer="{{ $datas }}" data-new-partner="{{ $datas_ptr }}" style="min-height: 250px">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-flat-color-5" style="min-height: 250px;max-height: 250px">
                        <div class="card-header">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <div class="dropdown-menu-content">
                                        <a class="dropdown-item" href="{{ route('dashboards.confirmorders') }}">Đơn hàng chờ xác nhận</a>
                                        <a class="dropdown-item" href="{{ route('dashboards.ordersdeletecancelled') }}">Đơn hàng từ chối và hủy</a>
                                    </div>
                                </div>
                            </div>
                            <p class="text-light pt-2 text-center">XÁC NHẬN ĐƠN HÀNG</p>
                        </div>
                        <div class="card-body pb-0 text-center">
                            <div class="row">
                                <div class="col-md-6 pt-1 pb-4" style="border-right: 1px solid #ffffff">
                                    <span style="font-size: 18px">Chờ xác nhận</span>
                                    <h4 class="mb-0 pt-5">
                                        <span class="count" style="font-size: 24px">{{ $order_xn }}</span>
                                    </h4>
                                </div>
                                <div class="col-md-6 pt-1 pb-4">
                                    <span style="font-size: 18px">Từ chối và Hủy</span>
                                    <h4 class="mb-0 pt-5">
                                        <span class="count" style="font-size: 24px">{{ $order_xh }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
{{-- Trừ Partner --}}
        @foreach($user_id->roles as $role)
        @if($role->name == "Staff" || $role->name == "Support")
        <div class="content mt-3">
            <div class="row">
                <div class="col-md-12">
                    <p class="title_thongke">THỐNG KÊ ĐƠN HÀNG VÀ DOANH SỐ.</p>
                </div>
                <div class="col-md-12">
                    <form action="" autocomplete="off">
                        @csrf
                        <div class="col-md-2">
                            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                        </div>

                        <div class="col-md-2">
                            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                        </div>

                        <div class="col-md-2">
                            <p>
                                Lọc theo:
                                <select class="dashboard-filter form-control">
                                    <option>Chọn</option>
                                    <option value="7ngay">7 ngày qua</option>
                                    <option value="thangtruoc">Tháng trước</option>
                                    <option value="thangnay">Tháng này qua</option>
                                    <option value="365ngayqua">365 ngày qua</option>
                                </select>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="myfirstchart" style="height: 250px">

                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="row">
                <div class="col-md-12">
                    <p class="title_thongke">THỐNG KÊ TRUY CẬP.</p>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-dark text-center">
                        <thead>
                            <tr>
                                <th>Đang online</th>
                                <th>Tổng tháng trước</th>
                                <th>Tổng tháng này</th>
                                <th>Tổng một năm</th>
                                <th>Tổng truy cập</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $visitor_count }}</td>
                                <td>{{ $visitor_lastmonth_count }}</td>
                                <td>{{ $visitor_thismonth_count }}</td>
                                <td>{{ $visitor_year_count }}</td>
                                <td>{{ $visitors_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @break
        @else
        @endif
        @endforeach

        @foreach($user_id->roles as $role)
            @if($role->name == "Partner")
        <div class="content mt-3 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <p class="title_thongke">THỐNG KÊ ĐƠN HÀNG DOANH SỐ ĐỐI TÁC.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div id="chart-orderdetails" data-list-day="{{ $listDay }}" data-doanh-thu="{{ $array_dt }}" style="height: 250px"></div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-flat-color-4" style="min-height: 250px;max-height: 250px">
                        <div class="card-header">
                            <div class="dropdown float-right">
                                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <div class="dropdown-menu-content">
                                        <a class="dropdown-item" href="{{ route('dashboards.partnerorders') }}">Đơn hàng chờ xác nhận</a>
                                    </div>
                                </div>
                            </div>
                            <p class="text-light pt-2 text-center">ĐƠN HÀNG CHỜ XÁC NHẬN</p>
                        </div>
                        <div class="card-body pb-0 text-center">
                            <div class="row">
                                <div class="col-md-12 pt-1 pb-4">
                                    <span style="font-size: 18px">Chờ xác nhận</span>
                                    <h4 class="mb-0 pt-5">
                                        <span class="count" style="font-size: 24px">{{ $order_pendding }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @else
        @endif
        @endforeach
    </div><!-- /#right-panel -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
{{--    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">--}}
    <link rel="stylesheet" href="{{ asset('Backend/assets/js/morris.css') }}">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script type="text/javascript">
        $( function() {
            $( "#datepicker" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin:["Thứ 2", "Thứ 3", "Thứ 4","Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $( "#datepicker2" ).datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin:["Thứ 2", "Thứ 3", "Thứ 4","Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        } );
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            chart30daysorder();
        var chart = new Morris.Bar({
                element: 'myfirstchart',
                //option
                lineColors:['#819C79','#fc8710','#FF6541','#A4ADD3','#766856'],
                pointFillColors: ['#090909'],
                pointStrokeColors:['#0c0c0c'],
                gridTextColor:['#0c0c0c'],
                fillOpacity:1,
                hideHover:'auto',
                parseTime: false,
                xkey: 'period',
                ykeys: ['order','sales','profit','quantity'],
                behaveLikeLine: true,
                labels: ['Đơn hàng','Doanh số', 'Lợi nhuận','Số lượng phương tiện']
            });

            function chart30daysorder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ url('/days-order') }}",
                    method: "POST",
                    dataType: "JSON",
                    data:{
                        _token:_token
                    },
                    success:function (data) {
                        chart.setData(data);
                    }
                })
            }
            $('#btn-dashboard-filter').click(function () {
                // alert('ok')
                var _token = $('input[name="_token"]').val();
                var form_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                // alert(to_date)
                $.ajax({
                    url: "{{ url('/filter-by-date') }}",
                    method:"POST",
                    dataType:"JSON",
                    data:{
                        form_date:form_date,
                        to_date:to_date,
                        _token:_token
                    },
                    success:function (data) {
                        chart.setData(data);
                    }
                })
            });
            $('.dashboard-filter').change(function () {
                var dashboash_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                // alert(dashboash_value);
                $.ajax({
                    url:"{{ url('/dashboard-filter') }}",
                    method:"POST",
                    dataType:"JSON",
                    data:{
                        dashboash_value:dashboash_value,
                        _token:_token
                    },
                    success:function (data) {
                        chart.setData(data);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var colorDanger = "#FF1744";
                Morris.Donut({
                element:'donut',
                resize:true,
                colors:[
                    '#E0F7FA',
                    '#B2EBF2',
                    '#80DEEA',
                    '#4DD0E1',
                    '#26C6DA',
                    '#00BCD4',
                    '#00ACC1',
                    '#0097A7',
                    '#006064'
                ],
                data:[
                    {label:"Đối tác", value: {{ $partner_tk }}, color:colorDanger},
                    {label:"Admin", value: {{ $admin_tk }}},
                    {label:"Phương tiện", value: {{ $product_tk }}},
                    {label:"Khách hàng", value:{{ $customer_tk }}},
                    {label:"Đơn hàng", value:{{ $order_tk }}},
                ]
            })
        })
    </script>
    <script type="text/javascript">

        {{--var datas = <?php echo json_encode($datas)?>--}}
        let newcustomer = $("#chart-container").attr('data-new-customer');
        newcustomer = JSON.parse(newcustomer);

        let newparner = $("#chart-container").attr('data-new-partner');
        newparner = JSON.parse(newparner);

        Highcharts.chart('chart-container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Biểu đồ khách hàng và đối tác mới'
            },
            subtitle: {
                text: 'Source: chungxe.vn'
            },
            xAxis: {
                categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
            },
            yAxis: {
                title: {
                    text: 'Khách hàng - Đối tác'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Khách hàng',
                data: newcustomer
            },
                {
                    name: 'Đối tác',
                    data: newparner
                }]
        });

    </script>
    <script type="text/javascript">

        let listDay = $("#chart-orderdetails").attr('data-list-day');
        listDay = JSON.parse(listDay);

        let doanhthu = $("#chart-orderdetails").attr('data-doanh-thu');
        doanhthu = JSON.parse(doanhthu);

        Highcharts.chart('chart-orderdetails', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Doanh thu theo tháng'
            },
            subtitle: {
                text: 'Source: chungxe.vn'
            },
            xAxis: {
                categories: listDay
            },
            yAxis: {
                title: {
                    text: 'Thu nhập (VNĐ)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Doanh thu',
                data: doanhthu
            }]
        });
    </script>
@endsection
