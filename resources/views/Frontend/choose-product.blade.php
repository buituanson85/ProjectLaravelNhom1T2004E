@extends('layouts.Frontend.base')
@section('title', 'Choose Product')
@section('content')
<div class=" banner-product" >
    <div class="container">
        <div class="menu-choose"></div>

        <div class="detail-choose">
            <div class="detail-choose-left" style="position: relative">

            </div>

            <!--  details_right-->

            <div class="detail-choose-right">
                <form action="{{ route('pages.chooseproducts') }}" method="post" style="padding: 0">
                    @csrf
                <div style="position: absolute;top: 110px;left: 230px;width: 240px">
                    <div class="detail-choose-left-kieuxe">
                        <select class="form-control" id="categori_id" name="categori_id" style="flex: 1;background-color: #ffffff;">
                            @foreach($categories as $category)
                                <option
                                    @if($category_id == $category->id)
                                    selected
                                    @else

                                    @endif
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="detail-choose-left-loaixe" >
                        <select class="form-control" id="seat" name="seat" style="flex: 1;background-color: #ffffff;border-bottom: none!important;">
                            <option value="">Chỗ Ngồi</option>
                            @if($seat=="7 chỗ")
                                <option selected value="7 chỗ">7 chỗ</option>
                                <option value="4 Chỗ">4 Chỗ</option>
                                <option value="5 chỗ">5 chỗ</option>
                                <option value="Xe sang">Xe sang</option>
                                <option value="Xe bán tải">Xe bán tải</option>
                            @elseif($seat =="4 Chỗ")
                                <option  value="7 chỗ">7 chỗ</option>
                                <option selected value="4 Chỗ">4 Chỗ</option>
                                <option value="5 chỗ">5 chỗ</option>
                                <option value="Xe sang">Xe sang</option>
                                <option value="Xe bán tải">Xe bán tải</option>
                            @elseif($seat=="5 chỗ")
                                <option  value="7 chỗ">7 chỗ</option>
                                <option  value="4 Chỗ">4 Chỗ</option>
                                <option selected value="5 chỗ">5 chỗ</option>
                                <option value="Xe sang">Xe sang</option>
                                <option value="Xe bán tải">Xe bán tải</option>
                            @elseif($seat=="Xe sang")
                                <option  value="7 chỗ">7 chỗ</option>
                                <option  value="4 Chỗ">4 Chỗ</option>
                                <option value="5 chỗ">5 chỗ</option>
                                <option selected value="Xe sang">Xe sang</option>
                                <option value="Xe bán tải">Xe bán tải</option>
                            @elseif($seat=="Xe bán tải")
                                <option value="7 chỗ">7 chỗ</option>
                                <option value="4 Chỗ">4 Chỗ</option>
                                <option value="5 chỗ">5 chỗ</option>
                                <option value="Xe sang">Xe sang</option>
                                <option selected value="Xe bán tải">Xe bán tải</option>
                            @else
                                <option  value="7 chỗ">7 chỗ</option>
                                <option  value="4 Chỗ">4 Chỗ</option>
                                <option value="5 chỗ">5 chỗ</option>
                                <option value="Xe sang">Xe sang</option>
                                <option value="Xe bán tải">Xe bán tải</option>
                            @endif
                        </select>
                    </div>
                    <div class="detail-choose-left-hopso" >
                        <select class="form-control" id="gear" name="gear" style="flex: 1;background-color: #ffffff;border-top: none!important;border-bottom: none">
                            <option value=""> Hộp Số </option>
                            @if($gear == "Số tự động")
                                <option selected value="Số tự động">Số tự động</option>
                                <option value="Số sàn">Số sàn</option>
                            @elseif($gear == "Số sàn")
                                <option value="Số tự động">Số tự động</option>
                                <option selected value="Số sàn">Số sàn</option>
                            @else
                                <option value="Số tự động">Số tự động</option>
                                <option value="Số sàn">Số sàn</option>
                            @endif
                        </select>
                    </div>

                    <div class="detail-choose-left-hangxe" >
                        <select class="form-control" id="brand_id" name="brand_id" style="flex: 1;background-color: #ffffff;border-top: none!important;border-bottom: none">
                            <option value=""> Hãng Xe </option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="detail-choose-left-loaixe" id="thapcao_first">
                        <select class="form-control" id="sort" name="sort" style="flex: 1;background-color: #ffffff;border-top: none!important;border-bottom: none">
                            <option value="">  Xắp xếp kết quả </option>
                            @if($sort == 0)
                                <option selected value="0">Từ thấp tới cao</option>
                                <option value="1">Từ cao đến thấp</option>
                            @elseif($sort == 1)
                                <option value="0">Từ thấp tới cao</option>
                                <option selected value="1">Từ cao đến thấp</option>
                            @else
                                <option value="0">Từ thấp tới cao</option>
                                <option value="1">Từ cao đến thấp</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="detail-choose-right-choose">
                    <div class="detail-choose-right-choose-city">
                        <select class="form-control" id="city_id" name="city_id" style="flex: 1;background-color: #ffffff">
                            <option value="">Thành Phố</option>
                            @foreach($cities as $city)
                                <option
                                    @if($city_id == $city->id)
                                        selected
                                    @else

                                    @endif
                                    value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="detail-choose-right-choose-city">
                        <select class="form-control" id="district_id" name="district_id" style="flex: 1;background-color: #ffffff;width: 180px">
                            <option value="">Quận Huyện</option>
                            @foreach($districts as $district)
                                <option
                                    @if($district_id == $district->id)
                                        selected
                                    @else

                                    @endif
                                    value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="detail-choose-right-choose-time">
                        <input class="form-control" style="background-color: #ffffff;border: none;border-radius: 5px;width: 160px"  type="date" id="start_time" name="start_time" value="{{ $start_time }}">
                    </div>
                    <div class="detail-choose-right-choose-time">
                        <input class="form-control" style="background-color: #ffffff;border: none;border-radius: 5px; width: 160px"  type="date" id="end_time" name="end_time" value="{{ $end_time }}">
                    </div>

                    <div class="detail-choose-right-choose-button-choose">

                    </div>

                </div>
                    <button class="btn btn-primary" style="position: absolute;top: 350px; left: 230px">Tìm Kiếm</button>
                </form>
                <div class="detail-choose-right-choose-button-choose" style="position: absolute;top: 110px;right: 200px;width: 150px">
                    <button onclick="list()" class="form-control"><i class="fas fa-list" ></i></button>
                    <button onclick="bando()" class="form-control"><i class="fas fa-map-marked-alt"></i></button>
                </div>

                <!--/list car-->
                <div class="hihi">
                    @foreach($products as $product)
                    <div class="detail-choose-right-product">
                        <input type="hidden" value="{{ $product->id }}">
                        <div class="product_img">
                            <img src="{{ $product->image }}" style="width: 100%" alt="">
                        </div>
                        <div class="product_detail">
                            <div style="font-weight: 600">{{ $product->name }}</div>
                            <span style="display: flex;padding-top: 10px; color: gold">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <div class="product_detail_type" >
                                <div class="product_detail_type_1">
                                    @foreach($districts as $district)
                                    @if($product->district_id == $district->id)
                                        <p><i class="fas fa-map-marked-alt"></i>{{ $district->name }}
                                        @break
                                    @endif
                                    </p>
                                    @endforeach
                                    <p ><i class="fas fa-gas-pump" ></i>
                                        @if($product->engine == "gasoline")
                                            Xăng
                                        @else
                                            Dầu
                                        @endif
                                    </p>
                                </div>
                                <div class="product_detail_type_1">
                                    <p></p>
                                    <p><i class="fas fa-cogs"></i> {{ $product->gear }}</p>
                                    <p><i class="fas fa-tachometer-alt"></i> {{ $product->consumption }}</p>
                                </div>


                            </div>
                        </div>
                        <div class="product_price">
                            <div>{{ number_format($product->price).' ' }}₫ <span style="font-size: 12px">/ngày</span></div>
                            <p style="font-style: italic;color: green">-5% khi thanh toán online</p>
                            <p style="text-align: center;padding-top: 18px;color: white;display: flex">
                            <form action="{{ route('pages.showproducts') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                                <input type="hidden" value="{{ $start_time }}" name="start_time" id="start_time">
                                <input type="hidden" value="{{ $end_time }}" name="end_time" id="end_time">
                                <button type="submit" style="border: 1px solid lightseagreen;color: white;flex: 1; background-color:lightseagreen;padding: 5px; border-radius: 5px;width: 100%" >Chi tiết</button>
                            </form>
                            </p>
                        </div>
                    </div>
                    @endforeach
                    {!! $products->links('pagination::bootstrap-4') !!}
                </div>

                <!--map-->
                <div id="map" class="map-son-s1" style="border-radius: 50px;display: none;border: 5px solid lightseagreen; height: 400px"></div>
            </div>

        </div>

    </div>
</div>

<script src="{{ asset('Frontend/assets/js/jquery.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaj0mHlR-keu-9hsR6d-gB0L9BclG04rk&callback=initMap&libraries=&v=weekly" defer></script>


@endsection
