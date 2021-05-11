<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\SendPayMonneyWaiting;
use App\Models\Backend\Bankking;
use App\Models\Backend\HistoryMonney;
use App\Models\Backend\Product;
use App\Models\Backend\Wallet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function index(){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        $count_product_xemay = Product::where([
            ['partner_id', $user_id->id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 1]
        ])->get()->count();
        $count_product_oto = Product::where([
            ['partner_id',$user_id->id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 2]
        ])->get()->count();
        $duytri = $count_product_oto*500000 + $count_product_xemay*100000;
//        dd($duytri);
        return view('Backend.wallet.index', compact('wallet','duytri'));
    }

    public function tutorialMonney($id){
        $wallet = Wallet::find($id);
        return view('Backend.wallet.tutorialMonney',compact('wallet'));
    }

    public function transactionHistory(Request $request,$id){
        $wallet_id = $id;
        $histories = HistoryMonney::where('wallet_id', $id)->orderBy('id','desc')->get();

        return view('Backend.wallet.transactionHistory',compact('histories','wallet_id'));
    }

    public function withdrawal(){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();

        $count_product_xemay = Product::where([
            ['partner_id', $user_id->id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 1]
        ])->get()->count();
        $count_product_oto = Product::where([
            ['partner_id',$user_id->id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 2]
        ])->get()->count();
        $duytri = $count_product_oto*500000 + $count_product_xemay*100000;

        return view('Backend.wallet.withdrawal',compact('wallet','duytri'));
    }
    public function withdrawalMonney(Request $request){
        $user_id = User::find(\auth()->user()->id);
        $wallet = Wallet::where('partner_id',$user_id->id)->first();
        $monney_send = $request->send_monney;

        $count_product_xemay = Product::where([
            ['partner_id', $user_id->id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 1]
        ])->get()->count();
        $count_product_oto = Product::where([
            ['partner_id',$user_id->id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 2]
        ])->get()->count();
        $duytri = $count_product_oto*500000 + $count_product_xemay*100000;

        if ($monney_send >=50000){
            $total = $wallet->monney - $monney_send;
            if ($total >= $duytri){
                //trừ tài khoản ví.
                $wallet->monney = $total;
                $wallet->note = "Rút tiền";
                $wallet->save();

                //thêm vào lịch sử giao dịch
                $history = new HistoryMonney();
                $history->trading_code = Str::random(8);
                $history->send_monney = $monney_send;
                $history->note = $wallet->note;
                $history->wallet_id = $wallet->id;
                $history->status = "pending";
                $history->save();
            }else{
                return redirect()->back()->with('error','Tài khoản không đủ tiền');
            }
        }else{
            return redirect()->back()->with('error','Số tiền rút vui lòng lớn hơn 50000');
        }

        $request->session()->flash('success', 'Rút tiền thành công!');
        return redirect(route('dashboards.withdrawal'));
    }

    public function walletPartners(Request $request){
        $name = $request->name;
        if (isset($name)){
            $histories = HistoryMonney::where([
                ['status', "pending"],
                ['trading_code', 'like','%'.$name.'%']
            ])->orderBy('id','desc')->paginate(6);
            $histories->appends($request->all());
        }else{
            $histories = HistoryMonney::where('status', "pending")->orderBy('id','desc')->paginate(6);
            $histories->appends($request->all());
        }
        return view('Backend.adminnistration-wallets.wallet-partners',compact('histories'));
    }

    public function sendWallet(Request $request){
        $bankings = Bankking::where('status','pending')->orderBy('id','desc')->get();
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
        $history->send_monney = $banking->monney;
        $history->note = $banking->note."+ Gửi tiền từ ngân hàng".$banking->bank;
        $history->wallet_id = $wallet->id;

        $history->save();
        $banking->status = "accept";
        $banking->save();
        $request->session()->flash('success', 'Cộng tiền thành công!');

        $count_product_xemay = Product::where([
            ['partner_id', $wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 1]
        ])->get()->count();
        $count_product_oto = Product::where([
            ['partner_id',$wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 2]
        ])->get()->count();
        $duytri = $count_product_oto*500000 + $count_product_xemay*100000;

        $open_products = Product::where([
            ['partner_id',$wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
        ])->get();

        if ($wallet->monney >= $duytri){
            foreach ($open_products as $open_product){
                $open = Product::find($open_product->id);
                $open->featured = 0;
                $open->save();
            }
        }
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
        $history->send_monney = $banking->monney;
        $history->note = $banking->note."+ Gửi tiền từ ngân hàng".$banking->bank;
        $history->wallet_id = $wallet->id;
        $history->save();

        $banking->status = "accept";
        $banking->save();
        $request->session()->flash('success', 'Cộng tiền thành công!');

        $count_product_xemay = Product::where([
            ['partner_id', $wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 1]
        ])->get()->count();
        $count_product_oto = Product::where([
            ['partner_id',$wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 2]
        ])->get()->count();
        $duytri = $count_product_oto*500000 + $count_product_xemay*100000;

        $open_products = Product::where([
            ['partner_id',$wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
        ])->get();

        if ($wallet->monney >= $duytri){
            foreach ($open_products as $open_product){
                $open = Product::find($open_product->id);
                $open->featured = 0;
                $open->save();
            }
        }
        return redirect(route('dashboards.sendwallet'));
    }

    public function moneyWaiting(Request $request){
        $wallets = Wallet::where('monney_confirm','!=',null)->orderBy('id','desc')->get();
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
        $history->send_monney = $send_monney;
        $history->note = "Tiền khách hàng thanh toán qua thẻ";
        $history->wallet_id = $wallet->id;
        $history->save();

        $count_product_xemay = Product::where([
            ['partner_id', $wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 1]
        ])->get()->count();
        $count_product_oto = Product::where([
            ['partner_id',$wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
            ['category_id', 2]
        ])->get()->count();
        $duytri = $count_product_oto*500000 + $count_product_xemay*100000;

        $open_products = Product::where([
            ['partner_id',$wallet->partner_id],
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable'],
        ])->get();

        if ($wallet->monney >= $duytri){
            foreach ($open_products as $open_product){
                $open = Product::find($open_product->id);
                $open->featured = 0;
                $open->save();
            }
        }
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

        if ($request->monney >= 200000){
            //Cộng tài khoản ví.
            $wallet->monney = $total;
            $wallet->save();

            //thêm vào lịch sử giao dịch
            $history = new HistoryMonney();
            $history->trading_code = Str::random(8);
            $history->send_monney = $request->monney;
            $history->note = " Gửi tiền ";
            $history->wallet_id = $wallet->id;
            $history->save();

            $request->session()->flash('success', 'Nạp tiền thành công!');
            return redirect()->back()->with('success','Nạp tiền thành công');
        }else{
            $request->session()->flash('error', 'Nạp tiền thất bại(số tiền phải >= 200.000 VNĐ)!');
            return redirect()->back()->with('error','Nạp tiền thất bại(số tiền phải >= 200.000 VNĐ)!');
        }
    }
    public function payMoneyWaiting(Request $request,$id){
        $history = HistoryMonney::find($id);
        $history->status = "accept";

        $wallet = Wallet::find($history->wallet_id);
        $user = User::find($wallet->partner_id);

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $user->email;
        $date = "Date: ".''.$now;
        $histories = [
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'trading_code' => $history->account,
            'account' => $wallet->account,
            'monney_pay' => $history->send_monney,
            'monney' => $wallet->monney,
            'date' => $date
        ];

        Mail::to($email)->send(new SendPayMonneyWaiting($histories));
        $history->save();
        $request->session()->flash('success', 'Chuyển tiền thành công!');
        return redirect(route('dashboards.walletpartners'));
    }
}
