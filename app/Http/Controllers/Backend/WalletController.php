<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\HistoryMonney;
use App\Models\Backend\Wallet;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function index(){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        return view('Backend.wallet.index', compact('wallet'));
    }

    public function tutorialMonney($id){
        $wallet = Wallet::find($id);
        return view('Backend.wallet.tutorialMonney',compact('wallet'));
    }

    public function transactionHistory(Request $request,$id){
        $histories = HistoryMonney::where('wallet_id', $id)->paginate(6);
        $histories->appends($request->all());
        return view('Backend.wallet.transactionHistory',compact('histories'));
    }

    public function withdrawal(){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        return view('Backend.wallet.withdrawal',compact('wallet'));
    }
    public function withdrawalMonney(Request $request){
        $monney_send = $request->send_monney;

        //trừ tài khoản ví.
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        $wallet->monney = $wallet->monney - $monney_send;
        $wallet->note = "Rút tiền";
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = "- ".$monney_send." VNĐ";
        $history->note = $wallet->note;
        $history->wallet_id = $wallet->id;

        $history->save();

        return redirect(route('dashboards.withdrawal'));
    }
}
