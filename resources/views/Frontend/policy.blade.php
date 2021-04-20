@extends('layouts.Frontend.base')
@section('content')
    <main>
        <div class="partner-form">
            <div>
                <div class="container-page-sub">
                    <div class="header-page-sub">
                        <div class="bg-page-sub" style="background-size: auto;height: auto;background-image: url('{{ asset('Frontend/assets/images/about.b5988b9a.jpg') }}')">TRỞ THÀNH ĐỐI TÁC</div>

                    </div>
                    <div class="row about-company2">
                        <div class="des-company" style="width: 100%; padding-right: 3%;"><p>Công ty cổ phần Chung xe xin
                                gửi
                                lời chào trân trọng tới các Đối tác,</p><br>
                            <p> Chungxe là một nền tảng kết nối các đơn vị cho thuê xe cũng như cá nhân có xe nhàn rỗi
                                với
                                khách hàng cho thuê xe tự lái trên nền tảng trực tuyến và di dộng. Khách hàng có thể dễ
                                dàng
                                tìm kiếm, so sánh giá, thuê xe và thanh toán một cách thuận lợi và tiết kiệm chi
                                phí. </p>
                        </div>
                    </div>
                    <div class="body-about"><img src="{{ asset('Frontend/assets/images/pexels-photo-862734.jpg') }}" alt=""
                                                 class="img-partner1">
                        <div class="child-right"><p class="title-child-about">Lợi ích khi cộng tác với chúng tôi </p>
                            <ul style="list-style-type: square;">
                                <li class="text-why" style="margin-left: 30px;">Tiếp cận được với một lượng lớn khách
                                    hàng
                                    có nhu cầu thuê xe tự lái qua nền tảng của chúng tôi, là một kênh bán hàng hiệu quả
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Không mất chi phí quảng cáo và nhân sự
                                    để
                                    duy trì website, fanpage..
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Không mất chi phí đăng ký và duy trì khi
                                    tham gia hợp tác
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Chỉ tính phí khi có giao dịch thành công
                                    (phí hoa hồng)
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Có công cụ quản lý xe và khách hàng một
                                    cách
                                    hiệu quả
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Được hỗ trợ chạy các chương trình khuyến
                                    mãi
                                    riêng dùng mã khuyến mãi và coupon.
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Chủ động trong việc đưa xe, giá, thủ tục
                                    lên
                                    hệ thống
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Nắm được thông tin, lịch sử giao dịch
                                    của
                                    khách hàng và có toàn quyền trong việc quyết định cho thuê hay không
                                </li>
                                <li class="text-why" style="margin-left: 30px;">Được giới thiệu trong các chương trình
                                    truyền thông và tiếp thị của Chungxe
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="body-about">
                        <div style="width: 100%;"><p class="title-child-about"
                                                     style="text-align: center; margin-bottom: 20px;"> Đề xuất hợp
                                tác </p>
                            <div class="row margin-info">
                                <div class="col-lg-4">
                                    <div class="card height-dxht"><img alt="Proposals"
                                                                       src="{{ asset('Frontend/assets/images/icon1-slide.png') }}"
                                                                       class="card-img-top icon-partner">
                                        <div class="card-body"><p class="card-text margin-info">Chúng tôi có thế mạnh về
                                                tập
                                                khách hàng du lịch và đi công tác đến từ Hà nội và TP Hồ Chí Minh và các
                                                địa
                                                điểm du lịch trong cả nước (Nha Trang, Phú Quốc, Đà Nẵng, Hội An…) cũng
                                                như
                                                tập khách hàng nước ngoài cần đặt trước dịch vụ.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card height-dxht" style="min-height: 315px"><img alt="Proposals"
                                                                       src="{{ asset('Frontend/assets/images/icon2-slide.png') }}"
                                                                       class="card-img-top icon-partner">
                                        <div class="card-body"><p class="card-text margin-info">Chúng tôi sẽ đóng vai trò
                                                một
                                                đại lý cung cấp khách đến từ kênh trực tuyến cho đơn vị thuê xe để bổ
                                                xung
                                                kênh bán hàng hiện tại.</p></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card height-dxht" style="min-height: 315px"><img alt="Proposals"
                                                                       src="{{ asset('Frontend/assets/images/icon3-slide.png') }}"
                                                                       class="card-img-top icon-partner">
                                        <div class="card-body"><p class="card-text margin-info">Đơn vị cho thuê xe sẽ
                                                trả
                                                phí giới thiệu khách hàng cho chúng tôi dựa trên các giao dịch thành công
                                                (Phí
                                                hoa hồng).</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-about">
                        <div style="width: 100%;"><p class="title-child-about"
                                                     style="text-align: center; margin-bottom: 20px;">Quy trình hợp
                                tác</p>
                            <div style="width: 100%;">
                                <div class="grid-container">
                                    <div class=""><p> 01</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule1.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Đối tác cung cấp thông tin về các loại xe, giá, thủ tục</div>
                                    </div>
                                    <div class=""><p> 02</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule2.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Hai bên ký hợp đồng hợp tác</div>
                                    </div>
                                    <div class=""><p> 03</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule3.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Cấp tài khoản cho đối tác để nhận booking</div>
                                    </div>
                                    <div class=""><p> 04</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule4.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Khi có khách đặt xe, thông tin sẽ được đẩy vào Email/ tài
                                            khoản
                                            cho Đối tác
                                        </div>
                                    </div>
                                    <div class=""><p> 08</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule8.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Cuối tháng hai bên đối soát và thanh toán dựa trên các giao
                                            dịch
                                            thành công
                                        </div>
                                    </div>
                                    <div class=""><p> 07</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule7.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Sau mỗi chuyến đi, khách hàng sẽ cung cấp đánh giá về trải
                                            nghiệm
                                            dịch vụ
                                        </div>
                                    </div>
                                    <div class=""><p> 06</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule6.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Đối tác làm việc với khách hàng để chốt hợp đồng, thủ tục,
                                            địa
                                            điểm và thời gian nhận
                                        </div>
                                    </div>
                                    <div class=""><p> 05</p><img alt="Rule" src="{{ asset('Frontend/assets/images/rule5.png') }}"
                                                                 class="item4-img">
                                        <div class="item4">Đối tác đảm bảo có xe để phục vụ khách hàng</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-5"><a class="btn" href="#" target="_blank">Chính
                                    sách cho đối tác vận chuyển</a></div>
                        </div>
                    </div>
                    <div class="body-about">
                        <div class="partner-form-container">
                            <div class="row">
                                <div class="col-md-12 text-center"><p class="title-child-about"
                                                                      style="text-align: center;">
                                        Đăng ký làm đối tác</p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form form-content">
                                        <div class="form-group" style="width: 410px;"><p
                                                class="title-ip-register form-input">Tên đơn vị/chủ xe *</p><input
                                                class="name input-tabs form-control" id="name" placeholder="Nhập tên đơn vị/chủ xe ..." type="text"
                                                value=""></div>
                                        <div class="form-group" style="width: 410px;"><p class="title-ip-register"> Số
                                                điện
                                                thoại * </p><input class="phone input-tabs form-control"
                                                                   placeholder="Nhập số điện thoại ..."
                                                                   type="text" pattern="[0-9]*" value=""></div>
                                        <div class="form-group" style="width: 410px;"><p class="title-ip-register">
                                                Email
                                                * </p><input class="email input-tabs form-control" placeholder="Nhập địa chỉ email ..."
                                                             type="email" value=""></div>
                                        <div class="form-group" style="width: 410px;"><p class="title-ip-register"> Địa
                                                chỉ </p>
                                            <div><input autocomplete="off" role="combobox" aria-autocomplete="list"
                                                        aria-expanded="false" placeholder="Nhập địa chỉ ..." type="text"
                                                        class="address input-tabs form-control" value="">
                                                <div class="autocomplete-dropdown-container wborder"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" style="width: 410px;"><p class="title-ip-register"> Tiêu
                                                đề </p><input class="input-tabs" placeholder="Nhập tiêu đề ..."
                                                              type="text"
                                                              value=""></div>
                                        <div class="form-group" style="width: 410px;"><p class="title-ip-register"> Nội
                                                dung</p><textarea class="input-tabs" placeholder="Nhập nội dung ..."
                                                                  type="text" rows="5"></textarea></div>
                                        <div class="form-error is-visible form-group"></div>
                                        <div class="form-group" style="width: 410px; text-align: center;">
                                            <div class="btn-disabled partner-button">Đăng ký</div>
                                        </div>
                                        <div class="form-group" style="text-align: center; margin-bottom: 24px;"><a
                                                href="/">
                                                <div class="btn_back partner-back">Quay lại trang chủ</div>
                                            </a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
