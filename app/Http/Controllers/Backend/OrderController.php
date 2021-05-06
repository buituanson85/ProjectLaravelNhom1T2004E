<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Send_compled_order;
use App\Mail\Send_partner_accept_order;
use App\Mail\Send_Product_Order;
use App\Mail\Sendpendingconfirmorder;
use App\Models\Backend\HistoryMonney;
use App\Models\Backend\NoteOrder;
use App\Models\Backend\Product;
use App\Models\Backend\Wallet;
use App\Models\Frontend\OrderDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Frontend\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PDF;
use Session;

class OrderController extends Controller
{

    //hiển thị lịch sử đơn hàng
    public function index()
    {
        $orders = Order::where([
            ['status','!=','pending'],
            ['status','!=','accept'],
            ['status','!=','paid'],
            ['confirm','!=', 0]
        ])->orderBy('id','desc')->get();

        return view('Backend.orders.index')->with(['orders'=>$orders]);
    }
    //hiển thị danh sách các đơn hàng có trạng thái pending
    public function confirmOrders(){
        $orders = Order::where('status','pending')->orderBy('id','desc')->get();
        return view('Backend.orders.confirmorders')->with(['orders'=>$orders]);
    }

    public function showConfirmOrders($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::where('order_id',$get_order->id)->first();
        return view('Backend.orders.showconfirmorders')->with(['order'=>$order]);
    }

    public function updateConfirmOrders($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::where('order_id',$get_order->id)->first();
        $start_price = $order->product->price - 100000;
        $end_price = $order->product->price + 100000;
        $products = Product::where([
            ['id', '!=',$order->product->id],
            ['district_id','=',$order->product->district_id],
            ['category_id','=',$order->product->category_id],
            ['category_id','=',$order->product->category_id],
            ['status','ready'],
            ['confirm', 1],
            ['featured', 0]
        ])->whereBetween('price', [$start_price, $end_price])->orderBy('id','desc')->get();
        return view('Backend.orders.dathoxe',compact('products','order'));
    }
    //hiển thị danh sách các đơn hàng bị từ chối và hủy có confirm bằng 1
    public function ordersDeleteCancelled(){
        $orders = Order::where([
            ['status','!=','pending'],
            ['status','!=','accept'],
            ['status','!=','paid'],
            ['status','!=','completed'],
            ['confirm','!=', 1]
        ])->orderBy('id','desc')->get();
        return view('Backend.orders.orders-delete-cancelled')->with(['orders'=>$orders]);
    }

    public function orderConfirmOrder(Request $request,$id){
        $order = Order::where('order_id', $id)->first();
        $order->confirm = 1;
        $order->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.show-orders-delete-cancelled')->with(['order'=>$order_details]);
    }

    public function acceptDeleteCancelled(Request $request,$id){
        $order = Order::where('order_id', $id)->first();
        $order->confirm = 1;
        $order->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        $request->session()->flash('success', 'Xác nhận thành công!');
        return redirect()->back();
//        return view('Backend.orders.orders-delete-cancelled')->with(['order'=>$order_details]);
    }

    public function partnerOrders(){
        $orders = null;
        $get_orders = Order::all();
        $array_id = [];
        foreach ($get_orders as $order) {
            if ($order->orderdetails->product->partner_id == Auth::user()->id) {
                $array_id[] = $order->id;
            }
        }

        $orders = Order::where([
            ['status','!=','cancelled'],
            ['status','!=','delete'],
            ['status','!=','completed']
        ])->findMany($array_id);
        return view('Backend.orders.partnerorders')->with(['orders'=>$orders]);
    }

