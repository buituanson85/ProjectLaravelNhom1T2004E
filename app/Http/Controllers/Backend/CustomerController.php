<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request){
        $name = $request->name;
        if (isset($name)){
            $users = User::where([
                ['name','like','%'.$name.'%'],
                ['utype','=',"USR"]
            ])->orderBy('id','DESC')->paginate(5);
            $users->appends($request->all());
        }else{
            $users = User::where('utype',"USR")->orderBy('id','DESC')->paginate(5);
            $users->appends($request->all());
        }
        return view('Backend.customers.index', compact('users'));
    }

    public function show($id){
        $user = User::find($id);
        return view('Backend.customers.show', compact('user'));
    }
}
