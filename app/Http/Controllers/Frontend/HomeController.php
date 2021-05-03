<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\File;
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

    public function lichsuthuexe(){
        return view('Frontend.profiles.lichsuthuexe');
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
        $user->save();

        return redirect()->back()->with('success', 'Đổi thông tin thành công');
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
        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công');
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
        return redirect()->back()->with('success', 'Thêm mới hồ sơ thành công');
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

            return redirect()->back()->with('passwordsuccess', 'Đổi mật khẩu thành công');
        }else{
            return redirect()->back()->with('error', 'Đổi mật khẩu cũ không đúng');
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

    public function abc(){
        return view('Frontend.abc');
    }
}
