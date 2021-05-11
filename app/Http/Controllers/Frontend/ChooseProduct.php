<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use App\Models\Backend\District;
use App\Models\Backend\Product;
use App\Models\Frontend\OrderDetails;
use App\Models\Frontend\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class ChooseProduct extends Controller
{
    public function index(Request $request){
        $category_id = $request->category_id;
        $city_id = $request->city_id;

        $seat = $request->seat;
        $gear = $request->gear;
        $brand_id = $request->brand_id;
        $sort = $request->sort;
        $district_id = $request->district_id;

        $categories = Category::where('status','instock')->get();
        $cities = City::where('status','instock')->orderBy('id', 'DESC')->get();
        if (isset($city_id)){
            $districts = District::where('status','instock')->where('city_id',$city_id)->orderBy('id', 'DESC')->get();
        }else{
            $districts = District::where('status','instock')->orderBy('id', 'DESC')->get();
        }

        $brands = Brand::where('status','instock')->orderBy('id', 'DESC')->get();
        $matchNight = array();

        if (isset($category_id)){
            $x =array('category_id', '=', $category_id);
            $matchNight[] = $x;
        }

        if (isset($seat)){
            $x =array('seat', '=', $seat);
            $matchNight[] = $x;
        }

        if (isset($gear)){
            $x =array('gear', '=', $gear);
            $matchNight[] = $x;
        }

        if (isset($brand_id)){
            $x =array('brand_id', '=', $brand_id);
            $matchNight[] = $x;
        }

        if (isset($district_id)){
            $x =array('district_id', '=', $district_id);
            $matchNight[] = $x;
        }

        if (isset($city_id)){
            $x =array('city_id', '=', $city_id);
            $matchNight[] = $x;
        }
        if (isset($sort)){
            if ($request->sort == 0){
                $products = Product::where('status','ready')
                    ->where('confirm', 1)
                    ->where('featured', 0)
                    ->where($matchNight)
                    ->orderBy('price', 'ASC')
                    ->paginate(10);
            }else{
                $products = Product::where($matchNight)
                    ->where('status','ready')
                    ->where('confirm', 1)
                    ->where('featured', 0)
                    ->orderBy('price', 'DESC')
                    ->paginate(10);
            }
        }else{
            $products = Product::where($matchNight)
                ->where('status','ready')
                ->where('confirm', 1)
                ->where('featured', 0)
                ->orderBy('price', 'ASC')
                ->paginate(10);
        }

        //Google map.
        $district_locations = District::where([
            ['status', 'instock']
        ])->get();
//        $collections[] = collect(['start' => '2020-05-05', 'end' => '2020-04-04']);
//        foreach ($district_locations as $index => $district_location){
//                $collections[] = collect(['position' => 'new google.maps.LatLng'."(".($district_location->location).")", 'type' => 'info']);
//        }
        $collections = array();
        foreach ($district_locations as $index => $district_location){
            array_push($collections,$district_location->location);
        }
//        dd($collections);
        $viewData = [
            'collections' =>json_encode($collections),
            'categories' => $categories,
            'cities' =>$cities,
            'products' => $products,
            'brands' =>$brands,
            'districts' => $districts,
            'category_id' =>$category_id,
            'city_id' => $city_id,
            'seat' => $seat,
            'gear' =>$gear,
            'brand_id' => $brand_id,
            'sort' =>$sort,
            'district_id' => $district_id,
        ];
        return view('Frontend.choose-product', $viewData);
    }

    function loadData(Request $request)
    {
        $matchNight = array();
        $id = $request->id;
        $category_id = $request->category_id;
        $city_id = $request->city_id;
        $seat = $request->seat;
        $gear = $request->gear;
        $brand_id = $request->brand_id;
        $sort = $request->sort;
        $district_id = $request->district_id;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        if (isset($category_id)){
            $x =array('category_id', '=', $category_id);
            $matchNight[] = $x;
        }

        if (isset($seat)){
            $x =array('seat', '=', $seat);
            $matchNight[] = $x;
        }

        if (isset($gear)){
            $x =array('gear', '=', $gear);
            $matchNight[] = $x;
        }

        if (isset($brand_id)){
            $x =array('brand_id', '=', $brand_id);
            $matchNight[] = $x;
        }

        if (isset($district_id)){
            $x =array('district_id', '=', $district_id);
            $matchNight[] = $x;
        }

        if (isset($city_id)){
            $x =array('city_id', '=', $city_id);
            $matchNight[] = $x;
        }

        if ($request->ajax()) {
            if ($request->id > 0) {
                if (isset($sort)){
                    if ($request->sort == 0){
                        $data = Product::where('id','<', $id)
                            ->where('status','ready')
                            ->where('confirm', 1)
                            ->where('featured', 0)
                            ->where($matchNight)
                            ->orderBy('price', 'ASC')
                            ->limit(5)->get();
                    }else{
                        $data = Product::where('id','<', $id)
                            ->where('status','ready')
                            ->where('confirm', 1)
                            ->where('featured', 0)
                            ->where($matchNight)
                            ->orderBy('price', 'DESC')
                            ->limit(5)->get();
                    }
                }else{
                    $data = Product::where('id','<', $id)
                        ->where('status','ready')
                        ->where('confirm', 1)
                        ->where('featured', 0)
                        ->where($matchNight)
                        ->orderBy('price', 'ASC')
                        ->limit(5)->get();
                }
            }else{
                if (isset($sort)){
                    if ($request->sort == 0){
                        $data = Product::where('status','ready')
                            ->where('confirm', 1)
                            ->where('featured', 0)
                            ->where($matchNight)
                            ->orderBy('price', 'ASC')
                            ->limit(5)->get();
                    }else{
                        $data = Product::where('status','ready')
                            ->where('confirm', 1)
                            ->where('featured', 0)
                            ->where($matchNight)
                            ->orderBy('price', 'DESC')
                            ->limit(5)->get();
                    }
                }else{
                    $data = Product::
                        where('status','ready')
                        ->where('confirm', 1)
                        ->where('featured', 0)
                        ->where($matchNight)
                        ->orderBy('price', 'ASC')
                        ->limit(5)->get();
                }
            }
            $output = '';
            $last_id = '';
            if (!$data->isEmpty()){
                foreach ($data as $row){
                    $output .= '
                                <div class="detail-choose-right-product">
                                    <input type="hidden" value="'.$row->id .'">
                                    <div class="product_img">
                                        <img src="'.$row->image.'" style="width: 100%" alt="">
                                    </div>
                                    <div class="product_detail">
                                        <div style="font-weight: 600">'.$row->name.'</div>
                                        <span style="display: flex;padding-top: 10px; color: gold">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                        <div class="product_detail_type" >
                                            <div class="product_detail_type_1">
                                                <p><i class="fas fa-map-marked-alt"></i>'.$row->district->name.'</p>
                                                <p ><i class="fas fa-gas-pump" ></i>
                                                '.$row->engine.'
                                                </p>
                                            </div>
                                            <div class="product_detail_type_1">
                                                <p><i class="fas fa-cogs">'.$row->gear.'</i> </p>
                                                <p><i class="fas fa-tachometer-alt"></i>'.$row->consumption.'</p>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="product_price">
                                        <div>'.number_format($row->price).'₫ <span style="font-size: 12px">/ngày</span></div>
                                        <p style="font-style: italic;color: green">-5% khi thanh toán online</p>
                                        <p style="text-align: center;padding-top: 18px;color: white;display: flex">
                                        <form method="post" action="/pages/show-products">
                                        '.@csrf_field().'
                                        <input type="hidden" name="id" value="'.$row->id.'">
                                        <button type="submit" style="border: 1px solid lightseagreen;color: white;flex: 1; background-color:lightseagreen;padding: 5px; border-radius: 5px;width: 100%" >Chi tiết</button></p>
                                        </form>
                                    </div>
                                </div>
                    ';
                    $last_id = $row->id;
                }
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
                    </div>
                ';
            }
            else{
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-info form-control">Không có dữ liệu</button>
                    </div>
                ';
            }
            echo $output;
        }
    }

    public function showProducts(Request $request){
        $data = $request->all();
        $starts_times = $request->start_timess;
        $id = $request->id;
        $product = Product::find($id);
        if ($product->category_id == 1){
            $order_times = OrderDetails::where([
                ['status', 0],
                ['product_id',$id]
            ])->get();
            $collections[] = collect(['start' => '2020-05-05', 'end' => '2020-04-04']);
            foreach ($order_times as $index => $order_time){
                if ($order_time->product_received_date == $order_time->product_pay_date){
                     array_push($collections,$order_time->product_received_date);
                }else{
                    $collections[] = collect(['start' => $order_time->product_received_date, 'end' => $order_time->product_pay_date]);
                }
            }
        }else{
            $collections[] = collect(['start' => '2020-05-05', 'end' => '2020-04-04']);
        }
//dd($collections);
        return view('Frontend.single-product', compact('product','collections','starts_times'));
    }

    public function showInfo(Request $request,$id){
        $product = Product::find($id);
        $allPayment = Payment::all();
        $total_price = $request->total_price;
        $total_time_send = $request->total_time_send;
        $start_time = $request->start_time2;
        $end_time = $request->end_time2;
        $receive_method = $request->receive_Method;
        $quantity = $request->quantity;

        if ($quantity <= 0 ){
            $request->session()->flash('error', 'Vui lòng nhập số lượng xe lớn hơn không!');
            return redirect()->back();
        }elseif ($quantity > $product->quantity){
            $request->session()->flash('error', 'Số lượng xe hiện tại không đủ yêu cầu!');
            return redirect()->back();
        }

        return view('Frontend.info-customer')->with([
            'product'=>$product,
            'total_price'=>$total_price,
            'total_time_send'=>$total_time_send,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'quantity' => $quantity,
            'receive_method'=>$receive_method,
            'allPayment'=>$allPayment,
        ]);
    }
}
