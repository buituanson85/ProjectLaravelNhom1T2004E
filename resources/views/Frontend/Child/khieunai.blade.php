@extends('layouts.Frontend.base')
@section('title', 'Sự cố và khiếu nại')
@section('content')
    <div class="bg">
        <div class="bg-content">
            <p style="text-align: center;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%); color: whitesmoke;font-size: 25px">SỰ CỐ VÀ KHIẾU NẠI</p>
        </div>
    </div>
    <div class="policy_content">
        <div class="policy_content_incident">
            <div class="policy_content_incident_first">
                <p>Cơ chế giải quyết khiếu nại liên quan đến việc thông tin cá nhân của khách hàng:</p>
                <ol>
                    <li>Chungxe sẽ là đơn vị trung gian đứng ra tiếp nhận khiếu nại của người của khách hàng. Khi phát hiện sự vi phạm, người khách thuê xe, chủ xe có thể gửi khiếu nại về cho Chungxe. Chungxe sẽ xem xét và hỗ trợ cùng với đứng ra làm việc trực tiếp với cơ quan nhà nước có thẩm quyền, hỗ trợ cung cấp các thông tin cần thiết phục vụ cho việc khiếu nại.</li>
                    <li>Trong trường hợp hệ thống thông tin bị tấn công làm phát sinh nguy cơ mất thông tin của người tiêu dùng, Chungxe sẽ thông báo cho cơ quan chức năng trong vòng 24 (hai mươi bốn) giờ sau khi phát hiện sự cố.</li>
                </ol>

            </div>
            <div class="policy_content_incident_first">
                <h3 style="color: cadetblue">Sự cố và khiếu nại</h3><br>
                <p>Công ty và Chủ xe có trách nhiệm tiếp nhận các khiếu nại và hỗ trợ Khách hàng liên quan đến các giao dịch được kết nối thông qua Sàn giao dịch. Các khiếu nại liên quan đến việc cung cấp, sử dụng dịch vụ thuê xe trên Sàn giao dịch do Công ty chịu trách nhiệm độc lập giải quyết trên cơ sở quy định của pháp luật, Điều khoản và Điều kiện sử dụng dịch vụ, các thông báo, quy chế đã công bố với Thành viên (Khách hàng và Chủ xe). Khi phát sinh tranh chấp, Công ty đề cao giải pháp thương lượng, hòa giải giữa các bên nhằm duy trì sự tin cậy của Thành viên vào chất lượng dịch vụ của Sàn giao dịch. Khách hàng có thể thực hiện theo các bước sau:</p>
                <p style="font-weight: bold">Bước 1:</p>
                <p>Khách hàng khiếu nại về dịch vụ qua số điện thoại 1900 636 585 hoặc 0903 229 906 hoặc gửi mail cho Bộ phận Chăm sóc Khách hàng tại địa chỉ contact@chungxe.vn. Thời gian để Công ty tiếp nhận khiếu nại là 3 ngày kể từ ngày sử dụng dịch vụ hoặc từ ngày phát sinh sự việc.</p>
                <p style="font-weight: bold">Bước 2:</p>
                <p>Trong thời hạn (3) ngày làm việc kể từ khi tiếp nhận thông tin khiếu nại của Khách hàng, Bộ phận Chăm sóc Khách hàng xác nhận thông tin khiếu nại, tiến hành phân loại thông tin và thông báo cho Khách hàng:</p>

                <div style="padding-left: 30px">
                    <p>2a. Ghi nhận các yêu cầu và các khiếu nại có liên quan đến Công ty và trong thời hạn khiếu nại.</p>
                    <p>2b. Từ chối các yêu cầu, các khiếu nại không có liên quan đến Công ty và hết thời hạn khiếu nại.</p>
                </div>
                <p style="font-weight: bold">Bước 3: Giải quyết vấn đề:</p>
                <p>Bộ phận Chăm sóc Khách hàng sẽ tiến hành xác minh, kiểm chứng và phân tích tính chất và mức độ của nội dung khiếu nại, phạm vi khiếu nại và trách nhiệm xử lý để phối hợp với Chủ xe và Bên cung cấp dịch vụ thứ 3 đưa ra biện pháp cụ thể để hỗ trợ Khách hàng giải quyết tranh chấp đó.</p>
                <div style="padding-left: 30px">
                    <p>3a. Chuyển các vấn đề có liên quan trực tiếp đến Công ty cho các Bộ phận có liên quan kiểm tra và đối chiếu.</p>
                    <p>3b. Chuyển các vấn đề có liên quan cho Chủ xe giải quyết.</p>
                </div>
                <p>Trong thời hạn ba (3) ngày làm việc kể từ khi tiếp nhận thông báo về khiếu nại, Chủ xe có trách nhiệm phối hợp với Chungxe để giải quyết, xử lý khiếu nại. Chủ xe sẽ thông báo cho Khách hàng biện pháp xử lý hoặc ủy quyền thông báo cho Công ty.</p>
                <p style="font-weight: bold">Bước 4: Đóng khiếu nại</p>
                <div style="padding-left: 30px">
                    <p>4a. Khách hàng đồng ý với các phản hồi của Bộ phận Chăm sóc Khách hàng -> Kết thúc khiếu nại. Khách hàng không đồng ý -> Quay lại bước 3</p>
                    <p>4b. Theo dõi các giải quyết khiếu nại của Chủ xe -> Kết thúc khiếu nại khi Khách hàng và Chủ xe đã thỏa thuận xong.</p>
                </div>
                <p>Khi nhận được thông báo về biện pháp xử lý từ Chủ xe nhưng Khách hàng không đồng ý thì Công ty sẽ chủ trì việc thương lượng, hòa giải giữa Khách hàng và Chủ xe để đi đến kết quả giải quyết phù hợp với cả hai bên. Trong trường hợp Khách hàng và Chủ xe không đi đến thỏa thuận chung hoặc Khách hàng không đồng ý với những biện pháp giải quyết cuối cùng của Chủ xe và/hoặc nằm ngoài khả năng và thẩm quyền của Công ty thì Khách hàng hoặc Chủ xe có thể nhờ đến Cơ quan Nhà nước có thẩm quyền can thiệp và giải quyết theo Pháp luật nhằm đảm bảo lợi ích hợp pháp của các bên.</p>
                <p>Công ty tôn trọng và nghiêm túc thực hiện các quy định của Pháp luật về Bảo vệ quyền lợi của người dùng. Công ty khuyến nghị Khách hàng và Chủ xe cung cấp chính xác, trung thực, chi tiết các thông tin cá nhân và nội dung đăng tin liên quan đến dịch vụ. Chúng tôi cũng đề nghị Chủ xe cần nghiêm túc tuân thủ các quy định của Pháp luật, cũng như có những hành vi phù hợp đối với Khách hàng. Mọi hành vi lừa đảo, gian lận trong kinh doanh, gây tổn hại đến người khác đều bị lên án và phải chịu hoàn toàn trách nhiệm trước Pháp luật. Các bên bao gồm Khách hàng và Chủ xe sẽ phải có trách nhiệm tích cực trong việc giải quyết khiếu nại. Chủ xe cần có trách nhiệm chủ động xử lý và cung cấp văn bản giấy tờ chứng thực thông tin liên quan đến sự việc đang có khiếu nại, tranh chấp với Khách hàng. Công ty chỉ đóng vai trò hỗ trợ, phối hợp việc thương lượng, hòa giải và giải quyết khiếu nại giữ Khách hàng và Chủ xe. Công ty cũng có trách nhiệm cung cấp những thông tin liên quan đến Khách hàng và Chủ xe nếu được Chủ xe hoặc Khách hàng hoặc Cơ quan Pháp luật có thẩm quyền yêu cầu.</p>
                <p>Sau khi Khách hàng và Chủ xe đã giải quyết xong tranh chấp, cần có trách nhiệm báo lại cho Công ty để cập nhật tình hình. Trong trường hợp giao dịch phát sinh mâu thuẫn mà lỗi thuộc về Chủ xe: Công ty sẽ áp dụng các biện pháp xử lý vi phạm tương ứng bao gồm nhưng không giới hạn: cảnh cáo, khóa tài khoản hoặc chuyển cho Cơ quan Pháp luật có thẩm quyền tùy theo mức độ của sai phạm. Công ty sẽ chấm dứt và gỡ bỏ toàn bộ tin bài về sản phẩm, dịch vụ của Chủ xe đó trên Sàn giao dịch đồng thời yêu cầu Chủ xe bồi hoàn cho Khách hàng thỏa đáng trên cơ sở thỏa thuận với Khách hàng.</p>
            </div>

        </div>
    </div>
@endsection
