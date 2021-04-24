<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\District;
use App\Models\Backend\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $categories = Category::all();
        $districts = District::all()->sortByDesc('name');
        $brands = Brand::all()->sortBy('name', false);
        return view("Backend.products.create")->with(['categories' => $categories, 'districts' => $districts, 'brands' => $brands]);
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
        ]);
        $product = new Product();

        $product->name = $request->name;
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/Backend/images', $new_image);
            $product->image = $new_image;
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
        $categories = Category::all();
        $districts = District::all()->sortByDesc('name');
        $brands = Brand::all()->sortBy('name', false);
        $this->authorize('view', $product);

        return view("Backend.products.edit")->with(['product' => $product, 'categories' => $categories, 'districts' => $districts, 'brands' => $brands]);
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
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/Backend/images', $new_image);
            $product->image = $new_image;
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

    public function acceptProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->status = 'ready';
        $product->save();
        return view('Backend.products.show')->with(['product' => $product]);
    }

    public function refuseProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->status = 'refused';
        $product->save();
        return view('Backend.products.show')->with(['product' => $product]);
    }
    public function removeProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->status = 'unavailable';
        $product->save();
        return view('Backend.products.show')->with(['product' => $product]);
    }
    public function reupProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->status = 'pending';
        $product->save();
        return view('Backend.products.show')->with(['product' => $product]);
    }
}
