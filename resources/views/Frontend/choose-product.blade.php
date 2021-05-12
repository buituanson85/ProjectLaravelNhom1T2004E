@extends('layouts.Frontend.base')
@section('title', 'Chọn xe')
@section('content')
    <div class=" banner-product" >
        <div class="container">
            <div class="menu-choose"></div>

            <div class="detail-choose">
                <div class="detail-choose-left" style="position: relative">

                </div>

                <!--  details_right-->

                <div class="detail-choose-right" style="min-height: 280px">
                    <form action="{{ route('pages.chooseproducts') }}" method="post" style="padding: 0">
                        @csrf
                        <div style="position: absolute;top: 110px;left: 230px;width: 240px">
                            <div class="detail-choose-left-kieuxe">
                                <select class="form-control" id="category_id" name="category_id" style="flex: 1;background-color: #ffffff;">
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
                                @if($category_id == 2)

                                @else
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
                                @endif
                            </div>
                            <div class="detail-choose-left-hopso" >
                                @if($category_id == 1)
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
                                @else
                                    <select class="form-control" id="gear" name="gear" style="flex: 1;background-color: #ffffff;border-top: none!important;border-bottom: none">
                                        <option value=""> Hộp Số </option>
                                        @if($gear == "Xe số")
                                            <option selected value="Xe số">Xe số</option>
                                            <option value="Xe tay ga">Xe tay ga</option>
                                        @elseif($gear == "Số sàn")
                                            <option value="Xe tay ga">Xe số</option>
                                            <option selected value="Xe tay ga">Xe tay ga</option>
                                        @else
                                            <option value="Xe số">Xe số</option>
                                            <option value="Xe tay ga">Xe tay ga</option>
                                        @endif
                                    </select>
                                @endif
                            </div>

                            <div class="detail-choose-left-hangxe" >
                                <select class="form-control" id="brand_id" name="brand_id" style="flex: 1;background-color: #ffffff;border-top: none!important;border-bottom: none">
                                    <option value=""> Hãng Xe </option>
                                    @foreach($brands as $brand)
                                        <option
                                            @if($brand_id == $brand->id)
                                            selected
                                            @else

                                            @endif
                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                <select class="form-control" id="city_id" name="city_id" style="background-color: #ffffff">
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
                                <select class="form-control" id="district_id" name="district_id" style="background-color: #ffffff;width: 180px">
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
                        </div>
                        <button class="btn btn-primary" style="position: absolute;top: 370px; left: 230px">Tìm Kiếm</button>
                    </form>
                    <div class="detail-choose-right-choose-button-choose" style="position: absolute;top: 110px;right: 200px;width: 150px">
                        <button onclick="list()" class="form-control"><i class="fas fa-list" ></i></button>
                        <button onclick="bando()" class="form-control"><i class="fas fa-map-marked-alt"></i></button>
                    </div>

                    <!--/list car-->
                    @csrf
                    <div class="hihi" id="post_data">

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
    <script type="text/javascript">
        $(document).ready(function () {
            var _token = $('input[name="_token"]').val();
            var category_id = $('#category_id').val();
            var seat = $('#seat').val();
            var gear = $('#gear').val();
            var brand_id = $('#brand_id').val();
            var sort = $('#sort').val();
            var city_id = $('#city_id').val();
            var district_id = $('#district_id').val();
            load_data('', _token,category_id, seat, gear, brand_id, sort, city_id, district_id);

            function load_data(id="", _token, category_id, seat, gear, brand_id, sort, city_id, district_id)
            {

                $.ajax({
                    url:"{{ route('loadmore.loaddata') }}",
                    method:"POST",
                    data:{
                        id : id,
                        _token : _token,
                        category_id: category_id,
                        seat : seat,
                        gear : gear,
                        brand_id : brand_id,
                        sort : sort,
                        city_id : city_id,
                        district_id : district_id
                    },
                    success:function(data)
                    {
                        $('#load_more_button').remove();
                        $('#post_data').append(data);
                    }
                });
            }

            $(document).on('click', '#load_more_button', function(){
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</b>');
                load_data(id, _token,category_id, seat, gear, brand_id, sort, city_id, district_id);
            });
        });
    </script>
    <script type="text/javascript">
        "use strict";

        let map;
        const hanoi = {
            lat: 21.02904255838699,
            lng: 105.78266438739159
        };
        /**
         * The CenterControl adds a control to the map that recenters the map on
         * Chicago.
         */

        class CenterControl {
            constructor(controlDiv, map, center) {
                this.map_ = map; // Set the center property upon construction

                this.center_ = new google.maps.LatLng(center);
                controlDiv.style.clear = "both"; // Set CSS for the control border

                const goCenterUI = document.createElement("div");
                goCenterUI.id = "goCenterUI";
                goCenterUI.title = "Click to recenter the map";
                controlDiv.appendChild(goCenterUI); // Set CSS for the control interior

                const goCenterText = document.createElement("div");
                goCenterText.id = "goCenterText";
                goCenterText.innerHTML = "Center Map";
                goCenterUI.appendChild(goCenterText); // Set CSS for the setCenter control border

                const setCenterUI = document.createElement("div");
                setCenterUI.id = "setCenterUI";
                setCenterUI.title = "Click to change the center of the map";
                controlDiv.appendChild(setCenterUI); // Set CSS for the control interior

                const setCenterText = document.createElement("div");
                setCenterText.id = "setCenterText";
                setCenterText.innerHTML = "Set Center";
                setCenterUI.appendChild(setCenterText); // Set up the click event listener for 'Center Map': Set the center of
                // the map
                // to the current center of the control.

                goCenterUI.addEventListener("click", () => {
                    const currentCenter = this.center_;
                    this.map_.setCenter(currentCenter);
                }); // Set up the click event listener for 'Set Center': Set the center of
                // the control to the current center of the map.

                setCenterUI.addEventListener("click", () => {
                    const newCenter = this.map_.getCenter();
                    this.center_ = newCenter;
                });
            }
        }

        function initMap() {

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: hanoi
            }); // Create the DIV to hold the control and call the CenterControl()
            // constructor passing in this DIV.

            const centerControlDiv = document.createElement("div");
            const control = new CenterControl(centerControlDiv, map, chicago);
            centerControlDiv.index = 1;
            centerControlDiv.style.paddingTop = "10px";
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(
                centerControlDiv
            );
            var iconBase =
                'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

            var icons = {
                parking: {
                    icon: iconBase + 'parking_lot_maps.png'
                },
                library: {
                    icon: iconBase + 'library_maps.png'
                },
                info: {
                    icon: iconBase + 'info-i_maps.png'
                }
            };

            var features = [
                {
                    position: new google.maps.LatLng(21.010739445895037, 105.8608104185493),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.02874838969118, 105.85093088225027),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.018231928562958, 105.8300500437901),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.0834462174512, 105.81815897445786),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.01973608154633, 105.88467999332073),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.017331988320013, 105.95262822600478),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.034997834736224, 105.81383898939963),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(20.986873040698203, 105.86377433194292),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(20.99767645465602, 105.80975479726138),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(20.959801156066913, 105.75644726798646),
                    type: 'info'
                }, {
                    position: new google.maps.LatLng(21.076758023357183, 105.77050949425484),
                    type: 'info'
                },{
                    position: new google.maps.LatLng(21.006397863572584, 105.77086055985967),
                    type: 'info'
                }];

            // Create markers.
            for (var i = 0; i < features.length; i++) {
                var marker = new google.maps.Marker({
                    position: features[i].position,
                    icon: icons[features[i].type].icon,
                    map: map
                });
            }
        }
    </script>
@endsection
