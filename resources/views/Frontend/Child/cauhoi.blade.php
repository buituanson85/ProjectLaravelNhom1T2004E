@extends('layouts.Frontend.base')
@section('title', 'Hỗ trợ')
@section('content')
    <style>
        .question {
            /*padding-top: 77px;*/
            /*margin-top: 77px;*/
            font-family: montserrat, sans-serif;
        }

        .step, .title-child-owner {
            font-style: normal;
            font-stretch: normal;
            letter-spacing: normal;
            font-family: montserrat;
        }

        .title-child-owner {
            font-size: 30px;
            font-weight: 500;
            line-height: 2;
            text-align: center;
            color: #107d82;
        }

        .wrapper {
            display: grid;
            grid-template-columns:repeat(3, 1fr);
            grid-gap: 10px;
            /*margin-top: 32px*/
        }


        .item-answer, .item-question {
            width: auto;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .16);
            background-color: #fff;
            font-family: montserrat, sans-serif;
            font-size: 14px;
            font-weight: 400;
            font-style: normal;
            font-stretch: normal;
            line-height: 1.71;
            letter-spacing: normal;
            color: #000;
            vertical-align: middle
        }

        .item-answer {
            min-height: 90px;
            height: auto;
            padding: 10px 15px;
            border-radius: 0 0 8px 8px;
            border: 2px solid #dcdcdc;
            border-top: 0 solid #dcdcdc;
            text-align: justify
        }

        .item-question-display {
            width: auto;
            height: 90px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .16);
            background-color: #107d82;
            border: solid #dcdcdc;
            border-width: 2px 2px 0;
            font-family: montserrat, sans-serif;
            font-size: 14px;
            font-weight: 400;
            font-style: normal;
            font-stretch: normal;
            line-height: 1.71;
            letter-spacing: normal;
            text-align: left;
            color: #fff;
            vertical-align: middle;
            text-align: justify
        }

        .text-question {
            float: left;
            vertical-align: middle;
            width: 100%;
            height: auto;
            margin: auto;
            padding: 0 0 0 15px
        }



    </style>
    <main>
        <div class="container-page-sub">
            <div class="row">
                <div class="header-page-sub">
                    <div class="bg-page-sub" style="background-size: auto;height: auto;">HỖ TRỢ</div>

                </div>

                <div class="body-rent">
                    <div class="body-guide">
{{--                        <section><p class="title-child-owner">Hướng dẫn thuê xe</p>--}}
{{--                            <div class="rental-process">--}}
{{--                                <div><img alt="Process" src="{{ asset('Frontend/assets/images/Group1390.png') }}"--}}
{{--                                          class="img-process"><img--}}
{{--                                        alt="Process" src="{{ asset('Frontend/assets/images/Group1391.png') }}"--}}
{{--                                        class="img-process"><img--}}
{{--                                        alt="Process" src="{{ asset('Frontend/assets/images/Group1392.png') }}"--}}
{{--                                        class="img-process"><img--}}
{{--                                        alt="Process" src="{{ asset('Frontend/assets/images/Group1393.png') }}"--}}
{{--                                        class="img-process"></div>--}}
{{--                                <div>--}}
{{--                                    <div class="line-process"></div>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <div class="text-process"><span class="title-process">Tìm xe</span><span--}}
{{--                                            class="des-process">Truy cập website , lựa chọn thời gian &amp; địa điểm bạn cần thuê xe.</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-process"><span class="title-process">Đặt xe</span><span--}}
{{--                                            class="des-process">Dựa trên hệ thống so sánh giá, lựa chọn chiếc xe ưng ý &amp; gửi yêu cầu về cho chúng tôi.</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-process"><span class="title-process">Nhận xe</span><span--}}
{{--                                            class="des-process">Hoàn tất thủ tục thuê, nhận xe &amp; bắt đầu hành trình. Bạn có thể nhận xe tại nhà hoặc đại lí của chúng tôi.</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-process"><span class="title-process">Trả xe</span><span--}}
{{--                                            class="des-process">Trả xe sau khi kết thúc hành trình. Chấm điểm dịch vụ để cải thiện chất lượng. </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </section>--}}
                        <section><p class="title-child-owner question" style="text-align: center; font-size: 30px">Các câu hỏi
                                thường gặp</p></section>
                        <section>

                            <div class="wrapper">
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Tôi cần chuẩn bị những gì để thuê một chiếc xe máy?</span>
                                        </div>
                                    </div>
                                    <div class="item-answer"><span>Chứng minh thư nhân dân (bản gốc); Giấy phép lái xe (bản gốc và bản sao); Hộ chiếu (passport) nếu là người nước ngoài; Tiền đặt cọc từ 3.000.000đ trở lên tùy loại xe.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Tôi cần chuẩn bị những gì để thuê một chiếc xe ô tô tự lái?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Hộ khẩu hoặc KT3 (sổ tạm trú dài hạn), chứng minh thư nhân dân ( bản gốc hoặc bản sao), xe gắn máy kèm giấy đăng ký xe. Đặt cọc xe máy hoặc tiền mặt có trị giá từ 20.000.000đ trở lên tùy từng loại xe.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Tôi có thể đăng ký thuê xe cho người khác không?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Bạn có thể đứng tên hợp đồng để thuê cho người thân hoặc bạn bè. Tùy từng nhà xe sẽ yêu cầu bạn bổ sung thêm 1 số giấy tờ phù hợp để đứng tên hợp đồng cho thuê xe.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span
                                                class="text-question">Tôi cần lưu ý gì khi nhận xe?</span></div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Kiểm tra kĩ giấy tờ của xe xem còn hạn hay không. Mang đầy đủ giấy tờ, đặc biệt là Bằng lái xe, và Chứng minh nhân dân.
Đọc kỹ biên bản bàn giao xe như xem có vết trầy xước nào không, vạch xăng thực tế khi bàn giao</span></div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Khi gặp sự cố trên đường tôi phải làm gì?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Bạn nên gọi điện cho Hotline (1900 636 585 - 0903 229 906) của Chungxe đồng thời liên lạc trực tiếp cho nhà xe để thông báo và thống nhất cách sửa chữa và thanh toán chi phí dựa trên thỏa thuận của hai bên.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Giá thuê xe gồm những gì, có phụ phí gì phải lưu ý không?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Giá thuê xe sẽ được tính kết hợp theo ngày và theo giờ. Nếu bạn trả xe muộn hơn giờ trong thỏa thuận, tùy từng nhà xe sẽ có mức tính phí phát sinh dựa trên số giờ quá hạn hoặc theo số kilomet vượt quá. Giá thuê xe dịp lễ tết hoặc cuối tuần thường cao hơn so với ngày thường.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Làm thế nào để đặt xe trên Chungxe</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Bạn có thể đặt xe qua email, điện thoại hoặc đăng ký ngay trên trang web Chungxe.vn.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Chungxe cho thuê những loại xe nào?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Chúng tôi có nhiều dòng cả xe máy và ô tô để phù hợp với nhu cầu của khách hàng cả thuê ngắn và dài ngày như Xe ô tô 4-5 chỗ, 7 chỗ, 9 chỗ; Xe máy tay ga, xe số, xe côn.</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Tôi có thể thanh toán bằng những hình thức nào?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Thanh toán chuyển khoản, phí chuyển khoản sẽ do khách hàng chi trả. Thanh toán tiền mặt. Thanh toán thẻ tín dụng</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Nếu hủy đặt xe tôi có phải chịu phí phạt không?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Bạn hoàn toàn không phải chịu phí phạt nào vì huỷ cọc trước thời điểm thực hiện hợp đồng thuê xe ( không áp dụng thuê xe trong ngày lễ, tết,…).</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="item-question-display">
                                        <div class="div-text-question"><span class="text-question">Xe có mới không? Chất lượng xe có tốt không?</span>
                                        </div>
                                        <div><img role="presentation"
                                                  src="{{asset('Frontend/assets/images/Group1259.png')}}"
                                                  alt="Question"
                                                  class="icon-right-question" style="cursor: pointer;"></div>
                                    </div>
                                    <div class="item-answer"><span>Chungxe cung cấp các dòng xe mới và được đăng kiểm đăng ký, bảo trì bảo dưỡng theo định kỳ.</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

                <div class="body-rent">


                </div>
            </div>

        </div>

    </main>
@endsection


