<?php

namespace App\Providers;

use App\Models\Backend\Product;
use App\Models\Frontend\Order;
use App\Models\Frontend\OrderDetails;
use App\Models\User;
use App\Policies\OrderDetailsPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        OrderDetails::class => OrderDetailsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('access-product', function (User $user, Product $product) {
//            $flag = false;
//            if($user->id === $product->partner_id || $user->roles->where('role_id', 1)->first() != null){
//                $flag = true;
//            }
//            return true;
//        });
    }
}
