<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\File;
use App\Models\Backend\Galaxy;
use App\Models\Backend\NoteOrder;
use App\Models\Frontend\Order;
use App\Models\Frontend\OrderDetails;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status','instock')->orderBy('id', 'DESC')->get();
        $cities = City::where('status','instock')->orderBy('id', 'DESC')->get();
        return view('Frontend.home',compact('categories','cities'));
    }

    public function lichsuthuexe(Request $request){

        $orders = Order::where([
            ['customer_id', Auth::user()->id],
            ['status','!=','cancelled'],
            ['status','!=','delete'],
            ['status','!=','completed']
        ])->orderBy('id','desc')->paginate(5);
        $orders->appends($request->all());
        return view('Frontend.profiles.lichsuthuexe')->with(['orders'=>$orders]);
    }

    public function lsthuexe(Request $request){
        $name = $request->name;
        if (isset($name)){
            $orders = Order::where([
                ['customer_id', Auth::user()->id],
                ['order_id','like', '%'.$name.'%'],
                ['status','!=','pending'],
                ['status','!=','paid'],
                ['status','!=','accept']
            ])->orderBy('id','desc')->paginate(10);
            $orders->appends($request->all());
        }else{
            $orders = Order::where([
                ['customer_id', Auth::user()->id],
                ['status','!=','pending'],
                ['status','!=','paid'],
                ['status','!=','accept']
            ])->orderBy('id','desc')->paginate(10);
            $orders->appends($request->all());
        }

        return view('Frontend.profiles.lsthuexe')->with(['orders'=>$orders]);
    }
    public function deleteOrder(Request $request,$id){
        $order = Order::where('order_id', $id)->first();
        $order->status = 'delete';
        //l??u l???ch s??? x??a
        $noteorder = new NoteOrder();
        $noteorder->note = "Kh??ch h??ng x??a";
        $noteorder->order_id = $order->id;
        $noteorder->partner_id = $order->orderdetails->product->partner_id;
        $order->save();
        $noteorder->save();

        $request->session()->flash('success', 'M??? ph????ng ti???n th??nh c??ng!');
        return redirect()->back();
    }

    public function chitietdonhang($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::where('order_id', $get_order->id)->first();
        $galaxies = Galaxy::where('product_id', $order->product->id)->get();
        return view('Frontend.profiles.chitietdonhang')->with(['order'=>$order,'galaxies'=>$galaxies]);
    }

    public function ctdonhang($id){
        $get_order = Order::where('order_id','like', $id)->first();
        $order = OrderDetails::where('order_id', $get_order->id)->first();
        $galaxies = Galaxy::where('product_id', $order->product->id)->get();
        return view('Frontend.profiles.ctdonhang')->with(['order'=>$order,'galaxies'=>$galaxies]);
    }

    public function customerProfiles(){
        $user = User::find(Auth::user()->id);
        $file = File::where('customer_id', Auth::user()->id)->first();
        return view('Frontend.profiles.customer-profiles',compact('user','file'));
    }

    public function capnhatprofile(Request $request){
        $this->validate($request, [
            'name' =>'required',
            'phone' =>'required',
            'address' =>'required'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
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
            $user -> profile_photo_path = $msg;
        }
        $user->save();

        return redirect()->back()->with('success', '?????i th??ng tin th??nh c??ng');
    }

    public function taianhgalaxy(Request $request){
//        $file = File::where('customer_id', Auth::user()->id)->fisrt();
        $file = new File();
        $file->customer_id = Auth::user()->id;
        if ($request ->image_1 != null){
            $image = base64_encode(file_get_contents($_FILES['image_1']['tmp_name']));

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
            $file -> cmt_before = $msg;
        }
        if ($request ->image_2 != null){
            $image = base64_encode(file_get_contents($_FILES['image_2']['tmp_name']));

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
            $file -> cmt_after = $msg;
        }
        if ($request ->image_3 != null){
            $image = base64_encode(file_get_contents($_FILES['image_3']['tmp_name']));

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
            $file -> license_before = $msg;
        }
        $file->license_after= $request->image_4;
        if ($request ->image_4 != null){
            $image = base64_encode(file_get_contents($_FILES['image_4']['tmp_name']));

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
            $file -> license_after = $msg;
        }
        if ($request ->image_5 != null){
            $image = base64_encode(file_get_contents($_FILES['image_5']['tmp_name']));

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
            $file -> registration_book = $msg;
        }

        $file->save();
        return redirect()->back()->with('success', 'C???p nh???t h??? s?? th??nh c??ng');
    }
    public function capnhatgalaxy(Request $request){
        $file = File::where('customer_id', Auth::user()->id)->fisrt();

        if ($request ->image_1 != null){
            $image = base64_encode(file_get_contents($_FILES['image_1']['tmp_name']));

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
            $file -> cmt_before = $msg;
        }
        if ($request ->image_2 != null){
            $image = base64_encode(file_get_contents($_FILES['image_2']['tmp_name']));

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
            $file -> cmt_after = $msg;
        }
        if ($request ->image_3 != null){
            $image = base64_encode(file_get_contents($_FILES['image_3']['tmp_name']));

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
            $file -> license_before = $msg;
        }
        $file->license_after= $request->image_4;
        if ($request ->image_4 != null){
            $image = base64_encode(file_get_contents($_FILES['image_4']['tmp_name']));

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
            $file -> license_after = $msg;
        }
        if ($request ->image_5 != null){
            $image = base64_encode(file_get_contents($_FILES['image_5']['tmp_name']));

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
            $file -> registration_book = $msg;
        }

        $file->save();
        return redirect()->back()->with('success', 'Th??m m???i h??? s?? th??nh c??ng');
    }
    public function doimatkhau(){
        return view('Frontend.profiles.doimatkhau');
    }

    public function doimatkhauStore(Request $request){
        $this->validate($request, [
            'newpassword' =>'required|min:6|max:30|confirmed'
        ]);
        $user = User::find(Auth::user()->id);
        $hashedPassword = $user->password;
        if (Hash::check($request->password, $hashedPassword)) {
            $user->update([
                'password' => bcrypt($request->newpassword)
            ]);

            return redirect()->back()->with('passwordsuccess', '?????i m???t kh???u th??nh c??ng');
        }else{
            return redirect()->back()->with('error', '?????i m???t kh???u c?? kh??ng ????ng');
        }
    }

    public function tutorial(){
        return view('Frontend.Child.tutorial');
    }

    public function abountus(){
        return view('Frontend.Child.abountus');
    }

    public function promotion(){
        return view('Frontend.Child.promotion');
    }
    public function camnang(){
        return view('Frontend.Child.camnang');
    }
    public function hoanhuy(){
        return view('Frontend.Child.hoanhuy');
    }
    public function hopdong(){
        return view('Frontend.Child.hopdong');
    }
    public function khieunai(){
        return view('Frontend.Child.khieunai');
    }
    public function baomat(){
        return view('Frontend.Child.baomat');
    }
    public function service(){
        return view('Frontend.Child.service');
    }

    public function cauhoi(){
        return view('Frontend.Child.cauhoi');
    }

}
