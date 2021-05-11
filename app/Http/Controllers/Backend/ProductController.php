<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\RegisterProduct;
use App\Mail\Send_dat_ho_khach_hang;
use App\Mail\SendMailRegisterPartner;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\District;
use App\Models\Backend\Galaxy;
use App\Models\Backend\HistoryMonney;
use App\Models\Backend\Product;
use App\Models\Backend\Wallet;
use App\Models\Frontend\Order;
use App\Models\Frontend\OrderDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = null;
        $all_products = Product::all();
        foreach ($all_products as $product) {
            if (Auth::user()->roles->where('id', 1)->first() != null) {
                $products = Product::where([
                    ['status','!=', 'refused'],
                    ['status','!=', 'pending'],
                    ['status','!=', 'unavailable']
                ])->orderBy('id','DESC')->get();
            } else {
                $products = Product::where('partner_id', Auth::user()->id)->get();
            }
        }
        return view("Backend.products.index")->with(['products' => $products]);
    }

    public function create()
    {
        $cities = City::where('status','instock')->get();
        $categories = Category::where('status','instock')->get();
        $districts = District::where('status','instock')->orderBy('id','DESC')->get();
        $brands = Brand::where('status','instock')->orderBy('id','DESC')->get();
        return view("Backend.products.create")->with(['categories' => $categories, 'districts' => $districts, 'brands' => $brands, 'cities' => $cities]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'image' => 'required',
            'insurance' => 'required',
            'deposit' => 'required',
            'km' => 'required',
            'additional' => 'required',
            'engine' => 'required',
            'seat' => 'required',
            'capacity' => 'required',
            'range' => 'required',
            'gear' => 'required',
            'consumption' => 'required',
            'brand_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'city_id' => 'required'
        ]);
        $product = new Product();

        $product->name = $request->name;

        if ($request ->image != null){
            $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

            $options = array('http' =>array(
                'method' => "POST",
                'header' => "Authorization: Bearer 3597bf9393d8155003c84329d6205961426482fc\n".
                    "Content-Type: application/x-www-form-urlencoded",
                'content' => $image
            ));
            $context = stream_context_create($options);
            $imgurURL = "https://api.imgur.com/3/image";

            $response = file_get_contents($imgurURL, false, $context);
            $response = json_decode($response);
            $msg = $response->data->link;
            $product -> image = $msg;
        }

        $product->price = $request->price;
        $product->insurrance = $request->insurance;
        $product->deposit = $request->deposit;
        $product->km = $request->km;
        $product->additional = $request->additional;
        $product->engine = $request->engine;
        $product->seat = $request->seat;
        $product->capacity = $request->capacity;
        $product->range = $request->range;
        $product->gear = $request->gear;
        $product->consumption = $request->consumption;
        $product->status = 'pending';
        $product->featured = 0;
        $product->district_id = $request->district_id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->city_id = $request->city_id;
        $product->partner_id = Auth::user()->getAuthIdentifier();

        $product->save();
        $request->session()->flash('success', 'Tạo phương tiện thành công!');
        return redirect()->route('product.index');
    }


    public function show($id)
    {
        $product = Product::find($id);
        $this->authorize('view', $product);
        $galaxies = Galaxy::where('product_id',$id)->get();
        return view('Backend.products.productshow')->with(['product' => $product, 'galaxies'=>$galaxies]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cities = City::where('status','instock')->get();
        $categories = Category::where('status','instock')->get();
        $districts = District::where('status','instock')->orderBy('id','DESC')->get();
        $brands = Brand::where('status','instock')->orderBy('id','DESC')->get();
        $this->authorize('view', $product);

        return view("Backend.products.edit")->with(['product' => $product, 'categories' => $categories, 'districts' => $districts, 'brands' => $brands, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'insurance' => 'required',
            'deposit' => 'required',
            'km' => 'required',
            'additional' => 'required',
            'engine' => 'required',
            'seat' => 'required',
            'capacity' => 'required',
            'range' => 'required',
            'gear' => 'required',
            'consumption' => 'required',
            'brand_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'city_id' => 'required'
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $get_image = $request->file('image');

        if ($request ->image != null){
            $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

            $options = array('http' =>array(
                'method' => "POST",
                'header' => "Authorization: Bearer 3597bf9393d8155003c84329d6205961426482fc\n".
                    "Content-Type: application/x-www-form-urlencoded",
                'content' => $image
            ));
            $context = stream_context_create($options);
            $imgurURL = "https://api.imgur.com/3/image";

            $response = file_get_contents($imgurURL, false, $context);
            $response = json_decode($response);
            $msg = $response->data->link;
            $product -> image = $msg;
        }

        $product->price = $request->price;
        $product->insurrance = $request->insurance;
        $product->deposit = $request->deposit;
        $product->km = $request->km;
        $product->additional = $request->additional;
        $product->engine = $request->engine;
        $product->seat = $request->seat;
        $product->capacity = $request->capacity;
        $product->range = $request->range;
        $product->gear = $request->gear;
        $product->status = 'ready';
        $product->consumption = $request->consumption;
        $product->district_id = $request->district_id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->city_id = $request->city_id;

        $product->update();
        $request->session()->flash('success', 'Cập nhật phương tiện thành công!');
        return redirect()->route('product.index');
    }


    public function destroy(Request $request, $id)
    {
        $user_id = User::find($id);
        $products = Product::where('partner_id',$id)->get();
        foreach ($products as $product){
            $product = Product::find($id);
            $product->delete();
        }
        // rút hết tiền trong ví.
        $wallet = Wallet::where('partner_id',$id)->first();
        $monney_send = $wallet->monney;
        //trừ tài khoản ví.
        $wallet->monney = 0;
        $wallet->note = "Thanh lý hợp đồng đối tác";
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = $monney_send;
        $history->note = $wallet->note;
        $history->wallet_id = $wallet->id;
        $history->status = "pending";
        $history->save();
        $user_id->delete();
        $request->session()->flash('success', "Xóa phương tiện thành công");
        return redirect(route('products.index'));
    }

    public function acceptProduct($id)
    {
        $product = Product::find($id);
        $galaxies = Galaxy::where('product_id', $id)->get();
        return view('Backend.products.show')->with(['product' => $product,'galaxies' => $galaxies]);
    }

    public function refuseProduct($id)
    {
        $product = Product::find($id);
        $product->status = 'refused';
        $product->save();
        $galaxies = Galaxy::where('product_id', $id)->get();
        return view('Backend.products.show')->with(['product' => $product,'galaxies' => $galaxies]);
    }
    public function removeProduct($id)
    {
        $product = Product::find($id);
        $product->status = 'unavailable';
        $product->save();
        $galaxies = Galaxy::where('product_id', $id)->get();
        return view('Backend.products.show')->with(['product' => $product,'galaxies' => $galaxies]);
    }
    public function reupProduct($id)
    {
        $product = Product::find($id);
        $product->status = 'pending';
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $date = "Date: ".''.$now;
        $products = [
            'name' => $name,
            'date' => $date
        ];

        Mail::to($email)->send(new RegisterProduct($products));
        $product->save();
        $galaxies = Galaxy::where('product_id', $id)->get();
        return view('Backend.products.show')->with(['product' => $product,'galaxies' => $galaxies]);
    }

    public function chiTietProductDatho(Request $request,$id){
        $order_id = $request->order_id;
        $product = Product::find($id);
        $this->authorize('view', $product);
        $galaxies = Galaxy::where('product_id',$id)->get();
        return view('Backend.products.chitietproductdatho')->with(['product' => $product, 'galaxies'=>$galaxies,'order_id'=>$order_id]);
    }

    public function updateProductDatho(Request $request,$id){
        $order_id = $request->order_id;
        $order = Order::where('order_id', $order_id)->first();

        $new_order = new Order();

        $new_order->order_id = Str::random(10);
        $new_order->customer_id = $order->customer_id;
        $new_order->payment_id = $order->payment_id;
        $new_order->price_total = $order->price_total;

        $new_order->status = "pending";

        $new_order->save();

        $new_order_detail = new OrderDetails();
        $new_order_detail->order_id = $new_order->id;
        $new_order_detail-> product_id = $id;
        $new_order_detail-> note = "Đặt hộ đơn hàng mới thay đơn hàng".$order->order_id;
        $new_order_detail->product_price_total = $order->price_total;
        $new_order_detail->product_received_date = $order->orderdetails->product_received_date;
        $new_order_detail->product_pay_date = $order->orderdetails->product_pay_date;
        $new_order_detail->payments = $order->orderdetails->payments;
        $new_order_detail->quantity = $order->orderdetails->quantity;
        $new_order_detail->status = 0;

        $product = Product::find($id);
        $partner_id = User::find($product->partner_id);
        $customer_id = User::find($order->customer_id);

        $new_order_detail->save();

        $now = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $customer_id->email;
        $name = $customer_id->name;
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

        Mail::to($email)->send(new Send_dat_ho_khach_hang($products));

        //chuyển đơn hàng về confirm 1
        $order->status = "delete";
        $order->confirm = 1;
        $order->save();

        $request->session()->flash('success','Bạn đã thuê xe hộ thành công!!!');
        $orders = Order::where('status','pending')->orderBy('id','desc')->get();
        return redirect(route('dashboards.confirmorders'))->with(['orders'=>$orders]);
//        return view('Backend.orders.confirmorders')->with(['orders'=>$orders]);
    }
}
