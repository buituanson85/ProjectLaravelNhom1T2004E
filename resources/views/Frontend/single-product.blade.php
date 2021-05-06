@extends('layouts.Frontend.base')
@section('title', 'Chi tiết phương tiện')
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
                            <h3 style="color: #127d81;font-size: 24px">{{ $product->name }}&nbsp;&nbsp;
                                @if($product->category_id == 1)
                                    <span style="font-size: 14px;" class="badge badge-success">BSX:{{ $product->biensoxe }}</span>
                                @else
                                @endif
                            </h3>
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
                                        {{ $product->engine }}
                                    </p>
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/3190249.svg') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->capacity }}</p>
                                    <p style="font-size: 16px;"><img src="{{ asset('Frontend/assets/icon/canso.png') }}" width="20" alt="">&nbsp;&nbsp;{{ $product->gear }}</p>
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
                            @if($product->category_id == 1)
                                <h6>TÍNH NĂNG</h6>
                                <div class="row">
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Điều Hòa(A/C)</div>
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Định vị (GPS)</div>
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Bluetooth</div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/1828739.svg') }}" width="15" alt="">&nbsp;&nbsp;Khe cắm USB</div>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>

                    <div class="row" style="padding-top: 30px">
                        <div class="col-md-12" style="padding-left: 50px">
                            <h6>THỦ TỤC</h6>
                            @if($product->category_id == 1)
                                <div class="row">
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/3596097.svg') }}" width="25" alt="">&nbsp;&nbsp;CMTND</div>
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/4337795.svg') }}" width="25" alt="">&nbsp;&nbsp;SỔ HỘ KHẨU</div>
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/273916.svg') }}" width="25" alt="">&nbsp;&nbsp;Bằng lái</div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/637126.svg') }}" width="25" alt="">&nbsp;&nbsp;Đặt cọc</div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/3596097.svg') }}" width="25" alt="">&nbsp;&nbsp;CMTND</div>
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/273916.svg') }}" width="25" alt="">&nbsp;&nbsp;Bằng lái</div>
                                    <div class="col-md-4"><img src="{{ asset('Frontend/assets/icon/637126.svg') }}" width="25" alt="">&nbsp;&nbsp;Đặt cọc</div>
                                </div>
                            @endif
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
                            @if( $product->category_id == 1)
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
                            @else
                                <div class="row pt-1">
                                    <div class="col-md-12"><span>- CMND: Bản gốc</span></div>
                                </div>

                                <div class="row pt-1">
                                    <div class="col-md-12"><span>- Bằng lái</span></div>
                                </div>

                                <div class="row pt-1">
                                    <div class="col-md-12"><span>- Đặt Cọc: Đặt cọc {{ $product->deposit }} triệu đồng (SV được miễn giảm)</span></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="row ml-3" style="background: #ffffff;">
                        @include('partials.alert')
                        <h3 style="padding-top: 20px;padding-left: 20px;color: #127d81;font-size: 24px">GIÁ VÀ THỦ TỤC</h3>

                        <div class="row" style="padding-top: 20px; width: 100%">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>HÌNH THỨC NHẬN XE</h6>
                                <div class="form-group" style="width: 100%; padding: 10px 0">
                                    <select class="form-control" id="receiveMethod" style="flex: 1;background-color: #ffffff;">
                                        <option selected value="Nhận xe đại lý">Nhận xe tại đại lý</option>
                                        <option value="Nhận xe tại nhà">Nhận xe tại nhà</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%">
                            <div class="col-md-12" style="padding-left: 40px;width: 100%">
                                <h6>Ngày nhận xe - Ngày trả xe</h6>
                                <div class="row">
                                    <div class="col-md-6" style="padding-right: 0!important;text-align: center">
                                        <input class="form-control" style="background-color: #ffffff;border: none;
                                        border-radius: 5px;width: 160px;font-size: 14px"  type="date" id="start_time" name="start_time" value="2021-05-03" required>
                                    </div>
                                    <div class="col-md-6" style="padding-left: 0!important;text-align: center">
                                        <input class="form-control" style="background-color: #ffffff;border: none;
                                        border-radius: 5px; width: 160px;font-size: 14px"  type="date" id="end_time" name="end_time" value="2021-05-03" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($product->category_id == 2)
                        <div class="row" style="width: 100%;padding: 10px 0;">
                            <div class="col-md-12" style="padding-left: 40px;">
                                <h6>Số lượng(<span style="font-size: 12px"> Tồn: {{ $product->quantity }}chiếc</span>):</h6>
                                <div class="row">

                                    <div class="col-md-10 pl-3">
                                        <input class="form-control" type="number" min="1" max="{{ $product->quantity }}" name="quantitys" id="quantitys">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="col-md-10 pl-3">
                                <input class="form-control" type="hidden" value="1" name="quantitys" id="quantitys">
                            </div>
                        @endif
                        <div class="row" style="width: 100%;padding: 10px 0;">
                            <div class="col-md-12" style="padding-left: 40px;">
                                <h6>Dịch vụ bảo hiểm</h6>
                                <div class="row">

                                    <div class="col-md-10 pl-3">
                                        <label class="label-control">Bảo Hiểm Xe&nbsp;<span id="product_insurrance" value="{{$product->insurrance}}" style="color: #29a366;font-weight: 700">(+{{ number_format($product->insurrance) }}₫)</span></label>
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
                                    <div class="col-md-7">Đơn giá</div>
                                    <div class="col-md-5">{{ number_format($product->price) }}&nbsp;VNĐ</div>
                                </div>
                                @php

                                    @endphp
                                <div class="row pl-2">
                                    <div  class="col-md-7">Thời gian thuê</div>
                                    <div class="col-md-5" id="total_time" name="total_time"></div>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 90%">
                        <div class="row pl-4" style="width: 100%;padding: 10px 0">

                            <div class="col-md-6"><h6 style="color: #2cb8af">TỔNG</h6></div>
                            <div id="price_2" class="col-md-6"><span style="color: #2cb8af;font-weight: 700"></span></div>
                        </div>

                        <form action="{{route('pages.showinfos',$product->id)}}" method="POST" style="width: 100%;padding-left: 25px;padding-top: 10px;padding-bottom: 20px">
                            @csrf
                            <div class="col-md-12" style="width: 100%">
                                <input type="hidden" name="total_price" id="total_price"/>
                                <input type="hidden" name="total_time_send" id="total_time_send"/>
                                <input type="hidden" name="start_time2" id="start_time2"/>
                                <input type="hidden" name="end_time2" id="end_time2"/>
                                <input type="hidden" name="receive_Method" id="receive_Method"/>
                                <input type="hidden" name="quantity" id="quantity"/>
                                <button type="submit" class="btn btn-success"
                                        style="width: 100%; padding-right: 20px; background-color: #2cb8af;border-color: #2cb8af">
                                    Đặt Xe</button>

                            </div>
                        </form>

                        <div class="row" style="width: 100%;padding-left: 40px;padding-top: 10px;padding-bottom: 20px; padding-right: 23px">
                            <div class="col-md-12" style="width: 100%">

                                <button type="button" class="btn btn-secondary" style="width: 100%">Quay Về</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(function (){
                var dtToday = new Date();
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' +month.toString();
                if (day < 10)
                    day = '0' + day.toString();
                var maxDate = year + '-' + month + '-' + day;
                $('#start_time').attr('min', maxDate);
                $('#end_time').attr('min', maxDate);
                // $('#start_time').attr('min', '2021-05-04');
            })
        })
    </script>
    <script type="text/javascript">
        function displayVals() {

            var start_time = $( "#start_time" ).val();
            var end_time = $( "#end_time" ).val();
            var receive_Method =$( "#receiveMethod" ).val();
            var quantitys =$( "#quantitys" ).val();

            var d = new Date(start_time);
            var n = d.getTime();
            var x = new Date(end_time);
            var y = x.getTime();


            var z = (y - n)/(1000*3600*24) + 1;

            var day1 = d.getDate();
            var day2 = x.getDate();

            var month1 = d.getMonth()+1;
            var month2 = x.getMonth()+1;

            var year1 = d.getFullYear();
            var year2 = x.getFullYear();

            var total = z*{{ $product->price }}*quantitys + {{$product->insurrance}}*quantitys;
            // var total=z.$("#product_price").val()+$("#product_insurrance").val();
            var total_con = total;
            total_con = Number((total_con).toFixed(1)).toLocaleString();

            document.getElementById("total_time").innerHTML = z+" ngày";

            document.getElementById("total_time_send").value = z;

            document.getElementById("total_price").value = total;

            document.getElementById("price_2").innerHTML = total_con+" VNĐ";

            document.getElementById("start_time2").value = year1+"-"+month1+"-"+day1;

            document.getElementById("end_time2").value = year2+"-"+month2+"-"+day2;

            document.getElementById("receive_Method").value = receive_Method;
            document.getElementById("quantity").value = quantitys;
        }
        $("input").change( displayVals );

        displayVals();
    </script>

@endsection
