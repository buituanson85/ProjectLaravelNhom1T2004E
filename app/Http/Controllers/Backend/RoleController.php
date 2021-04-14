<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Permission;
use App\Models\Backend\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        $permissions = Permission::all();
        return View('Backend.administration.roles.index')->with(array('roles'=>$roles,'permissions'=>$permissions));
    }

    public function create()
    {
        return view('Backend.administration.roles.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'title' => 'required'
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title
        ]);
        return redirect()->route('roles.index')->with('success', 'Roles Created Successfully!');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('Backend.administration.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'title' => 'required'
        ]);
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title
        ]);
        $request->session()->flash('success', 'Roles Update Successfully!');
        return redirect(route('roles.index'));
    }

    public function destroy(Request $request,$id)
    {
        Role::find($id)->delete();
        $request->session()->flash('success', 'Delete roles success!');
        return redirect(route('roles.index'));
    }
}
