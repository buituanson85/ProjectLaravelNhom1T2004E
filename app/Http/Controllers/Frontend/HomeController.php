<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('status','instock')->orderBy('id', 'DESC')->get();
        $cities = City::where('status','instock')->orderBy('id', 'DESC')->get();
        return view('Frontend.home',compact('categories','cities'));
    }
}
