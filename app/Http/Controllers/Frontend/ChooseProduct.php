<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\District;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChooseProduct extends Controller
{
    public function index(Request $request){
        $category_id = $request->categori_id;
        $city_id = $request->city_id;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        $seat = $request->seat;
        $gear = $request->gear;
        $brand_id = $request->brand_id;
        $sort = $request->sort;
        $district_id = $request->district_id;

        if ($request->sort == 0){
            $sort_s = "ASC";
        }else{
            $sort_s = "DESC";
        }


        $categories = Category::where('status','instock')->get();
        $cities = City::where('status','instock')->orderBy('id', 'DESC')->get();

        $districts = District::where('status','instock')->where('city_id',$city_id)->orderBy('id', 'DESC')->get();
        $brands = Brand::where('status','instock')->orderBy('id', 'DESC')->get();

        if (isset($category_id) && isset($city_id) && isset($start_time) && isset($end_time)){

            if (isset($seat) && isset($gear) && isset($brand_id) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
                //1
            }elseif (isset($seat) && isset($gear) && isset($brand_id) && isset($sort)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($gear) && isset($brand_id) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($gear) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($brand_id) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($gear) && isset($brand_id) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
                //2
            }elseif (isset($seat) && isset($gear) && isset($brand_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($gear) && isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($gear) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($brand_id) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($brand_id) && isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($gear) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($gear) && isset($brand_id) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($gear) && isset($brand_id) && isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($brand_id) && isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($gear)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['gear', $gear],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($brand_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($gear) && isset($brand_id) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($gear) && isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($gear) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($brand_id) && isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($brand_id) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['brand_id', $brand_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($sort) && isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif (isset($seat)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['seat', $seat],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif (isset($gear)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['gear', $gear],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($brand_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['brand_id', $brand_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($sort) ){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price',$sort_s)->paginate(10);
                $products->appends($request->all());
            }elseif ( isset($district_id)){
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['district_id', $district_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','DESC')->paginate(10);
                $products->appends($request->all());
            }else{
                $products = DB::table('products')
                    ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                    ->select('products.*')
                    ->where([
                        ['status','instock'],
                        ['category_id', $category_id],
                        ['city_id', $city_id],
                        ['time_orders.product_id','=',null]
                    ])->orwhere('time_orders.end_time','<',$start_time)
                    ->orWhere('time_orders.start_time','>',$end_time)
                    ->orderBy('products.price','ASC')->paginate(10);
                $products->appends($request->all());
            }
        }
        elseif (isset($city_id) && isset($start_time) && isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])->orwhere('time_orders.end_time','<',$start_time)
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id) && isset($start_time) && isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orwhere('time_orders.end_time','<',$start_time)
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id) && isset($city_id) && isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id) && isset($city_id) && isset($start_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orwhere('time_orders.end_time','<',$start_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id) && isset($city_id)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id) && isset($start_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orwhere('time_orders.end_time','<',$start_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id) && isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($city_id) && isset($start_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])->orwhere('time_orders.end_time','<',$start_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($city_id) && isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($start_time) && isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['time_orders.product_id','=',null]
                ])->orwhere('time_orders.end_time','<',$start_time)
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($city_id)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['city_id', $city_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($start_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['time_orders.product_id','=',null]
                ])->orwhere('time_orders.end_time','<',$start_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($end_time)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['time_orders.product_id','=',null]
                ])
                ->orWhere('time_orders.start_time','>',$end_time)
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        elseif (isset($category_id)) {
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['status','instock'],
                    ['category_id', $category_id],
                    ['time_orders.product_id','=',null]
                ])
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }
        else{
            $products = DB::table('products')
                ->leftJoin('time_orders', 'time_orders.product_id','=','products.id')
                ->select('products.*')
                ->where([
                    ['time_orders.product_id','=',null]
                ])
                ->orderBy('id','DESC')->paginate(10);
            $products->appends($request->all());
        }


                if ($request->ajax()){
                    $view = view('Frontend.choose-product',compact('categories','cities','products','brands','districts','category_id','city_id', 'start_time', 'end_time','seat', 'gear','brand_id','sort','district_id'))->render();
                    return response()->json(['html'=>$view]);
                }
        return view('Frontend.choose-product', compact('categories','cities','products','brands','districts','category_id','city_id', 'start_time', 'end_time','seat', 'gear','brand_id','sort','district_id'));
    }

    public function showProducts(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        return view('Frontend.single-product', compact('product','start_time','end_time'));
    }
}
