<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users',
            'password' => 'required|alpha_num|min:6',
            'password_confirmation' => 'required|alpha_num|min:6',
            'phone' => 'required',
            'cmt' => 'required',
            'cmt_day' => 'required',
            'birth_day' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        $user = new User();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->cmt = $request->cmt;
        $user->cmt_day = $request->cmt_day;
        $user->birth_day = $request->birth_day;
        $user->password = bcrypt($request->password);
        $user->save();

        $request->session()->flash('success', 'Đăng ký tài khoản thành công!');
        return redirect()->route('users.index');
    }
}
