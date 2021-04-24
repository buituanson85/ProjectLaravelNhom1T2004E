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
                        <span style="float: left"><a href="{{ URL::to('/dashboards/order') }}">Orders</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">Orders Table</h3>

                            <div class="card-tools">
                                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Add New Product</a>
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
                                    @if(\Illuminate\Support\Facades\Auth::user()->roles->where('id', 1)->first() != null)
                                    <th>Chỉnh sửa</th>
                                    @endif
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
                                            @if($order->payment->method == 'cash')
                                                Tiền mặt
                                            @elseif($order->payment->method == 'card')
                                                Thẻ
                                            @endif
                                        </td>
                                        <td>{{ number_format($order->orderdetails->product_price_total, 0) }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td><a href="{{route('order.show', $order->order_id)}}"><span class="btn btn-sm btn-success"><i class="fa fa-edit"></i>&nbsp;Chi tiết</span></a></td>
                                        <td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->roles->where('id', 1)->first() != null)

                                            <a href=""><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            {{--                                            @if($role->name === "Admin")--}}

                                            {{--                                            @else--}}
{{--                                            <form action="" method="post">--}}
{{--                                                @csrf--}}
{{--                                                @method('delete')--}}
{{--                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>--}}
{{--                                            </form>--}}
                                            {{--                                            @endif--}}
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
                        "first":      "Đầu tiên",
                        "last":       "Cuối cùng",
                        "next":       "Sau",
                        "previous":   "Trước"
                    },
                    "search":         "Tìm kiếm:",
            });
        } );
        jQuery(document).ready(function () {
            jQuery('.dataTables_filter input[type="search"]').css(
                {'width':'400px','display':'inline-block'}
            );
        });
    </script>
@endsection

