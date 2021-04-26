<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $wallet = Wallet::where('partner_id',$user_id)->limit(1);
        return view('Backend.wallet.index', compact('wallet'));
    }
}
