<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $name = $request->table_search;
        if (!isset($name)){
            $list_category = Category::all();
        }else if(isset($name)){
            $list_category = Category::where('name','like','%'.$name.'%')->paginate(2);
        }

        return view('Backend.category.index')->with(['list_category'=>$list_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_category = Category::all();
        return view('Backend.category.add_new')->with(['list_category'=>$list_category]);


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
    public function edit($id)
    {
        $cate = Category::find($id);
        return view('Backend.category.update')->with(['cate'=>$cate]);

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
        $all_category = Category::find($id);

        $all_category -> name= $request-> name;
        $all_category -> slug= $request-> slug;
        $all_category -> status= $request-> status;

        $all_category -> save();

        $request->session()->flash('success','Cập nhật loại danh mục thành công');

        return redirect(route('cate.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Category::find($id)->delete();
        $request->session()->flash('error','Xóa loại danh mục thành công');
        return redirect(route('cate.index'));
    }
}
