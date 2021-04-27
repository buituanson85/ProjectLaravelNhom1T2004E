<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\City;
use App\Models\Backend\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_district = District::all();
        $city = City::all();
        return view('Backend.districts.index')->with(['all_district'=>$all_district,'city'=>$city]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        return view('Backend.districts.add_new')->with(['city'=>$city]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $request->session()->flash('success','Add new success');
        return redirect(route('district.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $city = City::all();
        $district = District::find($id);
        return view('Backend.districts.update')->with(['district'=>$district,'city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        dd($district);
        $request->session()->flash('success','Update new success');
        return redirect(route('district.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        District::find($id)->delete();
        $request->session()->flash('success','Update new success');
        return redirect(route('district.index'));
    }
}
