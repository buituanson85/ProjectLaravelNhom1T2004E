@extends('layouts.Frontend.base')
@section('title', 'Lịch sử thuê xe')
@section('content')
    <div class="container-fluid banner-product">
        <div class="container">
            <div class="content" style="height: auto">
                <div class="row">
                    <div class="col-4">
                        <div class="info-left"  style="background-color: white">
                            <div class="info-left-general-active ">
                                <a href="{{ route('pages.lichsuthuexe') }}"><i class="fas fa-folder-open"></i> Lịch sử thuê xe</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('pages.customerprofiles') }}"><i class="fas fa-user-alt"></i> Thông tin cá nhân</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('pages.doimatkhau') }}"><i class="fas fa-cog"></i> Đổi mật khẩu</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 " >
                        <div class="choice_vehicle" style="display: flex;">
                            <div class="choice_vehicle_radio-button" style=" border-radius: 5px;)">
                                <input type="radio" name="vehicle" id="car" checked>
                                <label for="car" style="font-size: 14px" >
                                    <a href="{{ route('pages.lichsuthuexe') }}" style="color: #ffffff">Đơn hàng</a>
                                </label>
                                <input type="radio" name="vehicle" id="motor" >
                                <label for="motor" style="font-size: 14px">
                                    <a href="{{ route('pages.lsthuexe') }}">Lịch sử</a>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header text-center">
                                    <span style="font-size: 20px;font-weight: 600">ĐƠN HÀNG ĐANG DIỄN RA</span>
                                </div>
                                <div class="card-body" style="background-color: #ffffff;font-size: 14px">
                                    <table class="table table-hover text-nowrap" id="product_table" >
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Khách hàng</th>
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
                                                <td>{{ number_format($order->price_total) }}&nbsp;VNĐ</td>
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
                                                <td><a href="{{route('pages.chitietdonhang', $order->order_id)}}"><span class="btn btn-sm btn-secondary" style="background-color: greenyellow;border: none;color: black;font-size: 14px"><i class="fa fa-edit"></i>&nbsp;Chi tiết</span></a></td>
                                                <td>
                                                    @if($order->status == "pending")
                                                        <a href="{{ route('pages.deleteOrder',$order->order_id) }}" class="btn btn-sm btn-danger">Xóa</a>
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
                                    {!! $orders->render('pagination::bootstrap-4') !!}
                                </div>
                                <div class="card-footer">
                                    <a href="/" class="btn btn-sm btn-primary">Về trang chủ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
