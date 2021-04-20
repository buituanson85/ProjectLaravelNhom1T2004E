@extends('layouts.Frontend.base')
@section('title', 'Home Pages')
@section('content')
    <div class="swiper-container">

        <div class="swiper-wrapper" style="max-width: 100%;height: 600px;">
            <div class="swiper-slide"  style="background-image: url('{{ asset('Frontend/assets/images/slide_1.jpg') }}')">
                <div class="slide__content" style="background: rgba(0,0,0,0.3);height: 100%">
                    <div class="text_in_slide">
                        <h1>Chung xe </h1>
                        <h1>Thuê xe tự lái - Thoải mái hành trình</h1>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('{{ asset('Frontend/assets/images/slide_2.jpg') }}')">
                <div class="slide__content" style="background: rgba(0,0,0,0.3);height: 100%">
                    <div class="text_in_slide">

                        <h1>Chung xe - Cùng bạn trên mọi nẻo</h1>
                        <h1>đường</h1>

                    </div>
                </div>
            </div>
            <div class="swiper-slide"  style="background-image: url('{{ asset('Frontend/assets/images/slide_4.jpg') }}')">
                <div class="slide__content" style="background: rgba(0,0,0,0.3);height: 100%">
                    <div class="text_in_slide">

                        <h1>Đi lại thoải mái không giới hạn cùng</h1>
                        <h1>Chungxe</h1>

                    </div>
                </div>
            </div>
            <div class="form_search">
                <form action="{{ route('pages.chooseproducts') }}" method="post">
                    @csrf
                    <h2 style="text-align: center">Bạn cần thuê xe ?</h2>
                    <div class="form_checkbox"style="position: relative">
                        <div class="form_checkbox_general">
                            <select class="form-control" id="categori_id" name="categori_id" style="flex: 1;background-color: whitesmoke">
                                <option value="">Chọn Phương Tiện</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form_situation" style="position: relative">
                        <select class="form-control" id="city_id" name="city_id" style="flex: 1;background-color: whitesmoke">
                            <option value="">Chọn Thành Phố</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form_time">
                        <div class="form_time_general">
                            <div class="row">
                                <div class="col-md-5">
                                    <input class="form-control" style="background-color: whitesmoke;border: none;border-radius: 5px;width: 160px"  type="date" id="start_time" name="start_time">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" style="background-color: whitesmoke;border: none;border-radius: 5px; width: 160px"  type="date" id="end_time" name="end_time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form_submit">
                        <button class="btn btn-primary" type="submit">Tìm xe</button>
                    </div>

                </form>
            </div>


        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>

    </div>


    <div class="content_first">
        <div class="container">
            <p style="text-align: center; color: lightseagreen;font-size: 40px">Lợi ích của chung xe</p>
            <div class="benefit">
                <div class="benefit_general">
                    <div class="benefit_general_first">

                        <img src="{{ asset('Frontend/assets/images/profit_1.png') }}" style="width: 80px;height: 80px" alt="">

                        <span style=" line-height: 20px; padding-left: 20px">
                            <p style="font-weight: 700; font-size: 20px;">Nhiều sự lựa chọn</p>
                            <p>Hàng trăm loại xe đa dạng ở nhiều địa điểm trên cả nước, phù hợp với mọi mục đích của bạn</p>
                        </span>



                    </div>
                    <div class="benefit_general_first">

                        <img src="{{ asset('Frontend/assets/images/profit_2.png') }}" style="width: 80px;height: 80px" alt="">

                        <span style=" line-height: 20px; padding-left: 20px">
                            <p style="font-weight: 700; font-size: 20px;"> Thuận tiện</p>
                            <p>Dễ dàng tìm kiếm, so sánh và đặt chiếc xe như ý với chỉ vài click chuột</p>
                        </span>


                    </div>
                    <div class="benefit_general_first">

                        <img src="{{ asset('Frontend/assets/images/profit_3.png') }}" style="width: 80px;height: 80px" alt="">

                        <span style=" line-height: 20px; padding-left: 20px">
                            <p style="font-weight: 700; font-size: 20px;">Giá cả cạnh tranh</p>
                            <p>Giá thuê được niêm yết công khai và rẻ hơn 10% so với giá truyền thống</p>
                        </span>


                    </div>
                </div>
                <div class="benefit_general">
                    <div class="benefit_general_first">

                        <img src="{{ asset('Frontend/assets/images/profit_4.png') }}" style="width: 80px;height: 80px" alt="">

                        <span style=" line-height: 20px; padding-left: 20px">
                            <p style="font-weight: 700; font-size: 20px;">Tin cậy</p>
                            <p>Các xe đều có thời gian sử dụng dưới 3 năm và được bảo dưỡng thường xuyên</p>
                        </span>


                    </div>
                    <div class="benefit_general_first">

                        <img src="{{ asset('Frontend/assets/images/profit_5.png') }}" style="width: 80px;height: 80px" alt="">

                        <span style=" line-height: 20px; padding-left: 20px">
                            <p style="font-weight: 700; font-size: 20px;">Hỗ trợ 24/7</p>
                            <p>Có nhân viên hỗ trợ khách hàng trong suốt quá trình thuê xe</p>
                        </span>


                    </div>
                    <div class="benefit_general_first">

                        <img src="{{ asset('Frontend/assets/images/profit_6.png') }}" style="width: 80px;height: 80px" alt="">

                        <span style=" line-height: 20px; padding-left: 20px">
                            <p style="font-weight: 700; font-size: 20px;">Bảo hiểm</p>
                            <p>An tâm với các gói bảo hiểm vật chất và tai nạn trong suốt quá trình thuê xe</p>
                        </span>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content_second">
        <div class="container">
            <div class="Book" >
                <p style="text-align: center; color: lightseagreen;font-size: 40px">Đặt xe như thế nào</p>
                <div class="howto_book">
                    <div class="howto_book_general">

                        <img src="{{ asset('Frontend/assets/images/step1.webp') }}" alt="" style="width: 100%">


                        <p style="padding-top: 20px; font-size: 25px;font-weight: 600">Đặt xe</p>
                        <p>Nhanh chóng đặt một chiếc xe ưng ý thông qua Website của chúng tôi</p>
                    </div>
                    <div class="howto_book_general">

                        <img src="{{ asset('Frontend/assets/images/step2.webp') }}" alt="" style="width: 100%">


                        <p style="padding-top: 20px; font-size: 25px;font-weight: 600">Nhận xe</p>
                        <p>Nhận xe tại nhà hoặc các đại lý trong khu vực của chúng tôi</p>
                    </div>
                    <div class="howto_book_general">

                        <img src="{{ asset('Frontend/assets/images/step3.webp') }}" alt="" style="width: 100%">


                        <p style="padding-top: 20px; font-size: 25px;font-weight: 600">Tận hưởng</p>
                        <p>Tất cả các phương tiện của chúng tôi đều đoạt chuẩn an toàn</p>
                    </div>

                </div>


                <div style="text-align: center;margin: 20px 0">
                    <a href="" style="padding: 15px;border-radius: 10px 15px;color: white; background-color: lightseagreen">Xem chi tiết</a>
                </div>
            </div>
            <div class="communicate">
                <p style="text-align: center; color: lightseagreen;font-size: 40px">Truyền thông nói gì về chúng tôi</p>
                <div class="communicate_about">
                    <div class="communicate_about_general" >
                        <a class="the_a_two" href="https://congthuong.vn/7-startup-viet-xuat-sac-tranh-tai-tai-vong-chung-ket-quoc-gia-vietchallenge-2019-121720-121720.html" style="text-align: center;">
                            <div class="communicate_about_general_img" style="width: 100%; height: 250px">
                                <img src="https://chungxe.vn/assets/images/about/challenge.jpg" style="width: 100%;height: 100%"  alt="">
                            </div>

                            <p style="color: lightseagreen">Chungxe lọt vào vòng chung kết VietChallenge 2019</p>

                        </a>
                    </div>
                    <div class="communicate_about_general" >
                        <a class="the_a_two" href="https://startup.vnexpress.net/tin-tuc/hanh-trinh-khoi-nghiep/cong-bo-top-15-du-an-vao-vong-thuyet-trinh-startup-viet-2018-3834533-p2.html" style="text-align: center;">
                            <div class="communicate_about_general_img" style="width: 100%; height: 250px">
                                <img src="https://chungxe.vn/assets/images/about/doanhnhan8x.jpg" style="width: 100%;height: 100%"  alt="">
                            </div>

                            <p style="color: lightseagreen">Chungxe nằm trong Top 15 Startup Việt 2018</p>

                        </a>
                    </div>
                    <div class="communicate_about_general" >
                        <a class="the_a_two" href="https://startup.vnexpress.net/tin-tuc/y-tuong-moi/doanh-nhan-8x-va-nen-tang-truc-tuyen-chia-se-xe-tu-lai-3833028.html?fbclid=IwAR1c3qn3I9UoNMHbfd-sKnRC4KC3FM5WmPR9g9wr0reKbcg_mAEmu6QduiQ" style="text-align: center;">
                            <div class="communicate_about_general_img" style="width: 100%; height: 250px">
                                <img src="https://chungxe.vn/assets/images/about/hist.png" style="width: 100%;height: 100%"  alt="">
                            </div>

                            <p style="color: lightseagreen">Doanh nhân 8x và nền tảng trực tuyến chia sẻ xe tự lái - Startup VnExpress</p>

                        </a>
                    </div>
                    <div class="communicate_about_general" >
                        <a class="the_a_two" href="http://www.pcworld.com.vn/articles/cong-nghe/song-va-cong-nghe/2018/10/1257720/hist-2018-chao-don-21-du-an-tham-gia-vong-tang-toc-huan-luyen/" style="text-align: center;">
                            <div class="https://chungxe.vn/assets/images/about/vnexpress.jpg" style="width: 100%; height: 250px">
                                <img src="https://chungxe.vn/assets/images/about/vnexpress.jpg" style="width: 100%;height: 100%"  alt="">
                            </div>

                            <p style="color: lightseagreen">Chungxe lọt vào vòng chung kết HIST 2018</p>
                        </a>
                    </div>

                    <div class="communicate_about_general" >
                        <a class="the_a_two" href="https://cafebiz.vn/y-tuong-bookingcom-trong-linh-vuc-cho-thue-xe-o-to-dat-giai-nhat-cuoc-thi-lap-trinh-ve-giao-thong-thong-minh-20180717153509249.chn" style="text-align: center;">
                            <div class="https://chungxe.vn/assets/images/about/vnexpress.jpg" style="width: 100%; height: 250px">
                                <img src="https://chungxe.vn/assets/images/about/vnexpress.jpg" style="width: 100%;height: 100%"  alt="">
                            </div>

                            <p style="color: lightseagreen">Ý tưởng “Booking.com trong lĩnh vực cho thuê xe ô tô tự lái”</p>
                        </a>
                    </div>
                </div>
                <div style="text-align: center;margin: 20px 0">
                    <a href="" style="padding: 15px;border-radius: 10px 15px;color: white; background-color: lightseagreen;">Tìm hiểu thêm</a>
                </div>
            </div>

            <div class="partner">
                <p style="text-align: center; color: lightseagreen;font-size: 40px">Đối tác của chúng tôi</p>
                <div class="partner_general">
                    <img src="{{ asset('Frontend/assets/images/vivuautoweb.webp') }}" alt="" style="width: 100%">
                    <img src="{{ asset('Frontend/assets/images/avisweb.webp') }}" alt="" style="width: 100%">
                    <img src="{{ asset('Frontend/assets/images/bongtripweb.webp') }}" alt="" style="width: 100%">

                    <img src="{{ asset('Frontend/assets/images/kkdayweb.webp') }}" alt="" style="width: 100%">
                </div>
            </div>

        </div>
    </div>

@endsection


