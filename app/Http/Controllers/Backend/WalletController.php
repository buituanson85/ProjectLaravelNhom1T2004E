<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Bankking;
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
        $histories = HistoryMonney::where('wallet_id', $id)->orderBy('id','desc')->paginate(6);
        $histories->appends($request->all());
        return view('Backend.wallet.transactionHistory',compact('histories'));
    }

    public function withdrawal(){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        return view('Backend.wallet.withdrawal',compact('wallet'));
    }
    public function withdrawalMonney(Request $request){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        $monney_send = $request->send_monney;
        $total = $wallet->monney - $monney_send;
        if ($total >= 500000){
            //trừ tài khoản ví.
            $wallet->monney = $total;
            $wallet->note = "Rút tiền";
            $wallet->save();

            //thêm vào lịch sử giao dịch
            $history = new HistoryMonney();
            $history->trading_code = Str::random(8);
            $history->send_monney = "- ".$monney_send." VNĐ";
            $history->note = $wallet->note;
            $history->wallet_id = $wallet->id;
            $history->status = "pending";
            $history->save();
        }else{
            return redirect()->back()->with('error','Tài khoản không đủ tiền');
        }
        return redirect(route('dashboards.withdrawal'));
    }

    public function walletPartners(Request $request){
        $histories = HistoryMonney::where('status', "pending")->orderBy('id','desc')->paginate(6);
        $histories->appends($request->all());
        return view('Backend.adminnistration-wallets.wallet-partners',compact('histories'));
    }

    public function sendWallet(Request $request){
        $bankings = Bankking::where('status','pending')->orderBy('id','desc')->paginate(6);
        $bankings->appends($request->all());
        return view('Backend.adminnistration-wallets.send-wallet',compact('bankings'));
    }

    public function sendWalletOne(Request $request,$id){

        $banking = Bankking::find($id);
        $wallet = Wallet::where('account', $banking->account)->first();

        $total = $wallet->monney + $banking->monney;

        //Cộng tài khoản ví.
        $wallet->monney = $total;
        $wallet->note = $banking->note."Gửi tiền từ ngân hàng".$banking->bank;
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = "+ ".$banking->monney." VNĐ";
        $history->note = $banking->note."+ Gửi tiền từ ngân hàng".$banking->bank;
        $history->wallet_id = $wallet->id;

        $history->save();
        $banking->status = "accept";
        $banking->save();
        $request->session()->flash('success', 'Cộng tiền thành công!');
        return redirect(route('dashboards.sendwallet'));
    }

    public function sendWalletTwo(Request $request,$id){
        $banking = Bankking::find($id);
        $phone = substr($banking->note, 0, 10);
        $email = substr($banking->note, 11,100);
        $user = User::where([
            ['phone', $phone],
            ['email', $email]
        ])->first();
        $wallet = Wallet::where('partner_id', $user->id)->first();

        $total = $wallet->monney + $banking->monney;

        //Cộng tài khoản ví.
        $wallet->monney = $total;
        $wallet->note = $banking->note."Gửi tiền từ ngân hàng".$banking->bank;
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = "+ ".$banking->monney." VNĐ";
        $history->note = $banking->note."+ Gửi tiền từ ngân hàng".$banking->bank;
        $history->wallet_id = $wallet->id;
        $history->save();

        $banking->status = "accept";
        $banking->save();
        $request->session()->flash('success', 'Cộng tiền thành công!');
        return redirect(route('dashboards.sendwallet'));
    }

    public function moneyWaiting(Request $request){
        $wallets = Wallet::where('monney_confirm','!=',null)->orderBy('id','desc')->paginate(6);
        $wallets->appends($request->all());
        return view('Backend.adminnistration-wallets.money-waiting', compact('wallets'));
    }

    public function sendMoneyWaiting(Request $request,$id){
        $wallet = Wallet::find($id);
        $total = $wallet->monney + $wallet->monney_confirm;
        $send_monney = $wallet->monney_confirm;
        $wallet->monney_confirm = null;
        //Cộng tài khoản ví.
        $wallet->monney = $total;
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = "+ ".$send_monney." VNĐ";
        $history->note = "tiền khách hàng thanh toán qua thẻ";
        $history->wallet_id = $wallet->id;
        $history->save();

        $request->session()->flash('success', 'Cộng tiền thành công!');
        return redirect(route('dashboards.moneywaiting'));
    }

    public function sendMoneys(){
        return view('Backend.adminnistration-wallets.send-moneys');
    }

    public function sendMoney(Request $request){
        $phone = $request->phone;
        $email = $request->email;
        $user = User::where([
            ['phone', $phone],
            ['email', $email]
        ])->first();
        $wallet = Wallet::where('partner_id', $user->id)->first();

        $total = $wallet->monney + $request->monney;

        //Cộng tài khoản ví.
        $wallet->monney = $total;
        $wallet->save();

        //thêm vào lịch sử giao dịch
        $history = new HistoryMonney();
        $history->trading_code = Str::random(8);
        $history->send_monney = "+ ".$request->monney." VNĐ";
        $history->note = " Gửi tiền ";
        $history->wallet_id = $wallet->id;
        $history->save();

        $request->session()->flash('success', 'Nạp tiền thành công!');
        return redirect()->back()->with('success','Nạp tiền thành công');
    }
}
