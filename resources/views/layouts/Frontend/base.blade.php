<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
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
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/camnang.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/end.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/policy.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/mauhopdong.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/policy_incident.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/policy_insurance.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/pilicy_service.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/info-customer.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/lichsuthuexe.css') }}">
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
                <a href="{{ route('pages.registerpartners') }}">Tr??? th??nh d???i t??c</a>
            </div>
        </div>
        <div class="nav-list-right">
            <ul class="nav-list-right-1">
                <li><a href="{{ route('pages.abountus') }}" class="the_a">V??? ch??ng t??i</a></li>
                <li><a href="{{ route('pages.tutorial') }}" class="the_a" >H??? tr???</a></li>
                <li><a href="{{ route('pages.promotion') }}" class="the_a">Khuy???n m??i</a></li>
                <li>
                    @if(Route::has('login'))
                        @auth()
                            @if(Auth::user()->utype === 'ADM' || Auth::user()->utype === 'PTR')
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
                                    <a class="dropdown-item the_a" href="{{ route('pages.lichsuthuexe') }}">L???ch s??? thu?? xe</a>
                                    <a class="dropdown-item the_a" href="{{ route('pages.customerprofiles') }}">Th??ng tin c?? nh??n</a>
                                    <a class="dropdown-item the_a" href="{{ route('pages.doimatkhau') }}">?????i m???t kh???u</a>
                                    <a class="dropdown-item the_a" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">????ng xu???t</a>
                                    <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                        @csrf
                                    </form>
                                </div>
                            @endif
                </li>
                @else
                    <li>
                        <a class="the_a" href="{{ route('login') }}">????ng nh???p</a>
                    </li>
                    <li>
                        <a class="the_a" href="{{ route('register') }}">????ng k??</a>
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
            <p>Li??n h???</p>
            <p>C??ng ty CP Chung Xe</p>
            <p>H?? N???i: T???ng 5, 166 Ph??? Hu???, Hai B?? Tr??ng <br>
                ???? N???ng: T???ng 3, 31 Tr???n Ph??, H???i Ch??u <br>
                H??? Ch?? Minh: 23 Ph??ng Kh???c Khoan, Q1</p>
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
            <p>Gi???i thi???u</p>
            <p><a href="{{ route('pages.abountus') }}" class="the_a_two">V??? ch??ng t??i</a></p>
            <p style="font-size: 20px;font-weight: 600;text-transform: uppercase"> Ch???ng nh???n</p>
            <img src="{{ asset('Frontend/assets/images/bocongthuong.png') }}" style="width: 150px;height: 60px" alt="">
        </div>
        <div class="over-part">
            <p>Ch??nh s??ch</p>
            <p><a href="{{ route('pages.baomat') }}" class="the_a_two">Ch??nh s??ch b???o m???t th??ng tin</a></p>
            <p><a href="{{ route('pages.service') }}" class="the_a_two">Quy ch??? ho???t ?????ng</a></p>
            <p><a href="{{ route('pages.khieunai') }}" class="the_a_two">S??? c??? v?? khi???u n???i</a></p>
            <p><a href="{{ route('pages.hoanhuy') }}" class="the_a_two">Ch??nh s??ch v?? ho??n hu???</a></p>
        </div>
        <div class="over-part">
            <p>H??? tr???</p>
            <p><a href="{{ route('pages.tutorial') }}" class="the_a_two">H?????ng d???n thu?? xe</a></p>
            <p><a href="{{ route('pages.hopdong') }}" class="the_a_two">H???p ?????ng thu?? xe t??? l??i</a></p>
            <p><a href="{{ route('pages.camnang') }}" class="the_a_two">C???m nang thu?? xe t??? l??i</a></p>
            <p><a href="{{ route('pages.cauhoi') }}" class="the_a_two">C??u h???i th?????ng g???p</a></p>
            {{--            <p><a href="">Chung xe blog</a></p>--}}
        </div>
    </div>

    {{--    <div></div>--}}
    {{--    <div class="form_checkbox" id="form_checkbox_car">--}}
    {{--        <div class="form_checkbox_general">--}}
    {{--            <button value="car" onclick="car()" class="form_checkbox_general_car"><i class="fas fa-car"></i> ?? t??   </button>--}}
    {{--            <button value="motor" onclick="motor()" class="form_checkbox_general_motor"> <i class="fas fa-motorcycle"></i> Xe m??y</button>--}}
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
<script src="{{ asset('Frontend/assets/js/notify.min.js') }}"></script>
<script type="text/javascript">

</script>
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

