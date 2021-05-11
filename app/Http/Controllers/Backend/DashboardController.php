<?php

namespace App\Http\Controllers\Backend;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\Backend\Bankking;
use App\Models\Backend\HistoryMonney;
use App\Models\Backend\Partner;
use App\Models\Backend\Product;
use App\Models\Backend\Role;
use App\Models\Backend\Statistical;
use App\Models\Backend\Visitor;
use App\Models\Backend\Wallet;
use App\Models\Frontend\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        //bảng thống kê truy cập.
        $user_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

        $onlyear = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        // tổng tháng trước.
        $visitor_of_lastmonth = Visitor::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->orderBy('date_visitor','ASC')->get();
        $visitor_lastmonth_count = $visitor_of_lastmonth->count();
        //tổng tháng này
        $visitor_of_thismonth = Visitor::whereBetween('date_visitor',[$early_this_month,$now])->orderBy('date_visitor','ASC')->get();
        $visitor_thismonth_count = $visitor_of_thismonth->count();
        //Tổng một năm
        $visitor_of_year = Visitor::whereBetween('date_visitor',[$onlyear,$now])->orderBy('date_visitor','ASC')->get();
        $visitor_year_count = $visitor_of_year->count();
        //Tổng truy cập.
        $visitors = Visitor::all();
        $visitors_total = $visitors->count();
        //tổng online
        $visitor_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_current->count();
        if ($visitor_count < 1){
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        //hiển thị các ô
        $order_xn = Order::where('status','pending')->get()->count();
        $order_xh = Order::where([
            ['status','delete'],
            ['confirm','0'],
        ])->orwhere([
            ['status','cancelled'],
            ['confirm','0'],
        ])->get()->count();
        $partners = Partner::where('status','outofstock')->orderBy('id','DESC')->get()->count();
        $products = Product::where('status', 'pending')->orderBy('id','DESC')->get()->count();
        $histories = HistoryMonney::where('status', "pending")->orderBy('id','desc')->get()->count();
        $bankings = Bankking::where('status','pending')->orderBy('id','desc')->get()->count();
        $wallets = Wallet::where('monney_confirm','!=',null)->orderBy('id','desc')->count();

        $users = User::select(DB::raw("COUNT(*) as count"))
            ->where('utype','USR')
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        $months = User::select(DB::raw("Month(created_at) as month"))
            ->where('utype','USR')
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($months as $index => $month){
            $datas[$month] = $users[$index];
        }

        //thống kê chung.
        $product_tk = Product::where([
            ['status','!=', 'refused'],
            ['status','!=', 'pending'],
            ['status','!=', 'unavailable']
        ])->get()->count();
        $admin_tk = User::where('utype','ADM')->get()->count();
        $partner_tk = User::where('utype','PTR')->get()->count();
        $customer_tk = User::where('utype','USR')->get()->count();
        $order_tk = Order::all()->count();

        $user_id = User::find(Auth::user()->id);
//        $roles = Role::with($user_id)->get();
//        dd($roles);

        $order_count = null;
        $get_orders = Order::all();
        $array_id = [];
        foreach ($get_orders as $order) {
            if ($order->orderdetails->product->partner_id == Auth::user()->id) {
                $array_id[] = $order->id;
            }
        }
        $order_pendding = Order::where('status', 'pending')->findMany($array_id)->count();

//        dd($order_dt);
        $order_count = Order::select(DB::raw("count(*) as count"))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->findMany($array_id)->pluck('count');
//        dd($order_count);
        $months_order = Order::select(DB::raw("Month(created_at) as month"))
            ->where('status', 'completed')
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))->findMany($array_id)
            ->pluck('month');
        $datas_order = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach ($months_order as $index => $month){
            $datas_order[$month] = $order_count[$index];
        }
//        dd($datas_order);

        //lấy thnags
        $listDay = Date::getListDayInMounth();
//        dd($listDay);
        //doanh thu data
        $order_count = null;
        $array_dto = [];
        foreach ($get_orders as $order) {
            if ($order->orderdetails->product->partner_id == Auth::user()->id) {
                $array_dto[] = $order->id;
            }
        }
        $order_dt = Order::where('status', 'completed')
            ->whereMonth('created_at',date('m'))
            ->select(DB::raw("SUM(price_total) as sum"), DB::raw('DATE(created_at) day'))
            ->groupBy('day')->findMany($array_dto)->toArray();
//        dd($order_dt);
        $array_dt = [];
        $total = 0;
        foreach ($listDay as $day){
            foreach ($order_dt as $key => $value){
                $total = 0;
                if ($value['day'] == $day){
                    $total = $value['sum'];
                    break;
                }
            }
            $array_dt[] = ($total*0.95)/1000000;
        }
//        dd($array_dt);
        //đối tác theo năm
        $new_partner = User::select(DB::raw("COUNT(*) as count"))
            ->where('utype','PTR')
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        $months_ptr = User::select(DB::raw("Month(created_at) as month"))
            ->where('utype','PTR')
            ->whereYear('created_at',date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $datas_ptr = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($months_ptr as $index => $month_ptr){
            $datas_ptr[$month_ptr] = $new_partner[$index];
        }
//        dd($datas_ptr);
//        dd($array_dt);
//        dd($order_dt);
        $viewData = [
            'partners'=> $partners,
            'products'=> $products,
            'histories'=> $histories,
            'bankings'=> $bankings,
            'wallets'=> $wallets,
            'visitor_count'=> $visitor_count,
            'visitor_year_count'=> $visitor_year_count,
            'visitors_total'=> $visitors_total,
            'product_tk'=> $product_tk,
            'partner_tk'=> $partner_tk,
            'visitor_lastmonth_count'=> $visitor_lastmonth_count,
            'visitor_thismonth_count'=> $visitor_thismonth_count,
            'admin_tk'=> $admin_tk,
            'customer_tk'=> $customer_tk,
            'order_tk'=> $order_tk,
            'user_id'=> $user_id,
            'datas_order'=> $datas_order,
            'order_pendding'=> $order_pendding,
            'order_xn'=> $order_xn,
            'order_xh'=> $order_xh,
            'order_dt'=> json_encode($order_dt),
            'listDay' => json_encode($listDay),
            'datas' => json_encode($datas),
            'array_dt'=>json_encode($array_dt),
            'datas_ptr' => json_encode($datas_ptr)
        ];
        return view('Backend.dashboard', $viewData);
    }

    public function filterByDate(Request $request){
        $data = $request->all();
        $form_date = $data['form_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date',[$form_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val){
            $chart_date[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_date);
    }

    public function daysOrder(Request $request){
        $sub30day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date',[$sub30day,$now])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val){
            $chart_date[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_date);
    }

    public function dashboardFilter(Request $request){
        $data = $request->all();

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if ($data['dashboash_value'] == '7ngay'){
            $get = Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboash_value'] == 'thangtruoc'){
            $get = Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif ($data['dashboash_value'] == 'thangnay'){
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }

        foreach ($get as $key => $val){
            $chart_date[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_date);
    }
}
