<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $list_category = Category::orderBy('id', 'desc')->get();
        return view('Backend.category.index')->with(['list_category'=>$list_category]);
    }

    public function create()
    {
        $list_category = Category::all();
        return view('Backend.category.add_new')->with(['list_category'=>$list_category]);


    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|unique:categories,name',
            'slug' => 'required',
            'status' => 'required'
        ]);
        $all_category = new Category();
        $all_category -> name= $request-> name;
        $all_category -> slug= $request-> slug;
        $all_category -> status= $request-> status;

        $all_category -> save();

        $request->session()->flash('success','Thêm loại danh mục thành công');

        return redirect(route('cate.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cate = Category::find($id);
        return view('Backend.category.update')->with(['cate'=>$cate]);

    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'status' => 'required'
        ]);
        $all_category = Category::find($id);

        $all_category -> name= $request-> name;
        $all_category -> slug= $request-> slug;
        $all_category -> status= $request-> status;

        $all_category -> save();

        $request->session()->flash('success','Cập nhật loại danh mục thành công');

        return redirect(route('cate.index'));
    }

    public function destroy(Request $request,$id)
    {
        Category::find($id)->delete();
        $request->session()->flash('error','Xóa loại danh mục thành công');
        return redirect(route('cate.index'));
    }
}
