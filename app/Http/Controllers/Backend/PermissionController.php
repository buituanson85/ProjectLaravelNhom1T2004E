<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request){
        $permissions = Permission::orderBy('id', 'DESC')->get();
        return view('Backend.administration.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('Backend.administration.permissions.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'url' => 'required',
            'icon' => 'required'
        ]);

        Permission::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'url' => $request->url,
            'icon' => $request ->icon,
            'parent' => $request->parent
        ]);
        return redirect()->route('permissions.index')->with('success', 'Thêm permission thành công!');
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $permission = Permission::find($id);
        return view('Backend.administration.permissions.edit', compact('permissions','permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'url' => 'required',
            'icon' => 'required'
        ]);

        if ($permission = Permission::findOrFail($id)){
            $permission->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'url' => $request->url,
                'icon' => $request ->icon,
                'parent' => $request->parent
            ]);
        }

        return redirect()->route('permissions.index')->with('success', 'Cập nhật permission thành công!');
    }

    public function destroy(Request $request,$id)
    {
        Permission::find($id)->delete();
        $request->session()->flash('error', 'Xóa permission thành công!');
        return redirect(route('permissions.index'));
    }
}
