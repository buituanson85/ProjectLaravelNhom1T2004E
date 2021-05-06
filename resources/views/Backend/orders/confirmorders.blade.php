@extends('layouts.Backend.base')
@section('title', 'Đơn hàng chờ xác nhận')
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
                        <span style="float: left"><a href="{{ route('dashboards.confirmorders') }}">Đơn Hàng Chờ Xác Nhận</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5 m-0">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">Lịch sử đơn hàng(Đơn hàng chờ xác nhận)</h3>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap" id="product_table" >
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Thanh toán</th>
                                    <th>Tổng giá</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiết</th>
                                    <th>Đặt hộ</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($orders as $order )
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            @if($order->payment_id == 1)
                                                Tiền mặt
                                            @elseif($order->payment_id == 2)
                                                Thẻ
                                            @endif
                                        </td>
                                        <td>{{ number_format($order->price_total, 0) }}&#160;VNĐ</td>
                                        <td>
                                            @if($order->status == "pending")
                                                <a class="badge badge-warning">Chờ nhận chuyến</a>
                                            @elseif($order->status == "accept")
                                                <a class="badge badge-success">Đã nhận chuyến</a>
                                            @elseif($order->status == "paid")
                                                <a class="badge badge-primary">Đang trong chuyến</a>
                                            @elseif($order->status == "cancelled")
                                                <a class="badge badge-secondary">Không nhận chuyến</a>
                                            @elseif($order->status == "delete")
                                                <a class="badge badge-danger">Hủy chuyến</a>
                                            @elseif($order->status == "completed")
                                                <a class="badge badge-primary">Kết thúc chuyến</a>
                                        @endif
                                        <td><a href="{{route('dashboards.showconfirmorders', $order->order_id)}}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a></td>
                                        <td>
                                            <form action="{{route('dashboards.updateconfirmorders', $order->order_id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>&nbsp;Đặt hộ</button>
                                            </form>
                                        </td>
                                        <td>
                                            @if($order->status == "pending")
                                                <form action="{{ route('dashboards-orders.destroy',$order->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" id="create_at-{{ $order->id }}" value="{{ $order->created_at }}">
                                                    <div id="price_{{ $order->id }}" style="display: none"></div>
                                                    <div id="time_{{ $order->id }}" style="display: none"></div>
                                                    <button class="btn btn-sm btn-danger" id="id-{{ $order->id }}" name="deleteConfirm" style="display:none;"><i class="fa fa-edit"></i>&nbsp;Xóa</button>
                                                </form>
                                            @else
                                            @endif
                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                                                <script type="text/javascript">

                                                    var create_at_{{ $order->id }} = $( "#create_at-{{ $order->id }}" ).val();
                                                    var d_{{ $order->id }} = new Date(create_at_{{ $order->id }});
                                                    var n_{{ $order->id }} = d_{{ $order->id }}.getTime();
                                                    var x = new Date();
                                                    var y = x.getTime();
                                                    var z = (y - n_{{ $order->id }})/(1000*60);
                                                    var times = (60 - z)*60*1000;
                                                    document.getElementById("price_{{ $order->id }}").innerHTML = z;
                                                    document.getElementById("time_{{ $order->id }}").innerHTML = times;
                                                    setTimeout(function(){
                                                    document.getElementById("id-{{ $order->id }}").style.display = 'block';}, times);

                                            </script>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td><i class="fas fa-folder-open"></i> No Record found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 offset-1 pb-5 pt-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Quản lý các đơn hàng chờ đối tác nhận chuyến.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Nút <span class="btn btn-danger">Delete</span> sau 1 tiếng kể từ thời gian nhận đơn sẽ hiển thị do quá thời gian quy định không xác nhận đơn.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Các đơn hàng có hiển thị Nút <span class="btn btn-danger">Delete</span> sẽ được Admin xử lý.<br>
                            &#160;&#160;&#160;&#160;+ Gọi điện thông báo cho khách hàng về trường hợp này.<br>
                            &#160;&#160;&#160;&#160;+ Chuyển đơn sang chủ phương tiện<span class="btn btn-success">Đặt hộ</span> khác dựa theo thông tin order đã đặt(theo Giá,khu vực,loại phương tiện).<br>
                            &#160;&#160;&#160;&#160;+ Trường hợp khách hàng yêu cầu hủy đơn đối với đơn hàng thanh toán thẻ phải hoàn lại tiền cho khách hàng.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Đơn hàng mới được đặt đơn hàng cũ sẽ chuyển confirm sang 1,gửi mail cho khách hàng về thông tin đơn hàng mới.
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection

@section('addjs')
    <script type="text/javascript">
        jQuery(document).ready( function () {
            jQuery('#product_table').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi 1 trang",
                    "zeroRecords": "Không có bản ghi - sorry",
                    "info": "Trang số _PAGE_ trên tổng số _PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(Lọc từ _MAX_ bản ghi)",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "search": "Tìm kiếm:",
                }
            });
        } );
        jQuery(document).ready(function () {
            jQuery('.dataTables_filter input[type="search"]').css(
                {'width':'400px','display':'inline-block'}
            );
        });
    </script>
@endsection


