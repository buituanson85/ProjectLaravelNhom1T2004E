<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GalaxyController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleAddPermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VehiclesController;
use App\Http\Controllers\Frontend\ChooseProduct;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\OrderController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

//xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::resource('/', HomeController::class);
Route::resource('/home', HomeController::class);
Route::resource('/pages/registers',RegisterController::class);
Route::post('/pages/choose-products',[ChooseProduct::class,'index'])->name('pages.chooseproducts');
Route::post('/pages/load-products',[ChooseProduct::class,'loadData'])->name('loadmore.loaddata');

Route::post('/pages/show-products',[ChooseProduct::class,'showProducts'])->name('pages.showproducts');

//đăng ký chủ xe
Route::get('/pages/register-partners',[PartnerController::class,'registerPartners'])->name('pages.registerpartners');
Route::post('/pages/store-partners',[PartnerController::class,'storePartners'])->name('pages.storepartners');

//pages chirend
Route::get('/pages/tutorial', [HomeController::class,'tutorial'])->name('pages.tutorial');
Route::get('/pages/abountus', [HomeController::class,'abountus'])->name('pages.abountus');
Route::get('/pages/promotion', [HomeController::class,'promotion'])->name('pages.promotion');

Route::middleware(['auth:sanctum', 'verified'])->group(function (){
//pages

});

//for admin
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function (){
    Route::resource('/dashboard', DashboardController::class);

    //profile
    Route::get('/dashboards/profile', [ UserController::class, 'profile'])->name('dashboards.profile');
    Route::post('/dashboards/profile', [ UserController::class,'editProfile'])->name('dashboards.updateprofile');

    //password
    Route::get('/dashboards/password/change', [ UserController::class,'getPassword'])->name('dashboards.getpassword');
    Route::post('/dashboards/password/change', [ UserController::class,'editPassword'])->name('dashboards.editpassword');

    //SupperAdmin
    Route::middleware(['auth:sanctum', 'verified','authsupperadmin'])->group(function (){
        //Admin
        Route::resource('/dashboards/permissions', PermissionController::class);
        Route::resource('/dashboards/roles', RoleController::class);
        Route::resource('/dashboards/roles-permissions', RoleAddPermissionController::class);

        //users
        Route::resource('/dashboards/users',UserController::class);
        Route::get('/dashboards/unlockutypeuser/{id}', [ UserController::class, 'unLockutypeUser'])->name('dashboards.unlockutypeuser');
        Route::get('/dashboards/lockutypeuser/{id}', [ UserController::class, 'lockutypeUser'])->name('dashboards.lockutypeuser');
    });
    //Staff
    Route::middleware(['auth:sanctum', 'verified','authstaff'])->group(function (){
        //product
        Route::resource('/dashboards/product',ProductController::class);
    });
    //Support
    Route::middleware(['auth:sanctum', 'verified','authsupport'])->group(function (){
        //Product
        Route::resource('/dashboards/products',VehiclesController::class);
        Route::get('/dashboards/table-products/{id}',[VehiclesController::class,'tableProducts'])->name('dashboards.tableproducts');
        Route::get('/dashboards/show-products/{id}', [VehiclesController::class,'showProduct']);
        Route::get('/dashboards/productunlock/{id}', [VehiclesController::class, 'unlockfeaturedproduct'])->name('dashboards.unlockfeaturedproduct');
        Route::get('/dashboards/productlock/{id}', [VehiclesController::class, 'locksfeaturedproduct'])->name('dashboards.locksfeaturedproduct');

        //confirm
        Route::get('/dashboards/confirm-product',[VehiclesController::class,'confirmProduct'])->name('dashboards.confirmproduct');
        Route::get('/dashboards/show-confirm/{id}',[VehiclesController::class,'showConfirm'])->name('dashboards.showconfirm');
//        Route::get('/dashboards/accept-confirm/{id}',[VehiclesController::class,'acceptConfirm'])->name('dashboards.acceptconfirm');
        Route::get('/dashboards/accept-confirm/{id}',[VehiclesController::class,'acceptProductConfirm'])->name('dashboards.acceptproductconfirm');
        Route::get('/dashboards/refused-confirm/{id}',[VehiclesController::class,'refusedProductConfirm'])->name('dashboards.refusedproductconfirm');

        //admin -->product: để duyệt sản phẩm

        //confirm-register-partner
        Route::get('/dashboards/confirm-partner',[PartnerController::class,'confirmPartner'])->name('pages.confirmpartner');
        Route::post('/dashboards/delete-confirm-partner',[PartnerController::class,'deleteConfirmPartner'])->name('dashboards.deleteconfirmpartner');
        Route::get('/dashboards/confirmlock/{id}', [PartnerController::class, 'confirmlock'])->name('dashboards.confirmlock');
    });
});

//partner
Route::resource('/dashboards/partners',PartnerController::class);
Route::get('/dashboards/partnerunlock/{id}', [PartnerController::class, 'unlockstatustpartner'])->name('dashboards.unlockstatustpartner');
Route::get('/dashboards/partnerlock/{id}', [PartnerController::class, 'lockstatustpartner'])->name('dashboards.lockstatustpartner');

//Galaxy product
Route::resource('/dashboards/product/galaxy',GalaxyController::class);
Route::get('/dashboards/product/galaxys/{id}', [GalaxyController::class, 'galaxys'])->name('dashboards.galaxys');
Route::post('/dashboards/product/galaxys/{id}',[GalaxyController::class, 'store'])->name('dashboards.storegalaxy');
Route::get('/dashboards/product/deletegalaxys/{id}',[GalaxyController::class,'destroys'])->name('dashboards.deletegalaxys');

//partner xác nhận hồ sơ
Route::get('/dashboards/product/acceptProduct/{product_id}', [ProductController::class,'acceptProduct'])->name('product.acceptProduct');
Route::post('/dashboards/product/refuseProduct/{product_id}', [ProductController::class,'refuseProduct'])->name('product.refuseProduct');
Route::post('/dashboards/product/removeProduct/{product_id}', [ProductController::class,'removeProduct'])->name('product.removeProduct');
Route::post('/dashboards/product/reupProduct/{product_id}', [ProductController::class,'reupProduct'])->name('product.reupProduct');



//order
Route::resource('/dashboards/order',OrderController::class);
Route::post('/dashboards/order/acceptOrder/{order_id}', [OrderController::class,'acceptOrder'])->name('order.acceptOrder');
Route::post('/dashboards/order/refuseOrder/{order_id}', [OrderController::class,'refuseOrder'])->name('order.refuseOrder');
Route::get('/dashboards/order/printOrder/{order_id}', [OrderController::class,'printOrder'])->name('order.printOrder');


