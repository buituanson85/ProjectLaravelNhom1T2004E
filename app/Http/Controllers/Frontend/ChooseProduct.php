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
        $category_id = $request->category_id;
        $city_id = $request->city_id;

        $seat = $request->seat;
        $gear = $request->gear;
        $brand_id = $request->brand_id;
        $sort = $request->sort;
        $district_id = $request->district_id;



        $categories = Category::where('status','instock')->get();
        $cities = City::where('status','instock')->orderBy('id', 'DESC')->get();

        $districts = District::where('status','instock')->where('city_id',$city_id)->orderBy('id', 'DESC')->get();
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
                $products = Product::where('status','instock')
                    ->where($matchNight)
                    ->orderBy('price', 'ASC')
                    ->paginate(10);
            }else{
                $products = Product::where($matchNight)
                    ->where('status','instock')
                    ->orderBy('price', 'DESC')
                    ->paginate(10);
            }
        }else{
            $products = Product::where($matchNight)
                ->where('status','instock')
                ->orderBy('price', 'ASC')
                ->paginate(10);
        }

        return view('Frontend.choose-product', compact('categories','cities','products','brands','districts','category_id','city_id','seat', 'gear','brand_id','sort','district_id'));
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
                            ->where('status','instock')
                            ->where($matchNight)
                            ->orderBy('price', 'ASC')
                            ->limit(5)->get();
                    }else{
                        $data = Product::where('id','<', $id)
                            ->where('status','instock')
                            ->where($matchNight)
                            ->orderBy('price', 'DESC')
                            ->limit(5)->get();
                    }
                }else{
                    $data = Product::where('id','<', $id)
                        ->where('status','instock')
                        ->where($matchNight)
                        ->orderBy('price', 'ASC')
                        ->limit(5)->get();
                }
            }else{
                if (isset($sort)){
                    if ($request->sort == 0){
                        $data = Product::where('status','instock')
                            ->where($matchNight)
                            ->orderBy('price', 'ASC')
                            ->limit(5)->get();
                    }else{
                        $data = Product::where('status','instock')
                            ->where($matchNight)
                            ->orderBy('price', 'DESC')
                            ->limit(5)->get();
                    }
                }else{
                    $data = Product::where('status','instock')
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
                                        </p>
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
                        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                    </div>
                ';
            }
            echo $output;
        }
    }

    public function showProducts(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        return view('Frontend.single-product', compact('product','start_time','end_time'));
    }
}