    public function partnerOrdersShow($id){
        $get_order = Order::where('order_id','like', $id)->first();
//        dd($get_order->id);
        $order = OrderDetails::where('order_id',$get_order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order]);
    }

    public function historyOrderPartner(){
        $orders = null;
        $get_orders = Order::all();
        $array_id = [];
        foreach ($get_orders as $order) {
            if ($order->orderdetails->product->partner_id == Auth::user()->id) {
                $array_id[] = $order->id;
            }
        }

        $orders = Order::where([
            ['status','!=','pending'],
            ['status','!=','accept'],
            ['status','!=','paid']
        ])->orderBy('id','desc')->findMany($array_id);
        return view('Backend.orders.historyorderpartner')->with(['orders'=>$orders]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $new_order = new Order();
        $request->validate([
            //
        ]);
        if ( $request->payment_id == 1){
            $new_order->order_id = Str::random(10);
            $new_order->customer_id = Auth::user()->id;
            $new_order->payment_id = $request->payment_id;
            $new_order->price_total = $request->price_total;

            $new_order->status = "pending";

            $new_order->save();

            $new_order_detail = new OrderDetails();
            $new_order_detail->order_id = $new_order->id;
            $new_order_detail-> product_id = $request->product_id;
            $new_order_detail-> note = $request->note;
            $new_order_detail->product_price_total = $new_order->price_total;
            $new_order_detail->product_received_date = $request->product_receive_date;
            $new_order_detail->product_pay_date = $request->product_pay_date;
            $new_order_detail->payments = $request->receive_Method;
            $new_order_detail->quantity = $request->quantity;

            $product = Product::find($request->product_id);
            $partner_id = User::find($product->partner_id);

            $new_order_detail->save();

            $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            $email = Auth::user()->email;
            $name = Auth::user()->name;
            $date = "Date: ".''.$now;
            $products = [
                'email'=>$email,
                'name' => $name,
                'date' => $date,
                'order_id'=>$new_order->order_id,
                'price_total'=> $new_order->price_total,
                'product_name'=>$product->name,
                'product_image'=>$product->image,
                'product_engine'=>$product->engine,
                'product_seat'=>$product->seat,
                'product_capacity'=>$product->capacity,
                'product_range'=>$product->range,
                'product_gear'=>$product->gear,
                'product_consumption'=>$product->consumption,
                'product_status'=>'pending',
                'product_district'=>$product->district->name,
                'product_brand'=>$product->brand->name,
                'product_category'=>$product->category->name,
                'product_partner'=>$partner_id->name
            ];

            Mail::to($email)->send(new Send_Product_Order($products));


            $request->session()->flash('success','Bạn đã thuê xe thành công!!!');
//            return redirect(route('Frontend.hoanthanh'))->with(['new_order'=>$new_order,'new_order_detail',$new_order_detail]);
            return view('Frontend.hoanthanh',compact('new_order','new_order_detail'));
        }else{

            //giản 5% cho đơn hàng online
            $total = $request->price_total;
            $price_total = $total - 0.05*$total;
            //card
            $cart = Session::get('cart');
            $cart[] = array(
                'price_total' => $price_total,
                'product_id' => $request->product_id,
                'note' => $request->note,
                'product_received_date' => $request->product_receive_date,
                'product_pay_date' => $request->product_pay_date,
                'quantity' => $request->quantity,
                'receive_method' => $request->receive_Method
            );
            Session::put('cart',$cart);
            return view('Frontend.vnpay.index',compact('price_total'));
        }
    }

    public function show($id)
    {
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::where('order_id',$get_order->id)->first();

        return view('Backend.orders.show')->with(['order'=>$order]);
    }

    public function showOrdersDeleteCancelled($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::where('order_id',$get_order->id)->first();
        return view('Backend.orders.show-orders-delete-cancelled')->with(['order'=>$order]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function acceptOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();

        $order->status = 'accept';
        $product = Product::find($order->orderdetails->product->id);

        $product->quantity = $product->quantity - $order->orderdetails->quantity;
        if ($product->category_id == 2){
            if ($product->quantity < 0){
                $request->session()->flash('error', 'Số lượng xe không đủ!');
                return redirect()->back();
            }elseif ($product->quantity == 0){
                $product->status = "unready";
            }
        }else{
            if ($product->status == 'unready'){
                $request->session()->flash('error', 'Xe đã nhận chuyến hoặc đang trong chuyến!');
                return redirect()->back();
            }
            $product->status = "unready";
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $name = $order->user->name;
        $email = $order->user->email;
        $date = "Date: ".''.$now;
        $orders = [
            'name' => $name,
            'ma' => $order->order_id,
            'date' => $date,
            'partner' => $order->orderdetails->product->user->name,
            'phone' =>$order->orderdetails->product->user->phone,
            'address'=>$order->orderdetails->product->user->address,
            'email'=>$order->orderdetails->product->user->email
        ];

        Mail::to($email)->send(new Send_partner_accept_order($orders));

        $product->save();
        $order->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function paidOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'paid';
        $order->confirm = 1;
        //tat hien thi phuong tien
        $product = Product::find($order->orderdetails->product->id);

        if($product->category_id == 1){
            $product->status = "unready";
        }else{
            if ($product->quantity == 0){
                $product->status = "unready";
            }
        }

        //tru tien vi
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();

        $monney =  0.05*$order->price_total;
        $total = $wallet->monney - $monney;
        if ($order->payment_id == 1){
            //trừ tài khoản ví.
            $wallet->monney = $total;
            $wallet->note = "Trừ 5% đơn hơn hàng - ".$order->order_id;
            $wallet->save();

            //thêm vào lịch sử giao dịch
            $history = new HistoryMonney();
            $history->trading_code = Str::random(8);
            $history->send_monney = $monney;
            $history->note = $wallet->note;
            $history->wallet_id = $wallet->id;
            $history->status = "accept";
            $history->save();
        }else{
            //trừ tài khoản ví.
            $wallet->monney = $total;
            $wallet->monney_confirm = $order->price_total;
            $wallet->note = "Trừ 5% đơn hơn hàng - ".$order->order_id;
            $wallet->save();

            //thêm vào lịch sử giao dịch
            $history = new HistoryMonney();
            $history->trading_code = Str::random(8);
            $history->send_monney = $monney;
            $history->note = $wallet->note;
            $history->wallet_id = $wallet->id;
            $history->status = "accept";
            $history->save();
        }

        $order->save();
        $product->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function completedOrder(Request $request,$id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'completed';

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $name = $order->user->name;
        $email = $order->user->email;
        $date = "Date: ".''.$now;
        $orders = [
            'name' => $name,
            'ma' => $order->order_id,
            'date' => $date
        ];

        //tat hien thi phuong tien
        $product = Product::find($order->orderdetails->product->id);

        $product->quantity = $product->quantity + $order->orderdetails->quantity;

        $product->status = "ready";
        Mail::to($email)->send(new Send_compled_order($orders));

        $product->save();
        $order->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function refuseOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'cancelled';
        $order->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function deletedOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'delete';

        //tat hien thi phuong tien
        $product = Product::find($order->orderdetails->product->id);
        $product->quantity = $product->quantity + $order->orderdetails->quantity;

        $product->status = "ready";
        $product->save();
        $order->save();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function printOrder($order_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_details($order_id));
        return $pdf->stream();
    }
    public function print_order_details($order_id){
        $order = Order::where('order_id', $order_id)->first();
        $order_details = OrderDetails::where('order_id',$order->id)->first();
        $payment_method = null;
        if($order->payment_id == 1){
            $payment_method = "Tiền mặt";
        }else{
            $payment_method = "Online";
        }
        $output = '';
        $output .= '<style>
            body{
                font-family: "DejaVu Sans";
            }

        </style>';
        $output .= '
        <div style="text-align: center">
            <h3>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h3>
            <h3>Độc lập – Tự do – Hạnh phúc</h3>
            <h5>--------------------------------</h5>
            <h1>HỢP ĐỒNG THUÊ XE</h1>
        </div>
        <div style="text-align: justify; margin: 20px">
        <p><i>Hôm nay, ngày '.date("d/m/Y",strtotime($order_details->product_received_date)).', chúng tôi gồm:  </i></p>
            <h4><b>BÊN CHO THUÊ</b> (sau đây gọi là Bên A) </h4>
            <p>
                Ông/Bà: <b>' . $order_details->product->user->name . ' </b> <br/>
                Sinh năm: ................. <br/>
                CMND/CCCD/Hộ chiếu số: ............................. do ................ cấp ngày ....................<br/>
                Hộ khẩu thường trú tại: ' . $order_details->product->user->address . '<br/>
            </p>
            <h4><b>BÊN THUÊ</b> (sau đây gọi là Bên B) </h4>
            <p>
                Ông/Bà: <b>' . $order->user->name . ' </b><br/>
                Sinh năm: ................. <br/>
                CMND/CCCD/Hộ chiếu số: ............................. do ................ cấp ngày ....................<br/>
                Hộ khẩu thường trú tại: '.$order->user->address .'<br/>
            </p>
            <p><i>Hai bên đã thỏa thuận và thống nhất ký kết Hợp đồng thuê '. $order_details->product->category->name.' với những điều khoản cụ thể như sau:</i></p>
            <h4>Điều 1. Đặc điểm và thỏa thuận thuê xe</h4>
            <p>
                Bằng hợp đồng này, Bên A đồng ý cho Bên B thuê và bên B đồng ý thuê '. $order_details->product->category->name.'  có đặc điểm sau đây:<br/>
                Tên xe      : '. $order_details->product->name.'. Nhãn hiệu: '. $order_details->product->brand->name.' <br/>
                Loại xe           : '. $order_details->product->range.' <br/>
                Số máy           : ...........................Số khung: ..................<br/>
                Số chỗ ngồi   : '. $order_details->product->seat.'      Đăng ký xe có giá trị đến ngày: .................<br/>
                Xe ô tô có biển số ....... theo giấy đăng ký ô tô số ............ do ........... cấp ngày .......... đăng ký lần đầu ngày ............. được mang tên..............
                 tại địa chỉ: ..............................................................<br/>
                Giấy chứng nhận kiểm định số ............. do Trung tâm đăng kiểm xe cơ giới số ............. Cục đăng kiểm Việt Nam cấp ngày ...............<br/>
                - Bên A cam đoan trước khi ký bản Hợp đồng này, xe ô tô nêu trên:<br/>
                 + Không có tranh chấp về quyền sở hữu/sử dụng;<br/>
                 + Không bị ràng buộc bởi bất kỳ Hợp đồng thuê xe ô tô nào đang có hiệu lực.<br/>
                - Bên B cam đoan: Bên B được cấp giấy phép lái xe hạng ....số ........... có giá trị đến ngày ............ (nếu bên B với tư cách cá nhân)<br/>
            </p>
            <h4>Điều 2. Thời hạn thuê xe ô tô</h4>
            <p>Thời hạn thuê là '.
            $total_day = (strtotime($order_details->product_pay_date) - strtotime($order_details->product_received_date))/86400 + 1
            .' ngày kể từ ngày '.$order_details->product_received_date.'</p>
            <h4>Điều 3. Mục đích thuê</h4>
            <h4>Điều 4: Giá thuê và phương thức thanh toán</h4>
            <p>1. Giá thuê tài sản nêu trên là: '. number_format($order_details->product->price, 0).' VNĐ/ngày. <br/>
            <p>2. Tổng giá trị hợp đồng: '. number_format($order_details->product->price * ((strtotime($order_details->product_pay_date) - strtotime($order_details->product_received_date))/86400 + 1), 0).' VNĐ. <br/>
            (Bằng chữ: ................................................................................. đồng).</p>
            <p>3. Phương thức thanh toán: Thanh toán bằng: '.$payment_method.'</p> <br/>
            <h4>Điều 5: Phương thức giao, trả lại tài sản thuê</h4>
            <h4>Điều 6: Nghĩa vụ và quyền của Bên A</h4>
            <h4>Điều 7: Nghĩa vụ và quyền của Bên B</h4>
            <h4>Điều 8: Cam đoan của các bên</h4>
            <h4>Điều 9: Điều khoản cuối cùng</h4>
            <div style="width: 50%; float: left; text-align: center"><b>Bên A</b> <br/> <i>(Kí ghi rõ họ tên)</i></div>
            <div style="width: 50%; float: left; text-align: center"><b>Bên B</b> <br/> <i>(Kí ghi rõ họ tên)</i></div>
        </div>
        ';
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $order = Order::find($id);
        $order_detail = OrderDetails::where('order_id', $id)->first();
        $orderdetails = OrderDetails::find($order_detail->id);

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $name = $orderdetails->product->user->name;
        $email = $orderdetails->product->user->email;
        $date = "Date: ".''.$now;
        $orders = [
            'name' => $name,
            'date' => $date,
            'order' => $order->order_id,
            'order_time' =>$order->created_at,
            'product_name'=>$orderdetails->product->name
        ];

        Mail::to($email)->send(new Sendpendingconfirmorder($orders));
        $product = Product::find($orderdetails->product_id);
        $product->featured = 1;
        $product->save();
        $order->status = 'delete';
        //lưu lịch sử xóa
        $noteorder = new NoteOrder();
        $noteorder->note = "Tài xế không nhận chuyến";
        $noteorder->order_id = $order->id;
        $noteorder->partner_id = $product->partner_id;
        $order->save();
        $noteorder->save();
        $request->session()->flash('error', 'Xóa Đơn hàng thành công!');
        return redirect(route('dashboards-orders.index'));
    }

    public function refuseOrders(Request $request){
        $noteorder = new NoteOrder();

        if ($request->exampleRadios == "1"){
            $noteorder->note = "Không liên hệ được khách hàng để đàm phán.";
        }elseif ($request->exampleRadios == "2"){
            $noteorder->note = "Khách yêu cầu từ chối.";
        }elseif ($request->exampleRadios == "3"){
            $noteorder->note = "Không có khả năng thực hiện.";
        }else{
            $noteorder->note = $request->note;
        }
        $noteorder->order_id = $request->order_id;
        $noteorder->partner_id = Auth::user()->id;

        $order = Order::find($request->order_id);
//        $order->confirm = 1;
        $order->status = 'cancelled';
        $noteorder->save();
        $order->save();

        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function deleteOrders(Request $request){
        $noteorder = new NoteOrder();

        if ($request->exampleRadios == "1"){
            $noteorder->note = "Không liên hệ lại được khách hàng để đàm phán.";
        }elseif ($request->exampleRadios == "2"){
            $noteorder->note = "Khách yêu cầu hủy.";
        }elseif ($request->exampleRadios == "3"){
            $noteorder->note = "Nghi vấn lừa đảo.";
        }elseif ($request->exampleRadios == "4"){
            $noteorder->note = "Không có khả năng thực hiện.";
        }else{
            $noteorder->note = $request->note_delete;
        }
        $noteorder->order_id = $request->order_id;
        $noteorder->partner_id = Auth::user()->id;

        $order = Order::find($request->order_id);

//        $order->confirm = 1;
        $order->status = 'delete';

        //tat hien thi phuong tien
        $product = Product::find($order->orderdetails->product->id);
        $product->quantity = $product->quantity + $order->orderdetails->quantity;

        $product->status = "ready";
        $product->save();
        $noteorder->save();
        $order->save();

        $order_details = OrderDetails::where('order_id',$order->id)->first();
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function paymentOnline(Request $request){
        $vnp_TxnRef = Str::random(10);
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = str_replace(',', '', $request->amount) * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('pages.vnpayreturn'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASH_SECRET')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', env('VNP_HASH_SECRET') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function paymentVnpay(Request $request){
        $cart = Session::get('cart');
        foreach($cart as $key => $val){
            $price_total = $val['price_total'];
            $product_id = $val['product_id'];
            $note = $val['note'];
            $product_received_date = $val['product_received_date'];
            $product_pay_date = $val['product_pay_date'];
            $quantity = $val['quantity'];
            $receive_method = $val['receive_method'];
        }
        $new_order = new Order();

        $new_order->order_id = Str::random(10);
        $new_order->customer_id = Auth::user()->id;
        $new_order->payment_id = 2;
        $new_order->price_total = $price_total;

        $new_order->status = "pending";

        $new_order->save();

        $new_order_detail = new OrderDetails();
        $new_order_detail->order_id = $new_order->id;
        $new_order_detail-> product_id = $product_id;
        $new_order_detail-> note = $note;
        $new_order_detail->product_price_total = $price_total;
        $new_order_detail->product_received_date = $product_received_date;
        $new_order_detail->product_pay_date = $product_pay_date;
        $new_order_detail->payments = $receive_method;
        $new_order_detail->quantity = $quantity;

        $product = Product::find($product_id);
        $partner_id = User::find($product->partner_id);

        $new_order_detail->save();

        $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $date = "Date: ".''.$now;
        $products = [
            'email'=>$email,
            'name' => $name,
            'date' => $date,
            'order_id'=>$new_order->order_id,
            'price_total'=> $new_order->price_total,
            'product_name'=>$product->name,
            'product_image'=>$product->image,
            'product_engine'=>$product->engine,
            'product_seat'=>$product->seat,
            'product_capacity'=>$product->capacity,
            'product_range'=>$product->range,
            'product_gear'=>$product->gear,
            'product_consumption'=>$product->consumption,
            'product_status'=>'pending',
            'product_district'=>$product->district->name,
            'product_brand'=>$product->brand->name,
            'product_category'=>$product->category->name,
            'product_partner'=>$partner_id->name
        ];

        Mail::to($email)->send(new Send_Product_Order($products));

        //insert vnpay

        $vnpay_data = $request->all();
        $vnpays = [
            'p_transaction_id' => 2,
            'p_trasaction_code' => $vnpay_data['vnp_TxnRef'],
            'p_user_id' => \Auth::user()->id,
            'p_money' => $price_total,
            'p_note' => $vnpay_data['vnp_OrderInfo'],
            'p_vnp_response_code' => $vnpay_data['vnp_ResponseCode'],
            'p_code_vnpay' => $vnpay_data['vnp_TransactionNo'],
            'p_code_bank' => $vnpay_data['vnp_BankCode'],
            'p_time' => date('Y-m-d H:i' , strtotime($vnpay_data['vnp_PayDate']))
        ];
        DB::table('payment')->insert($vnpays);
        Session::forget('cart');
        $request->session()->flash('success','Bạn đã thuê xe thành công!!!');
        return view('Frontend.vnpay.hoanthanh',compact('new_order','new_order_detail'));
    }
}
