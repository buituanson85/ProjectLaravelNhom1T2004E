<div style="margin:0;padding:0;background:#f0f0ef">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top:40px;padding-bottom:35px;background:url('http://sharetot.com/wp-content/uploads/2018/12/bgemail.jpg')">
        <tbody>
        <tr><td><div style="margin:0 auto;max-width:670px;width:100%;background:url('https://vcdn-startup.vnecdn.net/2018/09/28/screen-shot-2018-06-26-at-15-07-05-copy-1537765226_500x300.png') no-repeat #fff;height:10px"></div></td></tr>
        <tr>
            <td>
                <table align="center" style="width:100%;max-width:670px;text-align:center;padding-top:15px;background:#fff">
                    <tbody><tr>
                        <td>
                            <table style="width:100%;max-width:390px;margin:0 auto">
                                <tbody><tr>
                                    <td width="20%">
                                        <img src="https://vcdn-startup.vnecdn.net/2018/09/28/screen-shot-2018-06-26-at-15-07-05-copy-1537765226_500x300.png" alt="hocmai" class="CToWUd" width="100">
                                    </td>
                                    <td width="80%" style="text-align:center;font-family:Arial,sans-serif;vertical-align:bottom">
                                        <div style="color:#0072bc;font-size:12px;font-weight:bold">DỊCH VỤ CHO THUÊ XE TỰ LÁI</div>
                                        <div style="color:#000000;font-size:10px">Chungxe là một nền tảng kết nối các đơn vị cho thuê xe cũng như cá nhân có xe nhàn rỗi với khách hàng cho thuê xe tự lái trên nền tảng trực tuyến và di dộng.</div>
                                    </td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>

                    </tbody></table>
            </td>
        </tr>

        <tr>
            <td>
                <table style="width:100%;max-width:713px;border-collapse:collapse;margin:0 auto;text-align:center;line-height:32px;font-family:Arial,sans-serif;font-weight:bold">
                    <tbody><tr>
                        <td width="22" style="padding:0"><div style="width:22px;height:62px;"></div></td>
                        <td style="width:100%;max-width:760px;padding:0;vertical-align:bottom;background:#fff">
                            <table style="width:100%;border-collapse:collapse">

                                <tbody><tr><td style="font-size:18px;color:#fff;background:#f49321;padding:0;text-align:center;height:46px">SỐ ĐIỆN THOẠI: <a style="color:#fff" href="tel:090 450 9596" target="_blank">1900 636585 – 090 450 9596</a> </td>
                                </tr></tbody></table>
                        </td>
                        <td width="22" style="padding:0"><div style="width:22px;height:62px;"></div></td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>

        <tr>
            <td>
                <table align="center" style="width:100%;max-width:670px;background:#ffffff;padding-top:40px;padding-left:40px;padding-right:40px;padding-bottom:40px">
                    <tbody>
                    <tr>
                        <td style="color:#0a73b7;font-family:Arial,sans-serif;font-size:24px;text-align:center;font-weight:bold">THÔNG TIN ĐẶT LẠI ĐƠN HÀNG</td>
                    </tr>
                    <tr><td style="padding-bottom:30px;color:#f7a51c;font-family:Arial,sans-serif;font-size:18px;text-align:center;font-weight:bold;font-style:italic"></td>
                    </tr><tr>
                        <td style="padding:0 10px 20px 10px;color:#373636;font-family:Arial,sans-serif;font-size:16px;line-height:20px"><p>Xin chào {{ $products['name'] }}!</p><p>Cảm ơn bạn đã sử dụng dịch của chúng tôi! rất lấy làm tiếc vì đơn hàng trước không được thực hiện,chúng tôi đã đặt lại đơn hàng mới cho quý khách. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!!</p>
                            <br><br>THÔNG TIN KHÁCH HÀNG
                            </p>

                            <ul>
                                <li>Tên khách hàng: <b>{{ $products['name'] }}</b></li>
                                <li>Email: <b><a href="mailto:{{ $products['email'] }}">{{ $products['email'] }}</a></b></li>

                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 10px 20px 10px;color:#373636;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                            <br><br>THÔNG TIN PHƯƠNG TIỆN
                            </p>
                            <p style="color: red;font-size: 16px">{{ $products['date'] }}</p>
                            <ul>
                                <li>Tên phương tiện: <b>{{ $products['product_name'] }}</b></li>
                                <li>Ảnh phương tiện: <b><img width="100" href="{{asset($products['product_image']) }}" alt="Ảnh sản phẩm"/></b></li>
                                <li>Mã đơn hàng: <b>{{ $products['order_id'] }}</b></li>
                                <li>Hãng xe: <b>{{ $products['product_brand'] }}</b></li>
                                <li>Loại phương tiện: <b>{{ $products['product_category'] }}</b></li>
                                <li>Động cơ: <b>{{ $products['product_engine'] }}</b></li>
                                <li>Chỗ ngồi kiểu: <b>{{ $products['product_seat'] }}</b></li>
                                <li>Số lượng chở: <b>{{ $products['product_capacity'] }}</b></li>
                                <li>Loại Gear: <b>{{ $products['product_gear'] }}</b></li>
                                <li>Lượng tiêu thụ xăng: <b>{{ $products['product_consumption'] }}</b></li>
                                <li>Trạng thái đơn hàng: <b>{{ $products['product_status'] }}</b></li>
                                <li>Nơi nhận phương tiện: <b>{{ $products['product_district'] }}</b></li>
                                <li>Chủ xe: <b>{{ $products['product_partner']}}</b></li>
                            </ul>
                            <p>Nếu cần thêm thông tin, vui lòng
                                liên hệ Đường dây nóng <b style="color:#0000ff">1900 636585 – 090 450 9596</b> hoặc
                                truy cập <a href="https://chungxe.vn/support/car_rental" target="_blank" data-saferedirecturl="#">trang Hỗ
                                    trợ </a></p><p><i>Thân mến!</i></p><p>ChungxeFake</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
            </td></tr><tr>
            <td>
                <table align="center" style="width:100%;max-width:670px;background:#0072bc;padding-top:11px;padding-bottom:10px;border-bottom:1px solid #bbd9ed;border-top:1px solid #bbd9ed">
                    <tbody><tr>
                        <td width="105"></td>
                        <td width="60" style="color:#fff;font-size:14px;font-family:Arial,sans-serif">Theo
                            dõi:</td>
                        <td width="40" style="text-align:center">
                            <a href="#" target="_blank">
                                <img src="http://sharetot.com/wp-content/uploads/2018/12/unnamed.png">
                            </a>
                        </td>
                        <td width="40" style="text-align:center">
                            <a href="#" target="_blank">
                                <img src="http://sharetot.com/wp-content/uploads/2018/12/unnamed_youtube.png">
                            </a>
                        </td>
                        <td width="94"></td>
                        <td width="50" style="color:#fff;font-size:14px;font-family:Arial,sans-serif">Hỗ
                            trợ:</td>
                        <td width="40" style="text-align:center">
                            <a href="/ho-tro/" target="_blank" data-saferedirecturl="#">
                                <img src="http://sharetot.com/wp-content/uploads/2018/12/unnamed_hotro.png">
                            </a>
                        </td>
                        <td width="140"></td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%;max-width:670px;border-collapse:collapse;background:#0072bc;margin:0 auto">
                    <tbody><tr>
                        <td style="padding-top:15px">
                            <div style="width:100%;height:10px;background:url('http://sharetot.com/wp-content/uploads/2018/12/border-bottom-email.png') no-repeat"></div>
                        </td>
                    </tr>
                    </tbody></table>
            </td>
        </tr>


        </tbody>
    </table>
</div>



