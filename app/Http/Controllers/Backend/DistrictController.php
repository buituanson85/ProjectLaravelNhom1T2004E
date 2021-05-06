<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\City;
use App\Models\Backend\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $all_district = District::all();
        $city = City::all();
        return view('Backend.districts.index')->with(['all_district'=>$all_district,'city'=>$city]);
    }

    public function create()
    {
        $city = City::where('status','instock')->get();
        return view('Backend.districts.add_new')->with(['city'=>$city]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:districts,name',
            'slug' => 'required',
            'status' => 'required'
        ]);
        $district = new District();
        $district -> name = $request ->name;
        $district -> slug = $request ->slug;
        $district -> location = $request ->location;
        $district -> status = $request ->status;
        $district -> city_id = $request ->city;

        $district->save();

        $request->session()->flash('success','Thêm mới quận huyện thành công');
        return redirect(route('district.index'));

    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $city = City::where('status','instock')->get();
        $district = District::find($id);
        return view('Backend.districts.update')->with(['district'=>$district,'city'=>$city]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'status' => 'required'
        ]);

        $district = District::find($id);

        $district -> name = $request ->name;
        $district -> slug = $request ->slug;
        $district -> location = $request ->location;
        $district -> status = $request ->status;
        $district -> city_id = $request ->city;

        $district->save();
        $request->session()->flash('success','Cập nhật quận huyện thành công');
        return redirect(route('district.index'));
    }

    public function destroy(Request $request,$id)
    {
        District::find($id)->delete();
        $request->session()->flash('error','Xóa quận huyện thành công');
        return redirect(route('district.index'));
    }
}
