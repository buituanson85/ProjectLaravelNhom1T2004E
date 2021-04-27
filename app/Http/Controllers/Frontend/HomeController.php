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
        return view('Frontend.Child.Child.camnang');
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
}
