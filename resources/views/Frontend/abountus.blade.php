@extends('layouts.Frontend.base')
@section('title', 'Về chúng tôi')
@section('content')

    <main>
        <div>
            <div class="container-page-sub">
                <div class="header-page-sub" >
                    <div class="bg-page-sub" style="background-size: auto;height: auto;">VỀ CHÚNG TÔI</div>
                </div>
                <div class="row about-company2">
                    <div class="col-lg-6 margin-info"> Chúng tôi là một Startup tiên phong trong việc phát triển nền tảng trực
                        tuyến cho thuê và chia sẻ xe tự lái ở Việt Nam. <br><br>Chúng tôi  cho phép khách hàng có nhu cầu thuê xe
                        tự lái (ô tô, xe máy) có thể kết nối với các đơn vị cho thuê xe cũng như cá nhân có xe nhàn rỗi trên
                        khắp cả nước thông qua website hoặc ứng dụng di động. Khách hàng có thể tìm kiếm, so sánh và thuê xe một
                        cách dễ dàng, nhanh chóng.<br><br>Chúng tôi  được ra đời với sứ mệnh mang đến nền tảng công nghệ hiện đại
                        cho phép việc thuê và chia sẻ xe một cách Nhanh chóng, An toàn và Tiết kiệm. Chúng tôi  hướng tới một cộng
                        đồng cho thuê và chia sẻ phương tiện đi lại một cách văn minh và thân thiện với môi trường.
                    </div>
                    <div class="col-lg-5 margin-info">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe title="About " frameborder="0"
                                    src="https://www.youtube.com/embed/bSPLLnOvPEs"></iframe>
                        </div>
                    </div>
                </div>
                <div class="body-about"><img src="{{ asset('Frontend/assets/images/pexels-photo.jpg') }}" alt=""
                                             class="img-body-about">
                    <div class="child-right"><p class="title-child-about"> Tại sao chúng tôi làm?</p>
                        <p class="text-why">- Hiện nay, ở Việt Nam chưa có một nền tảng trực tuyến cho thuê và chia sẻ xe máy, ô
                            tô tự lái. </p>
                        <p class="text-why">- Khách thuê xe gặp rất nhiều khó khăn để thuê được một chiếc xe tự lái như ý trong
                            khi cá nhân có xe nhàn rỗi hoặc các đơn vị cho thuê xe tự lái chưa có một công nghệ đủ tốt để quản
                            lý, tối ưu tài sản của mình.</p>
                        <p class="text-why">- Với sự bùng nổ của xu hướng công nghệ 4.0 thì các tiện ích của việc đặt dịch vụ
                            vận chuyển qua kênh online/ mobile cũng như công nghệ chia sẻ xe đang ngày càng phát triển và phổ
                            biến.</p>
                        <p class="text-why">- Chia sẻ phương tiện đang dần trở thành xu hướng chính trên thế giới thay thế cho
                            việc sở hữu xe.</p></div>
                </div>
                <div class="body-about">
                    <div class="child-right"><p class="title-child-about"> Phương thức hoạt động</p>
                        <p class="text-why">Ngay cả những vấn đề phức tạp nhất cũng có một giải pháp phù hợp để giải quyết. Tại
                            đây, chúng tôi không chỉ cho thuê xe, chúng tôi tạo ra những sản phẩm hoàn chỉnh trong hệ sinh
                            thái hiện có. Chúng tôi dựa trên công nghệ để cung cấp một giải pháp toàn diện cho vấn đề đi lại đô
                            thị bằng cách kết nối hành khách với các nhà cung cấp dịch vụ cho thuê xe tự lái. Tầm nhìn của chúng
                            tôi cung cấp một nền tảng mà chủ sở hữu xe có thể thu hút khách hàng và tiến hành
                            kinh doanh một cách thuận tiện. Chúng tôi tập trung nỗ lực vào việc đơn giản hóa quá trình thuê xe
                            bằng cách tạo ra các cơ chế có thể mở rộng để tiến hành và tạo thuận lợi cho các giao dịch trong khi
                            chứng minh một phương thức giao thông kinh tế cho tất cả mọi người.</p>
                    </div>
                    <img src="{{ asset('Frontend/assets/images/pexels-photo-862734.jpg') }}" alt=""
                         style="width: 40%; margin-left: 10%; height: 100%;">
                </div>
            </div>
        </div>
    </main>
@endsection

