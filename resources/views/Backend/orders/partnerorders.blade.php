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
                        <span style="float: left"><a href="{{ route('dashboards.partnerorders') }}">Đơn Hàng</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5 m-0">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Đơn hàng</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('dashboards.historyorderpartner') }}" class="btn btn-primary pull-right"><i class="fas fa-plus-circle"></i>&#160;Lịch sử đơn hàng</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
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
{{--                                    <th>Xóa</th>--}}
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
                                                <a class="badge badge-primary" style="background-color: pink">Kết thúc chuyến</a>
                                        @endif
                                        <td><a href="{{route('dashboards.partnerordersshow', $order->order_id)}}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a></td>
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
                            - Chủ phương tiện có 1 tiếng đồng hồ để chấp nhận chuyến(tính từ thời điểm nhận được đơn hàng)<span class="badge badge-warning">Chờ nhận chuyến</span>.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Đồng ý cho thuê:<br>
                            &#160;&#160;&#160;&#160;+ Chủ phương tiện thao tác đồng ý cho thuê trong mục chi tiết đơn hàng chuyển trạng thái <span class="badge badge-success">Đã nhận chuyến</span><br>
                            &#160;&#160;&#160;&#160;+ Lúc này số lượng phương tiện sẽ giảm đi 1 với oto,số lượng khách hàng đặt với xe máy và ẩn hiển thị trên web với phương tiện nếu số lượng tồn bằng 0.<span class="badge badge-secondary">unready</span><br>
                            &#160;&#160;&#160;&#160;+ Ô Tô: Không thể nhận chuyến nếu phương tiện đó đã nhận chuyến ở đơn hàng khác(đơn hàng chưa kết thúc hủy,hoàn thành,xóa).<br>
                            &#160;&#160;&#160;&#160;+ Xe máy: Không thể nhận chuyến nếu số lượng khách hàng đặt lớn hơn số lượng tồn phương tiện trên hệ thống,trường hợp bằng nhau có thể nhận chuyến nhưng trạng thái phương tiện sẽ chuyển sang ẩn hiển thị trên web.<span class="badge badge-secondary">unready</span><br>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Từ chối cho thuê:<br>
                            &#160;&#160;&#160;&#160;+ Nếu phương tiện chưa sẵn sàng tài xế có thể từ chối cho thuê <span class="badge badge-secondary">Từ chối cho thuê</span>,Confirm = 0<br>
                            &#160;&#160;&#160;&#160;+ Đơn hàng bị từ chối sẽ chuyển sang mục "Đơn hàng bị từ chối và hủy" Admin phải kiểm tra và xác nhận đơn hàng này..confirm = 1<br>
                            &#160;&#160;&#160;&#160;+ % lượt từ chối được tính theo tháng sẽ ảnh hưởng đến số tiền thưởng theo kỳ của công ty.<br>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Bắt đầu chuyến:<br>
                            &#160;&#160;&#160;&#160;+ Sau khi ký kết hợp đồng và bàn giao phương tiện cho khách hàng chủ phương tiện có thể bắt đầu chuyến.<br>
                            &#160;&#160;&#160;&#160;+ Khi chủ phương tiện bắt đầu chuyến: trừ 5% số tiền trong tài khản ví + tiền đơn hàng vào "Tiền đang chờ duyệt" nếu khách hàng thanh toán qua thẻ ngân hàng.<br>
                            &#160;&#160;&#160;&#160;+ Lúc này đơn hàng chuyển sang trạng thái <span class="badge badge-primary">Đang trong chuyến</span>.<br>
                            &#160;&#160;&#160;&#160;+ Đơn hàng chuyển trạng thái confirm là 1.<br>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Hủy chuyến:<br>
                            &#160;&#160;&#160;&#160;+ Trong trường hợp khách hàng không có nhu cầu sử dụng hoặc vì lý do nào đó chủ phương tiện hủy chuyến đơn hàng này.confirm = 0<br>
                            &#160;&#160;&#160;&#160;+ Lúc này đơn hàng chuyển sang trạng thái <span class="badge badge-danger">Hủy chuyến</span>.<br>
                            &#160;&#160;&#160;&#160;+ Đơn hàng do chủ phương tiện hủy sẽ chuyển sang mục "Đơn hàng bị từ chối và hủy" Admin phải kiểm tra và xác nhận đơn hàng này.confirm = 1<br>
                            &#160;&#160;&#160;&#160;+ Sau khi hủy đơn hàng: Số lượng sẽ sẽ được cộng lại bằng số lượng khách đã thuê.phương tiện chuyển trạng thái <span class="badge badge-primary">ready</span> để có thể tiếp tục nhận chuyến<br>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Kết thúc chuyến:<br>
                            &#160;&#160;&#160;&#160;+ Sau khi nhận lại và kiểm tra phương tiện từ phía khách hàng chủ phương tiện có thể kết thúc chuyến thuê để tiếp tục nhận chuyến khác<br>
                            &#160;&#160;&#160;&#160;+ Lúc này đơn hàng chuyển sang trạng thái <span class="badge badge-primary">Hoàn thành chuyến</span>.confirm = 1<br>
                            &#160;&#160;&#160;&#160;+ Sau khi hoàn thành đơn hàng: Số lượng sẽ sẽ được cộng lại bằng số lượng khách đã thuê.phương tiện chuyển trạng thái <span class="badge badge-primary">ready</span> để có thể tiếp tục nhận chuyến<br>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - In hợp đồng:<br>
                            &#160;&#160;&#160;&#160;+ Trong trạng thái <span class="badge badge-success">Đã nhận chuyến</span> CHủ phương tiện có thể in trước hoặc gửi cho khách hàng về hợp đồng mẫu nhằm giúp cho việc ký kết hợp đồng diễn ra thuận lợi<br>
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



