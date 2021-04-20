<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    //pages

    public function registerPartners(){
        return view('Frontend.policy');
    }
}
