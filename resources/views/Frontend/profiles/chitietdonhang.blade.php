@extends('layouts.Frontend.base')
@section('title', 'Chi tiết đơn hàng')
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
                                    Đơn hàng
                                </label>
                                <input type="radio" name="vehicle" id="motor" >
                                <label for="motor" style="font-size: 14px">
                                    Lịch sử
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h6 class="card-title">Mã số đơn hàng: {{ $order->order->order_id }}
                                                    @if($order->order->status == "pending")
                                                        <span class="badge badge-warning">Chờ nhận chuyến</span>
                                                    @elseif($order->order->status == "accept")
                                                        <span class="badge badge-success">Đã nhận chuyến</span>
                                                    @elseif($order->order->status == "paid")
                                                        <span class="badge badge-primary">Bắt đầu chuyến</span>
                                                    @elseif($order->order->status == "cancelled")
                                                        <span class="badge badge-secondary">Không nhận chuyến</span>
                                                    @elseif($order->order->status == "delete")
                                                        <span class="badge badge-danger">Hủy chuyến</span>
                                                    @elseif($order->order->status == "completed")
                                                        <span class="badge badge-primary" style="background-color: pink">Kết thúc chuyến</span>
                                                    @endif
                                                </h6>
                                                <div class="card-tools">
                                                    <div class="image-preview" id="imagePreview">
                                                        <img class="image-preview__image" width="150px" src="{{ $order->product->image }}" id="img_thumbnail" alt="">
                                                        <span id="store_image" class="image-preview__default-text"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @include('partials.alert')

                                    <div class="p-3 bg-body rounded shadow-sm">
                                        <h6 class="border-bottom pb-2 mb-0 text-center" style="font-size: 18px">Chi tiết đơn hàng</h6>
                                        <div class="d-flex text-muted pt-3">

                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Tên chủ xe: </strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{$order->product->user->name}} </a>
                                                </div>
                                                @if($order->order->status != 'pending')
                                                <div class="d-flex justify-content-between">
                                                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="badge badge-secondary">Bấm để xem thông tin chi tiết chủ xe</a>
                                                </div>
                                                @else
                                                @endif
                                            </div>
                                        </div>

                                        {{--                        Modal--}}
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="card card-header">Chủ xe: <b>{{$order->product->user->name}}</b></div>
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4>Thông tin chung</h4>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-8" style="margin-top: 20px">
                                                                        <p class="text-dark">Email: {{$order->product->user->email}}</p>
                                                                        <p class="text-dark">Phone: {{$order->product->user->phone}}</p>
                                                                        <p class="text-dark">Address: {{$order->product->user->address}}</p>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <img class="img-thumbnail"  width="200" height="100" src="{{$order->product->user->profile_photo_path}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="100%">
                                                            <div class="col-12 pt-3 pb-3">
                                                                <h4>Thông tin phương tiện</h4>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Tên: {{$order->product->name}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Thương hiệu: {{$order->product->brand->name}}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Khu vực đăng ký: {{$order->product->district->name}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Loại xe: {{$order->product->category->name}}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Kiểu xe: {{$order->product->range}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Mức Tiêu Thụ Năng Lượng: {{$order->product->consumption}}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Dung tích: {{$order->product->capacity}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Hộp số: {{$order->product->gear}}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Giá thuê/ngày: {{ number_format($order->product->price) }} VNĐ</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Tiền đặt cọc: {{ number_format($order->product->deposit) }} Tiệu VNĐ</p>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Chỗ ngồi: {{$order->product->seat}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p class="text-dark">Km tối đa: {{$order->product->km}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr width="100%">
                                                            <div class="col-12" style="margin-top: 40px">
                                                                <h4>Ảnh phương tiện</h4>
                                                            </div>
                                                            @foreach($galaxies as $galaxy)
                                                            <div class="col-3 pt-3">
                                                                <div class="thumbnail">
                                                                    <a href="#">
                                                                        <div style="height: 105px">
                                                                            <img src="{{ $galaxy->image }}" alt="" width="150" height="80">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--                        End Modal--}}

                                        <div class="d-flex text-muted pt-3">
                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Ngày nhận xe: </strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{date("d-m-Y",strtotime($order->product_received_date))}} </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex text-muted pt-3">
                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Ngày giao xe:</strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{date("d-m-Y",strtotime($order->product_pay_date))}} </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex text-muted pt-3">
                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Số ngày thuê:</strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{$total_day = (strtotime($order->product_pay_date) - strtotime($order->product_received_date))/86400 + 1 }}</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="d-flex text-muted pt-3">
                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Giá thuê xe/ngày:</strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{number_format($order->product->price, 0). ' VNĐ' }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex text-muted pt-3">
                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Tiền bảo hiểm:</strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{ number_format($order->product->insurrance, 0). ' VNĐ' }}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex text-muted pt-3">
                                            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                                <div class="d-flex justify-content-between">
                                                    <strong class="text-gray-dark">Tổng tiền:</strong>
                                                    <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{ number_format($order->product_price_total) }}&nbsp;VNĐ</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer form-inline">
                                        <a href="{{ route('pages.lichsuthuexe') }}" class="btn btn-primary" style="margin: 5px"><i class="fas fa-backward"></i> Quay lại</a>
                                    </div>
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
