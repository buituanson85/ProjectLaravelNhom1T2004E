<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\RegisterProduct;
use App\Mail\SendMailRegisterPartner;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\District;
use App\Models\Backend\Galaxy;
use App\Models\Backend\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $products = null;
        $all_products = Product::all();
        foreach ($all_products as $product) {
            if (Auth::user()->roles->where('id', 1)->first() != null) {
                $products = Product::all();
            } else {
                $products = Product::where('partner_id', Auth::user()->id)->get();
            }
        }
        return view("Backend.products.index")->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('status','instock')->get();
        $categories = Category::where('status','instock')->get();
        $districts = District::where('status','instock')->orderBy('id','DESC')->get();
        $brands = Brand::where('status','instock')->orderBy('id','DESC')->get();
        return view("Backend.products.create")->with(['categories' => $categories, 'districts' => $districts, 'brands' => $brands, 'cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $this->authorize('view', $product);

        return view('Backend.products.show')->with(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
        $product->status = 'pending';
        $product->consumption = $request->consumption;
        $product->district_id = $request->district_id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->city_id = $request->city_id;

        $product->update();
        $request->session()->flash('success', 'Cập nhật phương tiện thành công!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        $request->session()->flash('success', "Xóa phương tiện thành công");
        return redirect(route('product.index'));
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
}
