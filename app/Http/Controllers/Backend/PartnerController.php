<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\SendCreatePartner;
use App\Mail\SendMailRegisterPartner;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\District;
use App\Models\Backend\HistoryMonney;
use App\Models\Backend\Partner;
use App\Models\Backend\Product;
use App\Models\Backend\Wallet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $products = Product::where('partner_id', $user->id)->orderBy('id','DESC')->paginate(10);
        $products->appends($request->all());
        return view('Backend.administration-partner.index',compact('products'));
    }

    public function create()
    {
        $districts = District::where('status','instock')->get();
        $brands = Brand::where('status','instock')->get();
        $categories = Category::where('status','instock')->get();
        $cities = City::where('status','instock')->get();
        return view('Backend.administration-partner.create', compact('districts','brands','categories','cities'));
    }

    public function store(Request $request){
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
        $product->status = 'unavailable';
        $product->featured = 0;
        $product->district_id = $request->district_id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->city_id = $request->city_id;
        $product->partner_id = Auth::user()->getAuthIdentifier();

        $product->save();
        $request->session()->flash('success', 'Tạo phương tiện thành công!');
        return redirect()->route('partners.index');
    }

    public function edit($id){
        $product = Product::find($id);
        $districts = District::where('status','instock')->get();
        $brands = Brand::where('status','instock')->get();
        $categories = Category::where('status','instock')->get();
        return view('Backend.administration-partner.edit', compact('product', 'districts','brands', 'categories'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|integer',
            'insurrance' => 'required',
            'deposit' => 'required',
            'km' => 'required',
            'additional' => 'required',
            'engine' => 'required',
            'seat' => 'required',
            'capacity' => 'required',
            'range' => 'required',
            'gear' => 'required',
            'consumption' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required'
        ]);
        $product = Product::find($id);
        $product -> name = $request ->name;
        $product ->slug = $request ->slug;
        $product -> price = $request ->price;
        $product -> insurrance = $request ->insurrance;
        $product -> deposit = $request ->deposit;
        $product -> km = $request ->km;
        $product -> additional = $request ->additional;
        $product -> engine = $request ->engine;
        $product -> seat = $request ->seat;
        $product -> capacity = $request ->capacity;
        $product -> range = $request ->range;
        $product -> gear = $request ->gear;
        $product -> consumption = $request ->consumption;
        $product -> status = $request ->status;
        $product -> category_id = $request ->category_id;
        $product -> brand_id = $request ->brand_id;
        $product -> district_id = $request ->district_id;
        $product -> partner_id = $request ->partner_id;

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

        $product->save();
        $request->session()->flash('success', 'Cập nhật phương tiện thành công!');
        return redirect(route('partners.index'));
    }

    public function destroy(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $checkUser = User::where('id',$user->id)->withCount('roles')->get()->toArray();
        if($checkUser[0]['roles_count']>0){
            $user->roles()->detach();//delete all relationship in role_permission
        }

        //xóa sản phẩm
        $products = Product::where('partner_id', $id)->get();
        foreach ($products as $product){
            Product::find($product->id)->delete();
        }
        //Xóa ví
        $wallet = Wallet::where('partner_id',$id)->fisrt();
        $wallet->delete();
        $user->delete();
        $request->session()->flash('error', 'Xóa nhân viên thành công!');
        return redirect(route('users.index'));
    }

    public function unlockstatustpartner(Request $request,$id){
        $product = Product::find($id);
        Product::where('id', $id)->update (['confirm'=> 0]);
        $request->session()->flash('error', 'Phương tiện chuyển sang trạng thái Offline!');
        return redirect(route('partners.index'));
    }
    public function lockstatustpartner(Request $request,$id){
        $product = Product::find($id);
        Product::where('id', $id)->update (['confirm'=> 1]);
        $request->session()->flash('success', 'Phương tiện chuyển sang trạng thái Online!');
        return redirect(route('partners.index'));
    }




    //pages

    public function registerPartners(){
        return view('Frontend.policy');
    }

    public function storePartners(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'title' => 'required',
            'note' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        $partner = new Partner();

        $partner->name = $request->name;
        $partner->phone = $request->phone;
        $partner->email = $request->email;
        $partner->address = $request->address;
        $partner->title = $request->title;
        $partner->note = $request->note;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $request->email;
        $date = "Date: ".''.$now;
        $partners = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'title' => $request->title,
            'note' => $request->note,
            'date' => $date
        ];

        Mail::to($email)->send(new SendMailRegisterPartner($partners));

        $partner->save();
        $request->session()->flash('success', 'Thêm mới đối tác thành công!');
        return view('Frontend.policy');
    }

    public function confirmPartner(Request $request){
        $partners = Partner::where('status','outofstock')->orderBy('id','DESC')->paginate(5);
        $partners->appends($request->all());
        return view('Backend.administration-partner.table-confirm-register-partner', compact('partners'));
    }

    public function deleteConfirmPartner(Request $request){
        $id =$request->partner_id;
        Partner::find($id)->delete();
        $request->session()->flash('error', 'Xóa đối tác thành công!');
        return redirect(route('pages.confirmpartner'));
    }

    public function confirmlock(Request $request,$id){
        $partner = Partner::find($id);

        $password = Str::random(8);;
        $user = new User();
        $user->name = $partner->name;
        $user->phone = $partner->phone;
        $user->email = $partner->email;
        $user->address = $partner->address;
        $user->password = bcrypt($password);
        $user->utype = "PTR";

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $partner->email;;
        $date = "Date: ".''.$now;
        $users = [
            'name' => $partner->name,
            'email' => $partner->email,
            'password' => $password,
            'date' => $date
        ];

        Mail::to($email)->send(new SendCreatePartner($users));
        $user->save();

        $user_id = $user->id;

        //add role cho đối tác
        $checkUser = User::where('id',$user->id)->withCount('roles')->get()->toArray();
        if($checkUser[0]['roles_count']>0){
            $user->roles()->detach();//delete all relationship in role_permission
        }
        $user->roles()->attach(7);//add list permissions
        $user->roles()->attach(6);
        $user ->with('roles')->get();

        //thêm ví cho đối tác
        $wallet = new Wallet();

        $wallet->account = Str::random(12);
        $wallet->monney_confirm = 0;
        $wallet->monney = 500000;
        $wallet->partner_id = $user_id;
        $wallet->note = "Nạp 500 nghìn duy trì tài khoản";
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = "+ ".$wallet->monney." VNĐ";
        $history->note = $wallet->note;
        $history->wallet_id = $wallet->id;

        $history->save();

        Partner::where('id', $id)->update (['status'=> "instock"]);
        $request->session()->flash('success', 'Đăng ký tài khoản đối tác thành công!');
        return redirect(route('pages.confirmpartner'));
    }
}
