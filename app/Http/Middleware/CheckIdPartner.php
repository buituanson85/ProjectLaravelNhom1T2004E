<?php

namespace App\Http\Middleware;

use App\Models\Backend\Product;
use App\Models\Backend\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIdPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $users = User::with('roles')->get();
            $roles = Role::with('users','permissions')->get();
            $products = Product::all();
            foreach ($users as $user){
                if ($user->id === Auth::user()->id){
                    foreach ($user->roles as $role){
                        if ($role->name === "Partner" || $role->name === "Admin"){
                            foreach ($products as $product){
                                if ($products->partner_id === Auth::user()->id){
                                    return $next($request);
                                }else{
                                    return redirect(route('dashboard.index'));
                                }
                            }
                        }else{
                            return redirect(route('dashboard.index'));
                        }
                    }
                }
            }
        }else{
            return redirect('login');
        }
        return $next($request);
    }
}
