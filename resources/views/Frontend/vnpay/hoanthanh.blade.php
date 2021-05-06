@extends('layouts.Frontend.base')
@section('title', 'Chọn xe')
@section('content')
    <div class="container-fluid banner-product">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12" style="background: #ffffff; padding: 30px 0;">
                            <h3 style="color: #127d81;font-size: 24px;text-align: center">THÔNG TIN KHÁCH HÀNG</h3>
                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>HỌ & TÊN</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ \Auth::user()->name }}</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>SỐ ĐIỆN THOẠI</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ \Auth::user()->phone }}</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>EMAIL</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ \Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-md-12" style="background: #ffffff; padding: 30px 0;">
                            <h3 style="color: #127d81;font-size: 24px;text-align: center">CHI TIẾT ĐẶT XE</h3>
                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>TRẠNG THÁI</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>Chờ chủ xe xác nhận</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>Tên Phương Tiện</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ $new_order_detail->product->name }}</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>HÌNH THỨC NHẬN XE</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ $new_order_detail->payments }}</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>THỜI GIAN</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ $new_order_detail->product_received_date }} - {{ $new_order_detail->product_pay_date }}</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>GIÁ TRỊ ĐẶT XE</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>{{ number_format($new_order_detail->product_price_total) }} VNĐ</span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>PHƯƠNG THỨC THANH TOÁN</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>
                                        @if($new_order->payment_id == 1)
                                            Trả Sau(Tiền Mặt)
                                        @else
                                            Thanh Toán Online
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="row" style="padding-left: 20px;padding-top: 20px">
                                <div class="col-md-12">
                                    <h6>Ghi chú</h6>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 20px;">
                                <div class="col-md-12">
                                    <span>
                                        {{ $new_order_detail->note }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" style="padding-left: 40px">
                    <div class="row">
                        <div class="col-md-12" style="background-color: #ffffff">
                            <div class="row">
                                <div class="col-md-4 offset-4 pt-4 pb-3">
                                    <img src="{{ asset('Frontend/assets/icon/step3.png') }}" height="150" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pb-2" style="text-align: center">
                                    <h3 style="color: #127d81;font-size: 24px;text-align: center">ĐẶT XE THÀNH CÔNG</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: center">
                                    <span style="font-size: 18px">Mã đặt xe của bạn:</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pb-3" style="text-align: center">
                                    <span style="color: #2cb8af;font-weight: 700">{{ $new_order->order_id }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 pb-3" style="text-align: center">
                                    <span>Cảm ơn bạn đã sử dụng dịch vụ của Chungxe!Yêu cầu của bạn đã được hệ thống ghi nhận và chuyển sang bộ phận điều xe để sắp xếp.</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 pb-3" style="text-align: center">
                                    <span>Chúng tôi sẽ liên hệ lại với bạn trong vòng 30 phút tiếp theo (trong giờ hành chính).</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 offset-4 pb-3" style="text-align: center">
                                    <div class="row" style="text-align: center">
                                        <div class="col-md-3"><img src="{{ asset('Frontend/assets/icon/145802.svg') }}" width="40" alt=""></div>
                                        <div class="col-md-3"><img src="{{ asset('Frontend/assets/icon/179342.svg') }}" width="40" alt=""></div>
                                        <div class="col-md-3"><img src="{{ asset('Frontend/assets/icon/732200.svg') }}" width="40" alt=""></div>
                                        <div class="col-md-3"><img src="{{ asset('Frontend/assets/icon/733585.svg') }}" width="40" alt=""></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-3 pt-2 pb-3">
                                    <button style="width: 100%" class="btn btn-outline-info">Thêm vào lịch Google</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-3 pt-2 pb-2">
                                    <a href="{{ route('pages.customerprofiles') }}" style="width: 100%;color: #2cb8af;border-color: #2cb8af;background-color: #2cb8af" class="btn btn-outline-success"><span style="color: #ffffff">Upload hồ sơ cá nhân</span></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-3 pb-3" style="text-align: center">
                                    <span>*Upload giấy tờ cá nhân giúp quá trình thuê xe diễn ra nhanh chóng và thuận tiện hơn</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 offset-3 pb-3" style="text-align: center">
                                    <button style="border-color: #2cb8af" class="btn btn-outline-light"><img src="{{ asset('Frontend/assets/icon/507257.svg') }}" width="20" alt=""><a href="/" style="color: black;padding-left: 10px">Về trang chủ</a></button>
                                </div>
                            </div>
                            <div class="row" style="padding: 20px 20px">
                                <div class="col-md-12" >
                                    <div class="row" style="background-color: #fff3cd">
                                        <div class="col-md-12">
                                            <h6 class="pt-2">Chú ý:</h6>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span>- Nếu thuê xe từ 02 ngày trở lên phải kiểm tra nước làm mát, dầu máy, nếu thiếu phải bổ sung ngay.</span>
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <span>- Khi xe đang vận hành, thường xuyên để ý đèn báo hiệu trên bảng taplo, nếu thấy đèn báo sự cố, hoặc xe có hiện tượng khác thường phải dừng xe kiểm tra hoặc gọi điện thoại báo ngay cho Bên cho thuê xe. Nếu không, bạn sẽ chịu hoàn toàn phí sửa xe.</span>
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <span>- Nghiêm túc chấp hành luật giao thông đường bộ. Tự chịu trách nhiệm dân sự, hình sự trong suốt thời gian thuê xe.</span>
                                                </div>
                                            </div>

                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <span>- Tự chịu chi phí xăng dầu, cầu phà, bến bãi, tiền phạt nóng, tiền phạt nguội theo các lỗi mà luật pháp Việt Nam quy định.</span>
                                                </div>
                                            </div>

                                            <div class="row pt-3 pb-3">
                                                <div class="col-md-12">
                                                    <span>- Trong trường hợp bên thuê xe vi phạm, và bị phạt nguội, sẽ phải chịu hoàn toàn trách nhiệm cùng tổn phí bị phạt.</span>
                                                </div>
                                            </div>
                                        </div>
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
