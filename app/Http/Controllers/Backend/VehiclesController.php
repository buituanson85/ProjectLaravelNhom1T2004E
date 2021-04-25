<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AcceptRegisterProduct;
use App\Mail\RefusedRegisterProduct;
use App\Mail\SendMailRegisterPartner;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\District;
use App\Models\Backend\Galaxy;
use App\Models\Backend\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VehiclesController extends Controller
{
    public function index(Request $request){
        $name = $request->name;

        if (isset($name)){
            $users = DB::table('users')
                ->join('user_role', 'user_role.user_id','=','users.id')
                ->join('roles','roles.id','=','user_role.role_id')
                ->select('users.*')
                ->where('roles.name','Partner')->where('users.name','like','%'.$name.'%')->orderBy('id','DESC')->paginate(5);
            $users->appends($request->all());
        }else{
            $users = DB::table('users')
                ->join('user_role', 'user_role.user_id','=','users.id')
                ->join('roles','roles.id','=','user_role.role_id')
                ->select('users.*')
                ->where('roles.name','Partner')
//                ->whereNotIn('roles.name','Admin')
                ->orderBy('id','DESC')->paginate(5);
            $users->appends($request->all());
//            $users = User::with('roles')->paginate(5);
        }
        return view('Backend.Vehicles.index')->with(array('users'=>$users));
    }

    public function show($id)
    {
        $user = User::find($id);
        $districts = District::where('status','instock')->get();
        $brands = Brand::where('status','instock')->get();
        $categories = Category::where('status','instock')->get();
        return view('Backend.Vehicles.create-product', compact('user','districts','brands','categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
            'images.*' =>'image|mimes:png,jpg,gif,jpeg',
            'image' => 'required',
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
        $product = new Product();
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

        $product -> confirm = 1;

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
        $request->session()->flash('success', 'Thêm mới phương tiện thành công!');
        return redirect(route('products.index'));
    }

    public function tableProducts(Request $request,$id){
        $products = Product::where('partner_id', $id)->orderBy('id','DESC')->paginate(5);
        $products->appends($request->all());
        $user = User::find($id);
        return view('Backend.Vehicles.table-products',compact('products', 'user'));
    }

    public function showProduct($id){
        $product = Product::find($id);
        return view('Backend.Vehicles.show-product', compact('product'));
    }

    public function destroy(Request $request,$id){
        Product::find($id)->delete();
        $request->session()->flash('success', 'Delete product success!');
        return redirect(route('products.index'));
    }


    public function unlockfeaturedproduct(Request $request,$id){
        $product = Product::find($id);
        Product::where('id', $id)->update (['featured'=> 1]);
        $request->session()->flash('error', 'Khóa phương tiện thành công!');
        return redirect()->back();
    }
    public function locksfeaturedproduct(Request $request,$id){
        $product = Product::find($id);
        Product::where('id', $id)->update (['featured'=> 0]);
        $request->session()->flash('success', 'Mở phương tiện thành công!');
        return redirect()->back();
    }

    public function confirmProduct(Request $request){
        $products = Product::where('status', 'pending')->orderBy('id','DESC')->paginate(5);
        $products->appends($request->all());
        return view('Backend.confirm-products.index',compact('products'));
    }

    public function showConfirm($id){

        $product = Product::find($id);
        $galaxies = Galaxy::where('product_id', $id)->get();
        return view('Backend.confirm-products.show')->with(['product' => $product,'galaxies' => $galaxies]);
    }

    public function acceptProduct($id)
    {
        $product = Product::find($id);
        $galaxies = Galaxy::where('product_id', $id)->get();
        return view('Backend.products.show')->with(['product' => $product,'galaxies' => $galaxies]);
    }

    public function acceptProductConfirm(Request $request,$id)
    {
        $product = Product::find($id);
        $product->status = 'ready';

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $product->user->email;
        $name = $product->user->name;
        $date = "Date: ".''.$now;
        $products = [
            'name' => $name,
            'date' => $date
        ];

        Mail::to($email)->send(new AcceptRegisterProduct($products));
        $product->save();
        $request->session()->flash('success', 'Đã chấp nhận hồ sơ!');
        return redirect(route('dashboards.confirmproduct'));
    }

    public function refusedProductConfirm(Request $request,$id)
    {
        $product = Product::find($id);
        $product->status = 'refused';

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $product->user->email;
        $name = $product->user->name;
        $date = "Date: ".''.$now;
        $products = [
            'name' => $name,
            'date' => $date
        ];

        Mail::to($email)->send(new RefusedRegisterProduct($products));

        $product->save();
        $request->session()->flash('error', 'Đã từ chối hồ sơ!');
        return redirect(route('dashboards.confirmproduct'));
    }

    public function acceptConfirm(Request $request,$id){
        $product = Product::find($id);
        Product::where('id', $id)->update (['confirm'=> 1]);
        $request->session()->flash('success', 'Update confirm product success!');
        return redirect(route('dashboards.confirmproduct'));
    }
}
