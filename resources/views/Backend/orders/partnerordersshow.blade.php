@extends('layouts.Backend.base')
@section('title', 'Chi tiết đơn hàng')
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
                        <span style="float: left"><a href="{{ route('dashboards.partnerorders')}}">Đơn hàng</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.partnerordersshow', $order->order->order_id) }}">Chi tiết</a></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-10 offset-md-1">
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
                                            <span class="badge badge-primary">Đang trong chuyến</span>
                                        @elseif($order->order->status == "cancelled")
                                            <span class="badge badge-secondary">Không nhận chuyến</span>
                                        @elseif($order->order->status == "delete")
                                            <span class="badge badge-danger">Hủy chuyến</span>
                                        @elseif($order->order->status == "completed")
                                            <span class="badge badge-primary">Kết thúc chuyến</span>
                                        @endif
                                    </h6>
                                    <div class="card-tools">
                                        <div class="image-preview" id="imagePreview">
                                            <img class="image-preview__image" width="150px" src="{{ $order->product->image }}" id="img_thumbnail" alt="">
                                            <span id="store_image" class="image-preview__default-text"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6 style="padding-left: 60px;font-size: 18px;font-weight: 700">Thông tin đơn hàng</h6>
                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Thương hiệu:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $order->product->brand->name }}
                                        </div>
                                    </div>

                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Khu vực đăng ký:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $order->product->district->name }}
                                        </div>
                                    </div>

                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Loại xe:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $order->product->category->name }}
                                        </div>
                                    </div>

                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Kiểu xe:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $order->product->range }}
                                        </div>
                                    </div>

                                    @if($order->product->category_id == 1)
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <span style="font-weight: 500">Biển số xe:</span>
                                            </div>
                                            <div class="col-md-5">
                                                {{ $order->product->biensoxe }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <span style="font-weight: 500">Số lượng:</span>
                                            </div>
                                            <div class="col-md-5">
                                                {{ $order->quantity }} &#160;Xe
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @include('partials.alert')

                        <div class="p-3 bg-body rounded shadow-sm">
                            <h6 class="border-bottom pb-2 mb-0 text-center" style="font-size: 18px">Chi tiết đơn hàng</h6>
                            <div class="d-flex text-muted pt-3">

                                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-gray-dark">Tên khách hàng: </strong>
                                        <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{$order->order->user->name}} </a>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="badge badge-secondary">Bấm để xem thông tin chi tiết khách hàng</a>
                                    </div>
                                </div>
                            </div>

                            {{--                        Modal--}}
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="card card-header">Khách hàng: <b>{{$order->order->user->name}}</b></div>
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4>Thông tin chung</h4>
                                                </div>
                                                <div class="col-12">
                                                    <div class="col-8" style="margin-top: 20px">
                                                        <p class="text-dark">Email: {{$order->order->user->email}}</p>
                                                        <p class="text-dark">Phone: {{$order->order->user->phone}}</p>
                                                        <p class="text-dark">Address: {{$order->order->user->address}}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <img class="img-thumbnail"  style="max-width: 100%; max-height: 100%; display: block; overflow: hidden" src="{{$order->order->user->profile_photo_path}}">
                                                    </div>
                                                </div>

                                                <div class="col-12" style="margin-top: 40px">
                                                    <h4>Giấy tờ tùy thân</h4>
                                                </div>
                                                <div class="col-3">
                                                    <div class="thumbnail">
                                                        @if((isset($order->order->user->file->cmt_before)) && ($order->order->user->file->cmt_before != null))
                                                            <a href="{{$order->order->user->file->cmt_before}}" target="_blank">
                                                                <div style="height: 105px">
                                                                    <img src="{{$order->order->user->file->cmt_before}}" alt="" style="width:100%">
                                                                </div>
                                                                <div class="caption text-center">
                                                                    <p>Chứng minh thư <br/>(mặt trước)</p>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <div style="height: 105px; padding-top: 40px" class="text-center">Chứng minh thư <br/> mặt trước: <b>Thiếu</b></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="thumbnail">
                                                        @if((isset($order->order->user->file->cmt_after)) && ($order->order->user->file->cmt_after != null))
                                                            <a href="{{$order->order->user->file->cmt_after}}" target="_blank">
                                                                <div style="height: 105px">
                                                                    <img src="{{$order->order->user->file->cmt_after}}" alt="" style="width:100%">
                                                                </div>
                                                                <div class="caption text-center">
                                                                    <p>Chứng minh thư <br/>(mặt sau)</p>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <div style="height: 105px; padding-top: 40px" class="text-center">Chứng minh thư <br/> mặt sau: <b>Thiếu</b></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="thumbnail">
                                                        @if((isset($order->order->user->file->license_before)) && ($order->order->user->file->license_before != null))
                                                            <a href="{{$order->order->user->file->license_before}}" target="_blank">
                                                                <div style="height: 105px">
                                                                    <img src="{{$order->order->user->file->license_before}}" alt="" style="width:100%">
                                                                </div>
                                                                <div class="caption text-center">
                                                                    <p>Giấy phép lái xe <br/>(mặt trước)</p>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <div style="height: 105px; padding-top: 40px" class="text-center">Giấy phép lái xe  <br/> mặt trước: <b>Thiếu</b></div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="thumbnail">
                                                        @if((isset($order->order->user->file->license_after)) && ($order->order->user->file->license_after != null))
                                                            <a href="{{$order->order->user->file->license_after}}" target="_blank">
                                                                <div style="height: 105px">
                                                                    <img src="{{$order->order->user->file->license_after}}" alt="" style="width:100%">
                                                                </div>
                                                                <div class="caption text-center">
                                                                    <p>Giấy phép lái xe <br/>(mặt <sau></sau>)</p>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <div style="height: 105px; padding-top: 40px" class="text-center">Giấy phép lái xe <br/> mặt sau: <b>Thiếu</b></div>
                                                        @endif
                                                    </div>
                                                </div>

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
                                        <strong class="text-gray-dark">Bảo hiểm xe/xe:</strong>
                                        <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{number_format($order->product->insurrance, 0). ' VNĐ' }}</a>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex text-muted pt-3">
                                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-gray-dark">Tổng tiền:</strong>
                                        <a href="#" style="font-size: 14px; font-weight: bold; color: black ">{{number_format($order->order->price_total) . ' VNĐ'}}</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer form-inline">
                            @if($order->order->status == 'delete' || $order->order->status == 'cancelled' || $order->order->status == 'completed')
                                <a href="{{ route('dashboards.historyorderpartner') }}" class="btn btn-primary" style="margin: 5px"><i class="fas fa-backward"></i> Quay lại</a>
                            @else
                                <a href="{{ route('dashboards.partnerorders') }}" class="btn btn-primary" style="margin: 5px"><i class="fas fa-backward"></i> Quay lại</a>
                            @endif
                            @if($order->order->status == 'pending')
                                <form id="acceptOrder" action="{{ route('order.acceptOrder', $order->order->order_id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-warning" style="margin: 5px"><i class="fas fa-eject"></i> Đồng ý cho thuê</button>
                                </form>
                                <button type="button" class="btn btn-secondary" style="margin: 5px" data-toggle="modal" data-target="#refuseOrder"><i class="fas fa-backspace"></i>Từ chối cho thuê</button>
                            @elseif($order->order->status == 'accept')
                                <form id="paidOrder" action="{{ route('order.paidOrder', $order->order->order_id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-warning" style="margin: 5px"><i class="fas fa-eject"></i> Bắt đầu chuyến</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteOrder"><i class="fas fa-backspace"></i>Hủy chuyến</button>
                                <form action="{{ route('order.printOrder',$order->order->order_id) }}" method="GET" target="_blank">
                                    <button href="" class="btn btn-warning" style="margin: 5px"><i class="fas fa-save"></i> In hợp đồng</button>
                                </form>
                            @elseif($order->order->status == 'paid')
                                <form id="completedOrder" action="{{ route('order.completedOrder',$order->order->order_id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="margin: 5px"><i class="fas fa-save"></i> Kết thúc chuyến</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /#right-panel -->
    <!-- Modal delete -->
    <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lý do Hủy đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('order.deleteOrderss') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $order->order->id }}" name="order_id" id="order_id">
                        <div class="form-group">
{{--                            <span style="font-size: 16px;font-weight: 600" class="label-control">Chọn lý do từ chối đơn hàng</span>--}}
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Không liên hệ lại được khách hàng.
                            </label>
                        </div>
                        <div class="form-check pt-2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                                Khách yêu cầu hủy.
                            </label>
                        </div>
                        <div class="form-check pt-2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="3">
                            <label class="form-check-label" for="exampleRadios2">
                                Nghi vấn lừa đảo.
                            </label>
                        </div>
                        <div class="form-check pt-2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios7" value="4">
                            <label class="form-check-label" for="exampleRadios2">
                                Không có khả năng thực hiện.
                            </label>
                        </div>
                        <div class="form-group pt-2">
                            <label for="choice" class="label-control">Ghi chú:</label>
                            <textarea type="text" class="form-control" id="note_delete" name="note_delete"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Hủy chuyến</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>

    <!-- Modal resuft -->
    <div class="modal fade" id="refuseOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lý do từ chối đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('order.refuseOrderss') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $order->order->id }}" name="order_id" id="order_id">
                        <div class="form-group">
                            {{--                            <span style="font-size: 16px;font-weight: 600" class="label-control">Chọn lý do từ chối đơn hàng</span>--}}
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Không liên hệ được khách hàng để đàm phán.
                            </label>
                        </div>
                        <div class="form-check pt-2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                                Khách yêu cầu từ chối.
                            </label>
                        </div>
                        <div class="form-check pt-2">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="3">
                            <label class="form-check-label" for="exampleRadios2">
                                Không có khả năng thực hiện.
                            </label>
                        </div>
                        <div class="form-group pt-2">
                            <label for="choice" class="label-control">Ghi chú:</label>
                            <textarea type="text" class="form-control" id="note" name="note"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Từ chối</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script src="{{ asset('Backend/vendors/alertifyjs/alertify.js') }}"></script>
    <script>
        jQuery('#acceptOrder').submit(function (e){
            e.preventDefault();
            alertify.confirm('Bạn có chấp thuận với đơn hàng này',
                function(){
                    alertify.success('Chấp thuận thành công');
                    jQuery('#acceptOrder')[0].submit();
                }).set({"title":"Thông báo"});
        });
        jQuery('#completedOrder').submit(function (e){
            e.preventDefault();
            alertify.confirm('Bạn có muốn kết thúc chuyến đơn hàng này',
                function(){
                    alertify.success('Kết thúc thành công');
                    jQuery('#completedOrder')[0].submit();
                }).set({"title":"Thông báo"});
        });

        jQuery('#paidOrder').submit(function (e){
            e.preventDefault();
            alertify.confirm('Bạn có bắt đầu chuyến với đơn hàng này',
                function(){
                    alertify.success('bắt đầu thành công');
                    jQuery('#paidOrder')[0].submit();
                }).set({"title":"Thông báo"});
        });
        jQuery('#deletedOrder').submit(function (e){
            e.preventDefault();
            alertify.confirm('Bạn có muốn hủy đơn hàng này',
                function(){
                    alertify.success('hủy thành công');
                    jQuery('#deletedOrder')[0].submit();
                }).set({"title":"Thông báo"});
        });

    </script>

@endsection

