<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chọn xe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('Frontend/assets/css/choose-product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/jquery.datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Frontend/assets/fonts/fontawesome-free-5.15.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/css_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/launch.css') }}">
    <!--    datetime-->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/jquery.datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!--slick-->
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaj0mHlR-keu-9hsR6d-gB0L9BclG04rk&callback=initMap&libraries=&v=weekly" defer></script>

</head>
<body>
<div class="header">

    <div class="container-fluid nav-list">
        <div class="nav-list-left">
            <div class="nav-list-left-logo">
                <a href="/">
                    <img src="{{ asset('Frontend/assets/images/logo_chungxe.png') }}" alt="">
                </a>
            </div>
            <div class="nav-list-left-partner">
                <a href="{{ route('pages.registerpartners') }}">Trở thành dối tác</a>
            </div>
        </div>
        <div class="nav-list-right">
            <ul class="nav-list-right-1">
                <li><a href="" class="the_a">Về chúng tôi</a></li>
                <li><a href="#" class="the_a" >Hỗ trợ</a></li>
                <li><a href="" class="the_a">Khuyến mãi</a></li>
                <li>
                    @if(Route::has('login'))
                        @auth()
                            @if(Auth::user()->utype === 'ADM')
                                <div class="dropdown">
                                    <span class="dropdown-toggle the_a" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item the_a" href="{{ route('dashboard.index') }}">Dashboard</a>
                                        <a class="dropdown-item the_a" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @else
                                <span class="dropdown-toggle the_a" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </span>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item the_a" href="#">Profile</a>
                                    <a class="dropdown-item the_a" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                        @csrf
                                    </form>
                                </div>
                            @endif
                </li>
                @else
                    <li>
                        <a class="the_a" href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a class="the_a" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                @endif
            </ul>

        </div>
    </div>
</div>

@yield('content')

<div class="end" >
    <div class="container over">
        <div class="over-part">
            <p>Liên hệ</p>
            <p>Công ty CP Chung Xe</p>
            <p>Hà Nội: Tầng 5, 166 Phố Huế, Hai Bà Trưng <br>
                Đà Nẵng: Tầng 3, 31 Trần Phú, Hải Châu <br>
                Hồ Chí Minh: 23 Phùng Khắc Khoan, Q1</p>
            <span style="padding-right: 5px">
                    <i class="fas fa-envelope-open"></i> <a href="contact@chungxe.vn" class="the_a_two" style="padding-left: 5px">contact@chungxe.vn</a><br>
                    <i class="fas fa-phone"></i> <a href="0903.22.99.06 " class="the_a_two" style="padding-left: 5px">0903.22.99.06</a>
                </span><br><br>
            <span>
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                </span>
        </div>
        <div class="over-part">
            <p>Giới thiệu</p>
            <p><a href="" class="the_a_two">Về chúng tôi</a></p>
            <p style="font-size: 20px;font-weight: 600;text-transform: uppercase"> Chứng nhận</p>
            <img src="{{ asset('Frontend/assets/images/bocongthuong.png') }}" style="width: 150px;height: 60px" alt="">
        </div>
        <div class="over-part">
            <p>Chính sách</p>
            <p><a href="" class="the_a_two">Chính sách bảo mật thông tin</a></p>
            <p><a href="" class="the_a_two">Quy chế hoạt động</a></p>
            <p><a href="" class="the_a_two">Sự cố và khiếu nại</a></p>
            <p><a href="" class="the_a_two">Chính sách và hoàn huỷ</a></p>
        </div>
        <div class="over-part">
            <p>Hỗ trợ</p>
            <p><a href="" class="the_a_two">Hướng dẫn thuê xe</a></p>
            <p><a href="" class="the_a_two">Hợp đồng thuê xe tự lái</a></p>
            <p><a href="" class="the_a_two">Cẩm nang thuê xe tự lái</a></p>
            <p><a href="" class="the_a_two">Câu hỏi thường gặp</a></p>
            {{--            <p><a href="">Chung xe blog</a></p>--}}
        </div>
    </div>

    {{--    <div></div>--}}
    {{--    <div class="form_checkbox" id="form_checkbox_car">--}}
    {{--        <div class="form_checkbox_general">--}}
    {{--            <button value="car" onclick="car()" class="form_checkbox_general_car"><i class="fas fa-car"></i> Ô tô   </button>--}}
    {{--            <button value="motor" onclick="motor()" class="form_checkbox_general_motor"> <i class="fas fa-motorcycle"></i> Xe máy</button>--}}
    {{--        </div>--}}
    {{--    </div>--}}

</div>
<script type="text/javascript">
    function car(){
        document.querySelector(".form_checkbox_general_car").style.border ="1px solid lightseagreen";

        document.querySelector(".form_checkbox_general_motor").style.border ="none";
    }
    function motor(){
        document.querySelector(".form_checkbox_general_motor").style.border ="1px solid lightseagreen";
    }
</script>
<script src="http://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{ asset('Frontend/assets/js/jquery.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('Frontend/assets/js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('Frontend/assets/js/google-map.js') }}"></script>

{{--<script type="text/javascript">--}}
{{--    $("#dateTake").datetimepicker();--}}
{{--    $("#datePay").datetimepicker();--}}
{{--</script>--}}
<script>
    function bando() {
        document.querySelector(".hihi").style.display ="none";
        document.querySelector(".map-son-s1").style.display ="block";
        document.querySelector(".listbutton").style.backgroundColor = "white";
        document.querySelector(".listbutton").style.color = "black";
        document.querySelector(".bandobutton").style.color = "white";
        document.querySelector(".bandobutton").style.backgroundColor = "lightseagreen";
    }
    function list() {
        document.querySelector(".hihi").style.display ="block";
        document.querySelector(".map-son-s1").style.display ="none";
        document.querySelector(".listbutton").style.backgroundColor = "lightseagreen";
        document.querySelector(".listbutton").style.color = "white";
        document.querySelector(".bandobutton").style.color = "black";
        document.querySelector(".bandobutton").style.backgroundColor = "white";

    }
</script>
<!--slick-->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">

    $('.communicate_about').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1500,
    });
</script>
<script type="text/javascript">

    $('.partner_general').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
    });
</script>

<script>
    var mySwiper = new Swiper('.swiper-container', {
        speed:1000,
        effect: 'fade',
        autoplay: {
            delay: 3000
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
</body>
</html>

