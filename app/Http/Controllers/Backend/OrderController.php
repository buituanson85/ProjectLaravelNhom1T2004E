<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Send_Product_Order;
use App\Mail\Sendpendingconfirmorder;
use App\Models\Backend\NoteOrder;
use App\Models\Backend\Product;
use App\Models\Frontend\OrderDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Frontend\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where([
            ['status','!=','pending'],
            ['status','!=','accept'],
            ['status','!=','paid'],
            ['confirm','!=', 0]
        ])->get();
//        $orders = null;
//        $get_orders = Order::all();
//
//        if (Auth::user()->roles->where('id', 1)->first() != null) {
//            $orders = Order::all();
//        } else {
//            $array_id = [];
//            foreach ($get_orders as $order) {
//                if ($order->orderdetails->product->partner_id == Auth::user()->id) {
//                    $array_id[] = $order->id;
//                }
//            }
//
//            $orders = Order::findMany($array_id);
////        }

        return view('Backend.orders.index')->with(['orders'=>$orders]);
    }
    public function confirmOrders(){
        $orders = Order::where('status','pending')->get();
        return view('Backend.orders.confirmorders')->with(['orders'=>$orders]);
    }

    public function ordersDeleteCancelled(){
        $orders = Order::where([
            ['status','!=','pending'],
            ['status','!=','accept'],
            ['status','!=','paid'],
            ['confirm','!=', 1]
        ])->get();
        return view('Backend.orders.orders-delete-cancelled')->with(['orders'=>$orders]);
    }

    public function orderConfirmOrder(Request $request,$id){
        $order = Order::where('order_id', $id)->first();
        $order->confirm = 0;
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.show-orders-delete-cancelled')->with(['order'=>$order_details]);
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
//        $orders = Order::where('status','pending')->orwhere('status','accept')->orwhere('status','paid')->get();
        return view('Backend.orders.partnerorders')->with(['orders'=>$orders]);
    }

    public function partnerOrdersShow($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::find($get_order->id);
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
        ])->findMany($array_id);
//        $orders = Order::where('status','pending')->orwhere('status','accept')->orwhere('status','paid')->get();
        return view('Backend.orders.historyorderpartner')->with(['orders'=>$orders]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_order = new Order();
        $request->validate([
            //
        ]);
        $new_order->order_id = rand(1,100000000);
        $new_order->customer_id = Auth::user()->id;
        $new_order->payment_id = $request->payment_id;
        $new_order->price_total = $request->price_total;
        $new_order->status = "pending";


        $new_order->save();

        $new_order_detail = new OrderDetails();
        $new_order_detail->order_id = $new_order->id;
        $new_order_detail-> product_id = $request->product_id;
        $new_order_detail->product_price_total = $new_order->price_total;
        $new_order_detail->product_received_date = $request->product_receive_date;
        $new_order_detail->product_pay_date = $request->product_pay_date;

        $product = Product::find($request->product_id);
        $partner_id = User::find($product->partner_id);

        $new_order_detail->save();

        $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = 'nguyenduykhuong696@gmail.com';
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
        return view('Frontend.info-customer',compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::find($get_order->id);
//        $this->authorize('view', $order);

//        $product = $order->product();
//        dd($product);
        return view('Backend.orders.show')->with(['order'=>$order]);
    }

    public function showOrdersDeleteCancelled($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::find($get_order->id);
        return view('Backend.orders.show-orders-delete-cancelled')->with(['order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function acceptOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'accept';
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function paidOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'paid';
        $order->confirm = 1;
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function refuseOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'cancelled';
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function deletedOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'delete';
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function printOrder($order_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_details($order_id));
        return $pdf->stream();
    }
    public function print_order_details($order_id){
        $order = Order::where('order_id', $order_id)->first();
        $order_details = OrderDetails::find($order->id);
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

        $order_details = OrderDetails::find($order->id);
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
        $noteorder->save();
        $order->save();

        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }

    public function completedOrder(Request $request,$id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'completed';
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.partnerordersshow')->with(['order'=>$order_details]);
    }
}
