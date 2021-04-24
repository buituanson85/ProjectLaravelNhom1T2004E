<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Frontend\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Frontend\Order;
use Illuminate\Support\Facades\Auth;
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
        $orders = null;
        $get_orders = Order::all();

        if (Auth::user()->roles->where('id', 1)->first() != null) {
            $orders = Order::all();
        } else {
            $array_id = [];
            foreach ($get_orders as $order) {
                if ($order->orderdetails->product->partner_id == Auth::user()->id) {
                    $array_id[] = $order->id;
                }
            }

            $orders = Order::findMany($array_id);
        }

        return view('Backend.orders.index')->with(['orders'=>$orders]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $get_order = Order::where('order_id', 'like', $id)->first();
        $order = OrderDetails::find($get_order->id);
//        $this->authorize('view', $order);

//        $product = $order->product();
//        dd($product);
        return view('Backend.orders.show')->with(['order'=>$order]);
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
        return view('Backend.orders.show')->with(['order'=>$order_details]);
    }

    public function refuseOrder(Request $request, $id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'cancelled';
        $order->save();
        $order_details = OrderDetails::find($order->id);
        return view('Backend.orders.show')->with(['order'=>$order_details]);
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
        if($order->payment->method == 'cash'){
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
    public function destroy($id)
    {
        //
    }
}
