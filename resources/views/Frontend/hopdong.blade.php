@extends('layouts.Frontend.base')
@section('title', 'Hợp đồng cho thuê')
@section('content')
<div class="mhd">
    <div class="container">
        <div class="mhd_content">
            <div class="mhd_content_left ">
                <div class="mhd_content_left_general">
                    <div class="mhd_content_left_form">
                        <h2>Mẫu hợp đồng cho thuê xe tự lái</h2>
                        <span>
                            <a href="">kinh nghiệm thuê xe ô tô tự lái</a>
                            <a href=""><i class="fas fa-user"></i> Hong Do</a>
                            <a href="">24/8/2018</a>
                        </span>
                        <hr>
                        <div style="font-family: 'Times New Roman';font-size: 20px">
                            <p style="color: #f0506e;font-style: italic">
                                Nội dung mẫu hợp đồng cho thuê xe tự lái nêu rõ thông tin của bên thuê xe, bên cho thuê xe, đối tượng hợp đồng, quyền và nghĩa vụ của các bên và các nội dung khác liên quan. Hãy cùng
                                <a href="" style="color: black;font-weight: 600">Chungxe</a> tham khảo chi tiết và tải về mẫu hợp đồng cho thuê xe tự lái nhé. Bên cạnh đó, nếu bạn muốn thuê xe tự lái nhanh chóng, dễ dàng nhất có thể điền trực tiếp vào mẫu sau :
                            </p>
                            <p style="text-align: center;font-weight: bold;padding-top: 40px">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</p>
                            <p style="text-align: center;font-weight: bold">Độc lập – Tự do- Hạnh phúc</p>
                            <p style="text-align: center;font-weight: bold">HỢP ĐỒNG THUÊ XE ÔTÔ TỰ LÁI</p>
                            <p style="text-align: center;font-weight: bold">Số: …………</p>
                            <ul>
                                <li>Căn cứ Luật thương mại năm 2005 và Bộ luật dân sự năm 2005 được Quốc hội nước Cộng hoà xã hội chủ nghĩa Việt Nam thông qua ngày 14 tháng 06 năm 2005</li>
                                <li>Căn cứ vào khả năng và nhu cầu của hai bên</li><br>
                                Hôm nay, ngày….. tháng …….. năm …….., tại ..………, hai bên chúng tôi gồm:
                            </ul>

                            <p style="font-weight: bold">Bên cho thuê (Bên A):  </p>
                            <span style="display: flex">
                                <ul>
                                    <li>Người đại diện :</li>
                                    <li>Địa chỉ :</li>
                                    <li>Điện thoại :</li>
                                    <li>Mã số thuế:</li>
                                    <li>Tài khoản số :</li>
                                </ul>
                                <p style="padding-left: 200px"> – Chức vụ:</p>
                            </span>

                            <p style="font-weight: bold">Bên thuê xe (Bên B) :   </p>
                            <span style="display: flex">
                                <ul>
                                    <li>Người đại diện :</li>
                                    <li>Địa chỉ :</li>
                                    <li>Điện thoại :</li>
                                    <li>Mã số thuế:</li>
                                    <li>Tài khoản số :</li>
                                </ul>
                                <p style="padding-left: 200px"> – Chức vụ:</p>
                            </span>
                            <p>    Sau khi bàn bạc thống nhất, cả hai bên cùng đồng ý các điều kiện và điều khoản được quy định trong hợp đồng như sau:</p>
                            <div id="noidung">
                                <p style="font-weight: bold;padding-top: 40px">ĐIỀU 1: NỘI DUNG CÔNG VIỆC</p>
                                <ul>
                                    <li>Bên A đồng ý cho bên B thuê xe ô tô theo hình thức tự lái. Xe ôtô Bên A đảm bảo là xe mới, chất lượng tốt, toàn bộ máy, bản táp lô điện và các linh kiện khác đều được dán tem bảo đảm.</li>
                                    <li>Thời gian thuê xe: Từ ngày …………………..đến hết ngày  ……………..</li>
                                    <li>Địa điểm giao nhận xe:</li>
                                </ul>
                            </div>
                            <div id="giathue">
                                <p style="font-weight: bold">ĐIỀU 2: GIÁ THÀNH</p>
                                <p>2.1.  Giá thuê :</p>
                                <ul>
                                    <li>Đơn giá thuê: …..………đ/ngày (chưa bao gồm VAT)</li>
                                    <li>Khống chế: ……………km/ngày</li>
                                    <li>Phụ trội khi vượt số km:….………..đ/km</li>
                                </ul>
                                <p>2.2.  Thời gian thuê:</p>
                                <ul>
                                    <li>Từ …………giờ, ngày…………………….</li>
                                    <li>Đến………..giờ, ngày: ………………….</li>
                                    <li>Phụ trội: …………đ/giờ</li>
                                </ul>
                                <p>2.3.   Phí cầu phà, bến bãi, lưu đêm, xăng xe, ăn ở lái xe, tiền phạt vi phạm luật giao thông do bên B tự chịu chi trả.</p>
                            </div>
                            <div id="phuongthuc">
                                <p style="font-weight: bold">ĐIỀU 3: PHƯƠNG THỨC THANH TOÁN</p>
                                <ul>
                                    <li>Bên A giao xe và toàn bộ giấy tờ xe cho bên B và ngay khi hợp đồng được ký kết.</li>
                                    <li>Bên B ứng trước 100% tiền thuê xe cho bên A ngay sau khi hợp đồng này được ký kết.</li>
                                </ul>
                            </div>
                            <div id="nghiavu">
                                <p style="font-weight: bold">ĐIỀU 4: NGHĨA VỤ CỦA CÁC BÊN</p>
                                <p style="font-weight: bold">Bên A:  </p>
                                <ul>
                                    <li>Đảm bảo đúng loại xe, chất lượng xe và đầy đủ giấy tờ theo quy định của pháp luật. Xe hoạt động bình thường , có đầy đủ các chi tiết máy, có 01 lớp sơ cua, kích nâng xe, đồ tháo lốp.</li>
                                    <li>Giao xe đúng thời gian theo lịch của bên B yêu cầu.</li>
                                    <li>Chịu trách nhiệm pháp lý về nguồn gốc và quyền sở hữu của xe.</li>
                                </ul>
                                <p style="font-weight: bold">Bên B:  </p>
                                <ul>
                                    <li>Kiểm tra trước khi nhận và rửa xe trước khi trả.</li>
                                    <li>Luôn để ý đồng hồ báo nhiệt, báo dầu…nếu có sự cố phải dừng xe và báo ngay cho bên A. Nếu cố tình sử dụng khi nhiệt độ tăng hoặc dầu hết dẫn đến hỏng máy, bên B hoàn toàn chịu trách nhiệm.</li>
                                    <li>Không được bóc tem bảo đảm hay tự ý sửa chữa bất cứ chi tiết nào của xe.</li>
                                    <li>Mọi sự cố như : mất, bẹp, nứt…bất kì chi tiết nào của xe, bên B phải chịu mua đồ hãng thay thế, không chấp nhận gò hàn.</li>
                                    <li>Mọi hỏng hóc (do bên B gây ra) tuỳ thuộc vào mức độ và vị trí của xe bên B phải bồi thường cho bên A, giá trị bồi thường được xác định bởi chuyên viên kĩ thuật của hãng. Sau khi sữa chữa giá trị của xe giảm đi (vì không còn nguyên vẹn) bên B phải đền bù chênh lệch đó.</li>
                                    <li>Mỗi ngày xe nghỉ để sữa chữa hay vì lí do nào khác mà xe không hoạt động kinh doanh được (do lỗi bên B) thì bên B phải chịu trả tiền cho bên A với số tiền như đang thuê xe sử dụng bình thường.</li>
                                    <li>Tất cả các bồi thường trên không liên quan đến việc bên A làm bảo hiểm.</li>
                                    <li>Khi bên B vi phạm luật giao thông dẫn đến bị bắt xe hoặc giấy tờ xe thì vẫn phải thanh toán tiền thuê xe cho đến khi lấy được xe, giấy tờ xe. Nếu có phát sinh bất cứ chi phí nào tại thời điểm bên B thuê xe, bên B vẫn phải chịu chi phí đó mặc dù hợp đồng đã thanh lý. Bên A sẽ căn cứ vào giờ đi và ngày đi trong hợp đồng đã ký cùng với giấy phạt nguội làm bằng chứng để giải quyết sai phạm.</li>
                                    <li>Thanh toán tiền theo đúng thời hạn thoả thuận.</li>
                                    <li>Chịu tất cả các chi phí phát sinh ngoài thoả thuận trong hợp đồng.</li>
                                </ul>

                            </div>
                            <div id="dieukhoan">
                                <p style="font-weight: bold;">ĐIỀU 5: ĐIỀU KHOẢN CỤ THỂ</p>
                                <p style="font-weight: bold;">1. Nghiêm cấm bên B:</p>
                                <ul>
                                    <li>Cấm sử dụng chiếc xe thuê đi cầm cố hay thế chấp.</li>
                                    <li>Cấm sử dụng chiếc xe thuê vào những mục đích phi pháp như đua xe, vận chuyển hàng hoá trái phép (ma tuý, vũ khí, hàng lậu và những đối tượng trốn tránh pháp luật).</li>
                                    <li>Cấm cho thuê lại xe hoặc giao xe cho đơn vị khác sử dụng dưới hình thức nào.</li>
                                </ul>
                                <p style="font-weight: bold;">2. Bên A có quyền:</p>
                                <ul>
                                    <li>Báo cho cơ quan công an khi bên B cố tình không liên lạc với bên A.</li>
                                    <li>Huỷ bỏ hợp đồng, nếu thấy khả năng lái xe của người thuê xe không đảm bảo an toàn giao thông.</li>
                                </ul>
                            </div>
                            <div id="camket">
                                <p style="font-weight: bold">ĐIỀU 6: CAM KẾT THỰC HIỆN VÀ GIẢI QUYẾT TRANH CHẤP</p>
                                <ul>
                                    <li>Hai bên nghiêm chỉnh thực hiện các điều khoản của hợp đồng này. Trong trường hợp có sự thay đổi, phải thông báo cho nhau bằng văn bản báo trước 03 ngày trước ngày dự kiến khởi hành. Nếu bên nào không thực hiện, gây thiệt hại cho bên kia, phải bồi thường 50% tổng giá trị của chuyến xe chạy đó.</li>
                                    <li>Mọi phát sinh trong quá trình thực hiện hợp đồng, hai bên sẽ cùng nhau trực tiếp thương lượng giải quyết bằng các phụ lục hợp đồng.</li>
                                    <li>Nếu không thoả thuận đựợc thì các bên có quyền yêu cầu toà án có thẩm quyền giải quyết.</li>
                                </ul>
                            </div>
                            <div id="thihanh">
                                <p style="font-weight: bold">ĐIỀU 7: ĐIỀU KHOẢN THI HÀNH</p>
                                <ul>
                                    <li>Hợp đồng này có hiệu lực thi hành kể từ ngày ký.</li>
                                    <li>Nếu sau thời hạn của hợp đồng 15 ngày mà hai bên không có tranh chấp, thì hợp đồng này mặc nhiên được thanh lý.</li>
                                    <li>Hợp đồng này được lập thành 02 bản, mỗi bên giữ 01 bản có giá trị pháp lý như nhau.</li>
                                </ul>
                                <span style="display: flex">
                                    <p style="font-weight: bold; padding-left: 120px">Đại diện bên A</p>
                                    <p style="font-weight: bold;padding-left: 150px">Đại diện bên B</p>
                                </span>
                            </div>
                            <p style="font-weight: bold">Công ty CP Chung Xe</p>
                            <p>Hà Nội: Tầng 5, 166 Phố Huế, Hai Bà Trưng</p>
                            <p>Đà Nẵng: Tầng 3, 31 Trần Phú, Hải Châu</p>
                            <p>Hồ Chí Minh: Tầng 3, 292/15 Cách Mạng Tháng Tám, Phường 10, Quận 3</p>
                            <p style="font-weight: bold">4 cách thuê xe tại Chungxe :</p>
                            <ol type="1">
                                <li>Đặt tại website <a href="http://chungxe.vn">http://chungxe.vn</a></li>
                                <li>Inbox Fanpage <a href="Chungxe.vn">Chungxe.vn</a></li>
                                <li>Gửi email đến contact@chungxe.vn</li>
                                <li>Gọi số 1900.636.585 (Giờ hành chính)</li>
                            </ol>
                            <a href="" style="color: red;font-style: italic">
                                Xem thêm
                            </a>
                            <br>
                            <br>
                            <p>Điểm danh 10 địa điểm du lịch không thể bỏ qua khi tới Hà Nội</p>
                            <p>Thuê xe tự lái TPHCM đa dạng loại xe – Thuê ngay!</p>
                            <p style="color: #000080">Thuê xe ô tô tự lái Hà Nội – Thủ tục nhanh chóng, giá rẻ bất ngờ</p>
                        </div>
                    </div>
                </div>

                <div class="mhd_content_note">
                    <div class="mhd_content_note_form">
                        <span>https://www.chungxe.vn</span>
                        <br><br>
                        Công ty CP Chung Xe <br>
                        Hà Nội: Tầng 5, 166 Phố Huế, Hai Bà Trưng <br>
                        Đà Nẵng: Tầng 3, 31 Trần Phú, Hải Châu <br>
                        Hồ Chí Minh: 23 Phùng Khắc Khoan, Q1 <br><br>
                        <p style="font-weight: bold">4 cách thuê xe tại Chungxe :</p>
                        <ul>
                            <li>đặt tại website https://chungxe.vn</li>
                            <li> inbox Fanpage chungxe.vn</li>
                            <li> gửi email đến</li>
                            <li> Gọi số (Giờ hành chính)</li>
                        </ul>
                    </div>

                </div>
                <div class="mhd_content_news">
                    <span style="font-size: 30px">Tin liên quan</span>
                    <br><br>
                    <div class="row">
                        <div class="col-4" style="width: 100%;height: 200px">
                            <a href="" style="color: black">
                                <img src="{{ asset('Frontend/assets/images/news1.jpg') }}" style="max-width: 100%;max-height: 100%" alt="">
                                <p> 6 lưu ý khi lái xe ở thành phố với người mới</a></p>
                            </a>
                        </div>
                        <div class="col-4" style="width: 100%;height: 200px">
                            <a href="" style="color: black">
                                <img src="{{ asset('Frontend/assets/images/news2.jpg') }}" style="max-width: 100%;max-height: 100%" alt="">
                                <p>Thuê xe tự lái Mitsubishi Xpander chỉ từ 500k, giá tốt cho dân Việt</p>

                            </a>
                        </div>
                        <div class="col-4" style="width: 100%;height: 200px">
                            <a href="" style="color: black">
                                <img src="{{ asset('Frontend/assets/images/news3.jpg') }}" style="max-width: 100%;max-height: 100%" alt="">
                                <p> 6 lưu ý khi lái xe ở thành phố với người mới</a></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--                mục lục-->

            <div class="mhd_content_right">
                <div class="mhd_content_right_general">
                    <div class="mhd_content_right_form">
                        <span style="font-size: 25px">Mục Lục Bài Viết</span><br><br>
                        <p ><a href="#noidung" style=" color: black;font-size: 17px">ĐIỀU 1: NỘI DUNG CÔNG VIỆC</a></p>
                        <p ><a href="#giathue" style=" color: black;font-size: 17px">ĐIỀU 2: GIÁ THÀNH</a></p>
                        <p ><a href="#phuongthuc" style=" color: black;font-size: 17px">ĐIỀU 3: PHƯƠNG THỨC THANH TOÁN</a></p>
                        <p ><a href="#nghiavu" style=" color: black;font-size: 17px">ĐIỀU 4: NGHĨA VỤ CỦA CÁC BÊN</a></p>
                        <p ><a href="#dieukhoan" style=" color: black;font-size: 17px">ĐIỀU 5: ĐIỀU KHOẢN CỤ THỂ</a></p>
                        <p ><a href="#camket" style=" color: black;font-size: 17px">ĐIỀU 6: CAM KẾT THỰC HIỆN VÀ GIẢI QUYẾT TRANH CHẤP</a></p>
                        <p ><a href="#thihanh" style=" color: black;font-size: 17px">ĐIỀU 7: ĐIỀU KHOẢN THI HÀNH</a></p>
                        <p>Chia sẻ
                            <a href="" style="padding-left: 10px; color: #151515"><i class="fab fa-facebook-f"></i></a>
                            <a href="" style="padding-left: 10px; color: #151515"><i class="fas fa-envelope"></i></a>
                            <a href="" style="padding-left: 10px; color: #151515"><i class="fab fa-youtube"></i></a>
                            <a href="" style="padding-left: 10px; color: #151515"><i class="fab fa-instagram"></i></a>


                        </p>
                    </div>

                </div>
                <div class="mhd_content_right_news">
                    <div class="mhd_content_right_news_form">
                        <button class="btn btn-primary">Tin mới</button>
                        <hr>
                        <div class="right_news" style="text-align: center">
                            <a href="" style="text-decoration: none;color: black; ">
                                <img src="{{ asset('Frontend/assets/images/news1.jpg') }}" style="max-height: 100%;max-width: 100%;border-radius: 10px" alt="">
                                <p> Thuê xe tự lái Mitsubishi Xpander chỉ từ 500k, giá tốt cho dân Việt</p>
                            </a>
                            <hr>
                            <a href="" style="text-decoration: none;color: black">
                                <img src="{{ asset('Frontend/assets/images/news2.jpg') }}" style="max-width: 100%" alt="">
                                <br><br><p > Thuê xe tự lái Mitsubishi Xpander chỉ từ 500k, giá tốt cho dân Việt</p>
                            </a>
                            <hr>
                            <a href="" style="text-decoration: none;color: black">
                                <img src="{{ asset('Frontend/assets/images/news3.jpg') }}" style="max-height: 100%;max-width: 100%" alt="">
                                <p > Thuê xe tự lái Mitsubishi Xpander chỉ từ 500k, giá tốt cho dân Việt</p>
                            </a>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

