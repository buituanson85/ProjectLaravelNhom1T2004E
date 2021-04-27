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
use App\Http\Controllers\Backend\WalletController;
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

Route::get('/pages/show-products/{id}',[ChooseProduct::class,'showProducts'])->name('pages.showproducts');

//đăng ký chủ xe
Route::get('/pages/register-partners',[PartnerController::class,'registerPartners'])->name('pages.registerpartners');
Route::post('/pages/store-partners',[PartnerController::class,'storePartners'])->name('pages.storepartners');

//pages chirend
Route::get('/pages/tutorial', [HomeController::class,'tutorial'])->name('pages.tutorial');
Route::get('/pages/abountus', [HomeController::class,'abountus'])->name('pages.abountus');
Route::get('/pages/promotion', [HomeController::class,'promotion'])->name('pages.promotion');
Route::get('/pages/camnang', [HomeController::class,'camnang'])->name('pages.camnang');
Route::get('/pages/hoanhuy', [HomeController::class,'hoanhuy'])->name('pages.hoanhuy');
Route::get('/pages/hopdong', [HomeController::class,'hopdong'])->name('pages.hopdong');
Route::get('/pages/khieunai', [HomeController::class,'khieunai'])->name('pages.khieunai');
Route::get('/pages/baomat', [HomeController::class,'baomat'])->name('pages.baomat');
Route::get('/pages/service', [HomeController::class,'service'])->name('pages.service');

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
        Route::get('/dashboards/show-products/{id}', [VehiclesController::class,'showProduct'])->name('dashboards.showproduct');

        Route::get('/dashboards/productunlock/{id}', [VehiclesController::class, 'unlockfeaturedproduct'])->name('dashboards.unlockfeaturedproduct');
        Route::get('/dashboards/productlock/{id}', [VehiclesController::class, 'locksfeaturedproduct'])->name('dashboards.locksfeaturedproduct');

        //confirm
        Route::get('/dashboards/confirm-product',[VehiclesController::class,'confirmProduct'])->name('dashboards.confirmproduct');
        Route::get('/dashboards/show-confirm/{id}',[VehiclesController::class,'showConfirm'])->name('dashboards.showconfirm');
//        Route::get('/dashboards/accept-confirm/{id}',[VehiclesController::class,'acceptConfirm'])->name('dashboards.acceptconfirm');
        Route::get('/dashboards/accept-confirm/{id}',[VehiclesController::class,'acceptProductConfirm'])->name('dashboards.acceptproductconfirm');
        Route::get('/dashboards/refused-confirm/{id}',[VehiclesController::class,'refusedProductConfirm'])->name('dashboards.refusedproductconfirm');

        //quản lý ví tiền
        Route::get('/dashboards/wallet-partners',[WalletController::class,'walletPartners'])->name('dashboards.walletpartners');
        Route::get('/dashboards/send-wallet',[WalletController::class,'sendWallet'])->name('dashboards.sendwallet');
        Route::get('/dashboards/send-wallet-one/{id}',[WalletController::class,'sendWalletOne'])->name('dashboards.sendwalletone');
        Route::get('/dashboards/send-wallet-two/{id}',[WalletController::class,'sendWalletTwo'])->name('dashboards.sendwallettwo');
        Route::get('/dashboards/money-waiting',[WalletController::class,'moneyWaiting'])->name('dashboards.moneywaiting');
        Route::get('/dashboards/send-money-waiting/{id}',[WalletController::class,'sendMoneyWaiting'])->name('dashboards.sendmoneywaiting');
        Route::get('/dashboards/pay-money-waiting/{id}',[WalletController::class,'payMoneyWaiting'])->name('dashboards.paymoneywaiting');

        //Nạp tiền thủ công.

        Route::get('/dashboards/send-moneys',[WalletController::class,'sendMoneys'])->name('dashboards.sendmoneys');
        Route::post('/dashboards/send-money',[WalletController::class,'sendMoney'])->name('dashboards.sendmoney');
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

//Ví tài xế

