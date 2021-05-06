<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;

class BrandController extends Controller
{

    public function index()
    {
        $all_brand = Brand::all();
        return view('Backend.brands.index')->with(['all_brand'=>$all_brand]);
    }

    public function create()
    {
        return view('Backend.brands.add_new');
    }

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

    public function show($id)
    {
        //
    }

    public function edit(Request $request,$id)
    {
        $brand = Brand::find($id);
        return view('Backend.brands.update')->with(['brand'=>$brand]);
    }

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

    public function destroy(Request $request,$id)
    {
        Brand::find($id)->delete();
        $request->session()->flash('error','Xóa thương hiệu thành công');
        return redirect(route('brand.index'));
    }
}
