<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleAddPermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\ChooseProduct;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', HomeController::class);
Route::resource('/homes', HomeController::class);
Route::resource('/pages/registers',UserController::class);
Route::post('/pages/choose-products',[ChooseProduct::class,'index'])->name('pages.chooseproducts');
Route::post('/pages/show-products',[ChooseProduct::class,'showProducts'])->name('pages.showproducts');
Route::get('/pages/register-partners',[PartnerController::class,'registerPartners'])->name('pages.registerpartners');


Route::middleware(['auth:sanctum', 'verified'])->group(function (){
//pages

});

//for admin
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function (){
    Route::resource('/dashboard', DashboardController::class);
    //Admin
    Route::resource('/dashboards/permissions', PermissionController::class);
    Route::resource('/dashboards/roles', RoleController::class);
    Route::resource('/dashboards/roles-permissions', RoleAddPermissionController::class);

    //users
    Route::resource('/dashboards/users',UserController::class);
    Route::get('/dashboards/unlockutypeuser/{id}', [ UserController::class, 'unLockutypeUser'])->name('dashboards.unlockutypeuser');
    Route::get('/dashboards/lockutypeuser/{id}', [ UserController::class, 'lockutypeUser'])->name('dashboards.lockutypeuser');
    //profile
    Route::get('/dashboards/profile', [ UserController::class, 'profile'])->name('dashboards.profile');
    Route::post('/dashboards/profile', [ UserController::class,'editProfile'])->name('dashboards.updateprofile');

    //password
    Route::get('/dashboards/password/change', [ UserController::class,'getPassword'])->name('dashboards.getpassword');
    Route::post('/dashboards/password/change', [ UserController::class,'editPassword'])->name('dashboards.editpassword');

    //SupperAdmin
    Route::middleware(['auth:sanctum', 'verified','authsupperadmin'])->group(function (){

    });
    //Staff
    Route::middleware(['auth:sanctum', 'verified','authstaff'])->group(function (){

    });
    //Support
    Route::middleware(['auth:sanctum', 'verified','authsupport'])->group(function (){

    });




    //product
    Route::resource('/dashboards/product',ProductController::class);
    Route::post('/dashboards/product/removeProduct/{product_id}', [ProductController::class,'removeProduct'])->name('product.removeProduct');
    Route::post('/dashboards/product/reupProduct/{product_id}', [ProductController::class,'reupProduct'])->name('product.reupProduct');

    //admin -->product: để duyệt sản phẩm
    Route::post('/dashboards/product/acceptProduct/{product_id}', [ProductController::class,'acceptProduct'])->name('product.acceptProduct');
    Route::post('/dashboards/product/refuseProduct/{product_id}', [ProductController::class,'refuseProduct'])->name('product.refuseProduct');
    //order
    Route::resource('/dashboards/order',OrderController::class);
    Route::post('/dashboards/order/acceptOrder/{order_id}', [OrderController::class,'acceptOrder'])->name('order.acceptOrder');
    Route::post('/dashboards/order/refuseOrder/{order_id}', [OrderController::class,'refuseOrder'])->name('order.refuseOrder');
    Route::get('/dashboards/order/printOrder/{order_id}', [OrderController::class,'printOrder'])->name('order.printOrder');

});
