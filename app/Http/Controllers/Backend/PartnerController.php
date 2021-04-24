<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\SendMailRegisterPartner;
use App\Models\Backend\Partner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PartnerController extends Controller
{
    //pages

    public function registerPartners(){
        return view('Frontend.policy');
    }

    public function storePartners(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'title' => 'required',
            'note' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        $partner = new Partner();

        $partner->name = $request->name;
        $partner->phone = $request->phone;
        $partner->email = $request->email;
        $partner->address = $request->address;
        $partner->title = $request->title;
        $partner->note = $request->note;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $email = $request->email;
        $date = "Date: ".''.$now;
        $partners = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'title' => $request->title,
            'note' => $request->note,
            'date' => $date
        ];

        Mail::to($email)->send(new SendMailRegisterPartner($partners));

        $partner->save();
        $request->session()->flash('success', 'Partner Create Successfully!');
        return view('Frontend.policy');
    }

    public function confirmPartner(Request $request){
        $partners = Partner::where('status','outofstock')->orderBy('id','DESC')->paginate(5);
        $partners->appends($request->all());
        return view('Backend.administration-partner.table-confirm-register-partner', compact('partners'));
    }

    public function deleteConfirmPartner(Request $request){
        $id =$request->partner_id;
        Partner::find($id)->delete();
        $request->session()->flash('success', 'Delete Confirm success!');
        return redirect(route('pages.confirmpartner'));
    }

    public function confirmlock(Request $request,$id){
        $partner = Partner::find($id);
        Partner::where('id', $id)->update (['status'=> "instock"]);
        $request->session()->flash('success', 'Update instock partner success!');
        return redirect(route('pages.confirmpartner'));
    }
}