Route::resource('/dashboards/wallet',WalletController::class);
Route::get('/dashboards/tutorialMonney/{id}',[WalletController::class,'tutorialMonney'])->name('dashboards.tutorialmonney');
Route::get('/dashboards/transactionHistory/{id}',[WalletController::class,'transactionHistory'])->name('dashboards.transactionhistory');
Route::get('/dashboards/withdrawal',[WalletController::class,'withdrawal'])->name('dashboards.withdrawal');
Route::post('/dashboards/withdrawalMonney',[WalletController::class,'withdrawalMonney'])->name('dashboards.withdrawalmonney');

//order
Route::resource('/dashboards/order',OrderController::class);
Route::post('/dashboards/order/acceptOrder/{order_id}', [OrderController::class,'acceptOrder'])->name('order.acceptOrder');
Route::post('/dashboards/order/refuseOrder/{order_id}', [OrderController::class,'refuseOrder'])->name('order.refuseOrder');
Route::get('/dashboards/order/printOrder/{order_id}', [OrderController::class,'printOrder'])->name('order.printOrder');


//HUy
//category
Route::get('/dashboards/category',[App\Http\Controllers\Backend\CategoryController:: class, 'index'])->name('cate.index');
Route::get('/dashboards/create_category',[App\Http\Controllers\Backend\CategoryController:: class, 'create'])->name('cate.create');
Route::post('/dashboards/add_category',[App\Http\Controllers\Backend\CategoryController:: class, 'store'])->name('cate.store');
Route::get('/dashboards/update/{id}',[App\Http\Controllers\Backend\CategoryController:: class, 'edit'])->name('cate.edit');
Route::post('/dashboards/updated/{id}',[App\Http\Controllers\Backend\CategoryController:: class, 'update'])->name('cate.update');
Route::get('/dashboards/delete/{id}',[App\Http\Controllers\Backend\CategoryController:: class, 'destroy'])->name('cate.delete');
//rout districts
Route::get('/dashboards/districts',[App\Http\Controllers\Backend\DistrictController::class, 'index'])->name('district.index');
Route::get('/dashboards/district/create_district',[App\Http\Controllers\Backend\DistrictController::class, 'create'])->name('district.create');
Route::post('/dashboards/district/store_district',[App\Http\Controllers\Backend\DistrictController::class, 'store'])->name('district.store');
Route::get('/dashboards/district/edit_district/{id}',[App\Http\Controllers\Backend\DistrictController::class, 'edit'])->name('district.edit');
Route::post('/dashboards/district/update_district/{id}',[App\Http\Controllers\Backend\DistrictController::class, 'update'])->name('district.update');
Route::get('/dashboards/district/delete_district/{id}',[App\Http\Controllers\Backend\DistrictController::class, 'destroy'])->name('district.delete');
//City
Route::get('/dashboards/city',[App\Http\Controllers\Backend\CityController::class, 'index'])->name('city.index');
Route::get('/dashboards/city/create_city',[App\Http\Controllers\Backend\CityController::class, 'create'])->name('city.create');
Route::post('/dashboards/city/store_city',[App\Http\Controllers\Backend\CityController::class, 'store'])->name('city.store');
Route::get('/dashboards/city/edit_city/{id}',[App\Http\Controllers\Backend\CityController::class, 'edit'])->name('city.edit');
Route::post('/dashboards/city/update_city/{id}',[App\Http\Controllers\Backend\CityController::class, 'update'])->name('city.update');
Route::get('/dashboards/city/delete_city/{id}',[App\Http\Controllers\Backend\CityController::class, 'destroy'])->name('city.delete');


//rout brands
Route::get('/dashboards/brands',[App\Http\Controllers\Backend\BrandController::class, 'index'])->name('brand.index');
Route::get('/dashboards/brands/create_brand',[App\Http\Controllers\Backend\BrandController::class, 'create'])->name('brand.create');
Route::post('/dashboards/brands/store_brand',[App\Http\Controllers\Backend\BrandController::class, 'store'])->name('brand.store');
Route::get('/dashboards/brands/edit_brand/{id}',[App\Http\Controllers\Backend\BrandController::class, 'edit'])->name('brand.edit');
Route::post('/dashboards/brands/update_brand/{id}',[App\Http\Controllers\Backend\BrandController::class, 'update'])->name('brand.update');
Route::get('/dashboards/brands/delete_brand/{id}',[App\Http\Controllers\Backend\BrandController::class, 'destroy'])->name('brand.delete');

