@extends('layouts.Backend.base')
@section('title', 'Danh sách đơn hàng')
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
                        <span style="float: left"><a href="{{ URL::to('/dashboards/order') }}">Đơn hàng</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">Danh sách đơn hàng</h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap" id="product_table" >
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Tổng giá</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiết</th>
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
                                        <td>{{ number_format($order->price_total) }}</td>
                                        <td>
                                            @if($order->status == "pending")
                                            <a class="badge badge-warning">Chờ nhận chuyến</a>
                                            @elseif($order->status == "accept")
                                                <a class="badge badge-success">Đã nhận chuyến</a>
                                            @elseif($order->status == "paid")
                                                <a class="badge badge-primary">Bắt đầu chuyến</a>
                                            @elseif($order->status == "cancelled")
                                                <a class="badge badge-secondary">Không nhận chuyến</a>
                                            @elseif($order->status == "delete")
                                                <a class="badge badge-danger">Hủy chuyến</a>
                                            @elseif($order->status == "completed")
                                                <a class="badge badge-primary" style="background-color: pink">Kết thúc chuyến</a>
                                            @endif
                                        <td><a href="{{route('dashboards-orders.show', $order->order_id)}}"><span class="btn btn-sm btn-secondary" style="background-color: greenyellow;border: none;color: black"><i class="fa fa-edit"></i>&nbsp;Chi tiết</span></a></td>
                                        <td>
                                            @if($order->status == "pending")
                                                <form action="{{ route('dashboards-orders.destroy',$order->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-edit"></i>&nbsp;Xóa</button>
                                                </form>
                                            @else
                                            @endif
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

