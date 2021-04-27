@extends('layouts.Frontend.base')
@section('title', 'Hỗ trợ')
@section('content')
    <main>
        <div class="container-page-sub">
            <div class="row">
                <div class="header-page-sub">
                    <div class="bg-page-sub" style="background-size: auto;height: auto;">HỖ TRỢ</div>

                </div>

                <div class="body-rent">
                    <div class="body-guide">
                        <section><p class="title-child-owner">Hướng dẫn thuê xe</p>
                            <div class="rental-process">
                                <div><img alt="Process" src="{{ asset('Frontend/assets/images/Group1390.png') }}" class="img-process"><img
                                        alt="Process" src="{{ asset('Frontend/assets/images/Group1391.png') }}" class="img-process"><img
                                        alt="Process" src="{{ asset('Frontend/assets/images/Group1392.png') }}" class="img-process"><img
                                        alt="Process" src="{{ asset('Frontend/assets/images/Group1393.png') }}" class="img-process"></div>
                                <div>
                                    <div class="line-process"></div>
                                    <div class="rental-process dot-line"><span class="dot dot1"></span><span
                                            class="dot dot2"></span><span class="dot dot3"></span><img alt="Complete"
                                                                                                       src="{{ asset('Frontend/assets/images/ic-complete.png') }}"
                                                                                                       class="dot dot4">
                                    </div>
                                </div>
                                <div>
                                    <div class="text-process"><span class="title-process">Tìm xe</span><span
                                            class="des-process">Truy cập website , lựa chọn thời gian &amp; địa điểm bạn cần thuê xe.</span>
                                    </div>
                                    <div class="text-process"><span class="title-process">Đặt xe</span><span
                                            class="des-process">Dựa trên hệ thống so sánh giá, lựa chọn chiếc xe ưng ý &amp; gửi yêu cầu về cho chúng tôi.</span>
                                    </div>
                                    <div class="text-process"><span class="title-process">Nhận xe</span><span
                                            class="des-process">Hoàn tất thủ tục thuê, nhận xe &amp; bắt đầu hành trình. Bạn có thể nhận xe tại nhà hoặc đại lí của chúng tôi.</span>
                                    </div>
                                    <div class="text-process"><span class="title-process">Trả xe</span><span
                                            class="des-process">Trả xe sau khi kết thúc hành trình. Chấm điểm dịch vụ để cải thiện chất lượng. </span>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

