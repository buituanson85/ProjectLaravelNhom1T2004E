<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $utype = $request->utype;
        $allRole = Role::all();

        if (isset($name) && isset($utype)){
            $users = User::where('name', 'like','%'.$name.'%')->where('utype', $utype)->paginate(5);
            $users->appends($request->all());
        }elseif (isset($name)){
            $users = User::where('name','like','%'.$name.'%')->paginate(5);
            $users->appends($request->all());
        }elseif (isset($utype)){
            $users = User::where('utype', $utype)->paginate(5);
            $users->appends($request->all());
        }else{
            $users = User::paginate(5);
        }

        return view('Backend.administration.users.index')->with(array('users'=>$users, 'utype' => $utype));

    }

    public function create()
    {
        $roles = Role::all();
        return view('Backend.administration.users.create', compact( 'roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users',
            'password' => 'required|alpha_num|min:6',
            'password_confirmation' => 'required|alpha_num|min:6',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        $user = new User();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->save();

        $request->session()->flash('success', 'Users Create Successfully!');
        return redirect()->route('users.index');
    }

//
    public function show($id)
    {
        $users = User::find($id);
        $users ->with('roles')->get();
        $roles = Role::with('users','permissions')->get();
        return view('Backend.administration.users.show')->with(array('users'=>$users,'roles'=>$roles));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $user ->with('roles')->get();
        return view('Backend.administration.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user_id = $request->id;

        $user = User::find($user_id);
        $checkUser = User::where('id',$user_id)->withCount('roles')->get()->toArray();
        if($checkUser[0]['roles_count']>0){
            $user->roles()->detach();//delete all relationship in role_permission
        }
        $user->roles()->attach($request->roles);//add list permissions
        $user ->with('roles')->get();
        return redirect()->route('users.index')->with('success', 'User Edit Successfully!');
    }

    public function destroy(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $request->session()->flash('success', 'Users Deleted Successfully!');
        return redirect(route('users.index'));
    }

//    /////////////////// User defined Method

    public function  profile(){
        return view('Backend.administration.profile.index');
    }

    public function editProfile(Request $request){
        //dd($request->all());
        $user = auth()->user();
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required|alpha_num',
            'address' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($request ->image != null){
            $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

            $options = array('http' =>array(
                'method' => "POST",
                'header' => "Authorization: Bearer 3597bf9393d8155003c84329d6205961426482fc\n".
                    "Content-Type: application/x-www-form-urlencoded",
                'content' => $image
            ));
            $context = stream_context_create($options);
            $imgurURL = "https://api.imgur.com/3/image";

            $response = file_get_contents($imgurURL, false, $context);
            $response = json_decode($response);
            $msg = $response->data->link;
            $user -> profile_photo_path = $msg;
        }

        $user->save();

        return redirect()->back()->with('success','Profile has been Updated Successfully!');
    }

    public function getPassword(){
        return view('Backend.administration.profile.password');
    }

    public function editPassword(Request $request){
        $this->validate($request, [
            'newpassword' =>'required|min:6|max:30|confirmed'
        ]);
        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->newpassword)
        ]);

        return redirect()->back()->with('success', 'Password has been Changed Successfully');
    }

    public function registers(Request $request){
        $user = auth()->user();



        $request->session()->flash('success', 'Users Create Successfully!');
        return redirect()->route('users.index');
    }

    public function unlockutypeuser(Request $request,$id){
        $user = User::find($id);
        User::where('id', $id)->update (['utype'=> "USR"]);
        $request->session()->flash('success', 'Update utype uses success!');
        return redirect(route('users.index'));
    }

    public function lockutypeUser(Request $request,$id){
        $user = User::find($id);
        User::where('id', $id)->update (['utype'=> "ADM"]);
        $request->session()->flash('success', 'Update utype uses success!');
        return redirect(route('users.index'));
    }
}
