<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_brand = Brand::all();
        return view('Backend.brands.index')->with(['all_brand'=>$all_brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.brands.add_new');
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
            'name' => 'required|unique:brands,name',
            'slug' => 'required',
            'status' => 'required'
        ]);
        $brand = new Brand();
        $brand -> name = $request ->name;
        $brand -> slug = $request ->slug;
        $brand -> status = $request ->status;
        $brand->save();

        $request->session()->flash('success','Thêm mới thương hiệu thành công');
        return redirect(route('brand.index'));

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
        $brand = Brand::find($id);
        return view('Backend.brands.update')->with(['brand'=>$brand]);
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
        $brand = Brand::find($id);
        $brand -> name = $request ->name;
        $brand -> slug = $request ->slug;
        $brand -> status = $request ->status;
        $brand->save();

        $request->session()->flash('success','Cập nhật thương hiệu thành công');
        return redirect(route('brand.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Brand::find($id)->delete();
        $request->session()->flash('error','Xóa thương hiệu thành công');
        return redirect(route('brand.index'));
    }
}
