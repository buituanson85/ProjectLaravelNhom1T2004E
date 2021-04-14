<?php

namespace App\Providers;

use App\Models\Backend\Role;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $users = User::with('roles')->get();
        $roles = Role::with('users','permissions')->get();

        View::share(array('users'=>$users));
        View::share(array('roles'=>$roles));
    }
}
