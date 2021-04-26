@extends('layouts.Frontend.base')
@section('title', 'Home Pages')
@section('content')

    <div class="container-fluid banner-product">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background: #ffffff; padding: 30px 0;">
                    <div class="row">
                        <div class="col-md-6">
                            <img width="100%" src="{{ $product->image }}" alt="">
                        </div>
                        <div class="col-md-6">
                            <h3 style="color: #127d81;font-size: 24px">{{ $product->name }}</h3>
                            <span style="font-size: 16px">HOẶC TƯƠNG ĐƯƠNG</span>
                            <p>
                                <i class="fa fa-star" aria-hidden="true" style="color: yellow"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color: yellow"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color: yellow"></i>
                                <i class="fa fa-star" aria-hidden="true" style="color: yellow"></i>
                                <i class="fa fa-star-half" style="color: yellow"></i>
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/483497.svg') }}" width="20" alt="">&nbsp;&nbsp;
                                        @if($product->engine == "gasoline")
                                            Xăng
                                        @else
                                            Dầu
                                        @endif</p>
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/3190249.svg') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->capacity }}</p>
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/60473.svg') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->gear }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/566234.svg') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->seat }}</p>
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/89102.svg') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->range }}</p>
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/3219457.svg') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->consumption }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 50px">
                            <h6 style="font-size: 16px;">ĐỊA CHỈ</h6>
                            <span>TP-{{ $product->city->name }}</span>,<span>Quận-{{ $product->district->name }}</span>
                        </div>
                    </div>

                    <div class="row" style="padding: 10px 0">
                        <div class="col-md-12" style="padding-left: 50px">
                            <h6>TÍNH NĂNG</h6>
                            <div class="row">
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Điều Hòa(A/C)</div>
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Định vị (GPS)</div>
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Bluetooth</div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Khe cắm USB</div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 30px">
                        <div class="col-md-12" style="padding-left: 50px">
                            <h6>THỦ TỤC</h6>
                            <div class="row">
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/3596097.svg') }}" width="25" alt="">&nbsp;&nbsp;CMTND</div>
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/4337795.svg') }}" width="25" alt="">&nbsp;&nbsp;SỔ HỘ KHẨU</div>
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/273916.svg') }}" width="25" alt="">&nbsp;&nbsp;Bằng lái</div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/637126.svg') }}" width="25" alt="">&nbsp;&nbsp;Đặt cọc</div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 30px 0;">
                        <div class="col-md-12" style="padding-left: 50px">
                            <h6>CHẤP NHẬN THANH TOÁN</h6>
                            <div class="row pt-1">
                                <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/637126.svg') }}" width="25" alt="">&nbsp;&nbsp;Trả sau</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 50px">
                            <h6>GHI CHÚ</h6>
                            <div class="row pt-1">
                                <div class="col-md-12"><span>- CMND: Bản gốc</span></div>
                            </div>

                            <div class="row pt-1">
                                <div class="col-md-12"><span>- Sổ hộ khẩu: Bản gốc hoặc KT3</span></div>
                            </div>

                            <div class="row pt-1">
                                <div class="col-md-12"><span>- Bằng lái: B2 trở lên</span></div>
                            </div>

                            <div class="row pt-1">
                                <div class="col-md-12"><span>- Đặt cọc: Xe máy chính chủ + giấy đăng ký xe hoặc đặt cọc tiền mặt tối thiểu {{ $product->deposit }} triệu</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="row ml-3" style="background: #ffffff;">
                        <h3 style="padding-top: 20px;padding-left: 20px;color: #127d81;font-size: 24px">GIÁ VÀ THỦ TỤC</h3>

                        <div class="row" style="padding-top: 20px; width: 100%">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>HÌNH THỨC NHẬN XE</h6>
                                <div class="form-group" style="width: 100%; padding: 10px 0">
                                    <select class="form-control" id="gear" name="gear" style="flex: 1;background-color: #ffffff;">
                                        <option selected value="Số tự động">Nhận xe tại đại lý</option>
                                        <option value="Số sàn">Nhập xe tại nhà</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>Ngày nhận xe - Ngày trả xe</h6>
                                <div class="row">
                                    <div class="col-md-6" style="padding-right: 0!important;text-align: center">
                                        <input class="form-control" style="background-color: #ffffff;border: none;border-radius: 5px;width: 160px"  type="date" id="start_time" name="start_time">
                                    </div>
                                    <div class="col-md-6" style="padding-left: 0!important;text-align: center">
                                        <input class="form-control" style="background-color: #ffffff;border: none;border-radius: 5px; width: 160px"  type="date" id="end_time" name="end_time">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="width: 100%;padding: 10px 0;">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>MÃ KHUYẾN MÃI</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" width="100%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="width: 100%;padding: 10px 0;">
                            <div class="col-md-12" style="padding-left: 40px;">
                                <h6>Dịch vụ tùy chọn</h6>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" width="10px" class="form-control">
                                    </div>
                                    <div class="col-md-10" style="padding-left: 0!important;">
                                        <label class="label-control">Bảo Hiểm Xe&nbsp;<span style="color: #29a366;font-weight: 700">(+{{ number_format($product->insurrance) }}₫)</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="width: 100%;padding: 10px 0;">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>GIỚI HẠN QUÃNG ĐƯỜNG</h6>
                                <div class="row">
                                    <ul>
                                        <li>Tối đa {{ $product->km }} km/ngày</li>
                                        <li>Phụ trội {{ number_format($product->additional) }} đ/km</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%;">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>CHI TIẾT GIÁ</h6>
                                <div class="row pl-2">
                                    <div class="col-md-8">Đơn giá</div>
                                    <div class="col-md-4">{{ number_format($product->price) }}&nbsp;đ</div>
                                </div>
                                @php

                                @endphp
                                <div class="row pl-2">
                                    <div class="col-md-8">Thời gian thuê</div>
                                    <div class="col-md-4">1 ngày</div>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 90%">
                        <div class="row pl-4" style="width: 100%;padding: 10px 0">
                            @php
                                $total = $product->price;
                            @endphp
                            <div class="col-md-8"><h6 style="color: #2cb8af">TỔNG</h6></div>
                            <div class="col-md-4"><span style="color: #2cb8af;font-weight: 700">{{ number_format($total) }}&nbsp;đ</span></div>
                        </div>

                        <div class="row" style="width: 100%;padding-left: 25px;">
                            <div class="col-md-12" style="width: 100%">
                                <button type="button" class="btn btn-success" style="width: 100%;background-color: #2cb8af;border-color: #2cb8af">Đặt Xe</button>
                            </div>
                        </div>

                        <div class="row" style="width: 100%;padding-left: 25px;padding-top: 10px;padding-bottom: 20px">
                            <div class="col-md-12" style="width: 100%">
                                <button type="button" class="btn btn-secondary" style="width: 100%">Quay Về</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
