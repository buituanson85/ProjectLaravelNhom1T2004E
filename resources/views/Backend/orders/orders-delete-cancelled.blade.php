@extends('layouts.Backend.base')
@section('title', 'Danh sách đơn hàng từ chối và hủy')
@section('content')

    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.ordersdeletecancelled') }}">Danh Sách Đơn Hàng Bị Từ Chối Và Hủy</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5 m-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">Lịch sử đơn hàng(Đơn hàng từ chồi và hủy)</h3>
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
                                    <th>Xác nhận</th>
                                    <th>Đặt hộ</th>
                                    <th>Chi tiết</th>
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
                                        <td>{{ number_format($order->price_total) }}&#160;VNĐ</td>
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
                                        <td><a href="{{route('dashboards.showordersdeletecancelled', $order->order_id)}}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a></td>
                                        <td>
                                            <form action="{{ route('dashboards.acceptdeletecancelled', $order->order_id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Xác nhận</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('dashboards.updateconfirmorders', $order->order_id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>&nbsp;Đặt hộ</button>
                                            </form>
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

