@extends('layouts.Backend.base')
@section('title', 'Đặt hộ xe')
@section('content')

    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-md-10">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.confirmorders') }}">Đơn Hàng Chờ Xác Nhận</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.updateconfirmorders',$order->order->order_id) }}">Đặt Hộ Xe Cho Khách Hàng</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5 m-0">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">Danh sách xe đặt hộ đơn hàng {{ $order->order->order_id }}</h3>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap" id="product_table" >
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên phương tiện</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Chủ phương tiện</th>
                                    <th>Khu vực</th>
                                    <th>Chi tiết</th>
                                    <th>Đặt hộ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($products as $product )
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ $product->image }}"></td>
                                        <td>{{number_format($product->price,0) }}&#160;VNĐ</td>
                                        <td>{{ $product->user->name }}</td>
                                        <td>{{ $product->district->name }}</td>
                                        <td>
                                            <form action="{{route('dashboards.chitietproductdatho', $product->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->order->order_id }}">
                                                <button type="submit" class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Chi tiết</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('dashboards.updateproductdatho',$product->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->order->order_id }}">
                                            <button type="submit" class="btn btn-sm btn-warning">Đặt hộ</button>
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


