<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded b   y the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@Index')->name('home');
Route::get('/products/{slug}','ProductController@Product')->name('myProduct');
Route::get('/categories/{slug}','CategoryController@Category');
Route::get('/shop/{slug}','SellerController@Seller');

Route::get('/search','FilterController@Search')->name('filter');
//Cart Route
Route::get('/cart','CartController@Cart');
Route::post('/cart/add','CartController@addCart')->name('addCart');
Route::post('/cart/edit','CartController@editCart')->name('editCart');
Route::post('/cart/delete','CartController@deleteCart')->name('deleteCart');
//PAYMENT Route
Route::get('/payment','PayController@show')->name('payment');
//Address Route
Route::post('/address','AddressController@getMore')->name('address');
//Shipping Route
Route::post('/shipper/calculation','ShipperController@getShipPrice')->name('getShipPrice');
//Coupon Route
Route::post('/coupon/check','CouponController@check')->name('checkCoupon');
//GOOGLE API 
Route::get('/GoogleRedirect', 'Auth\LoginController@GoogleLoginRedirect')->name("GoogleRedirect");
Route::get('/GoogleCallback', 'Auth\LoginController@GoogleCallBackHandler');
//Authetication
Route::get('/logout','Auth\LogoutController@Logout')->name('logout')->middleware('auth');
Route::post('/login','Auth\LoginController@Login')->name('login')->middleware('guest');
Route::get('/user/me','UserController@Profile')->name('myAccount')->middleware('auth');
Route::post('/user/me','UserController@postProfile')->name('updateAccount')->middleware('auth');
Route::get('/user/orders','UserController@Order')->name('myOrders')->middleware('auth');
Route::get('/user/notify','UserController@Notify')->name('myNotify')->middleware('auth');
//Password Reset
Route::post('/reset-password', 'ResetPasswordController@sendMail')->name('recovery');
Route::post('/reset-password-code', 'ResetPasswordController@postReset')->name('postReset');
Route::post('/reset-recovery-info', 'ResetPasswordController@postRecovery')->name('postRecovery');
//Register
Route::post('/register','Auth\LoginController@Register')->name('postRegister')->middleware('guest');

//OrderController
Route::put('/orders/{id}','OrderController@OrderStatus')->middleware('auth');
Route::post('/orders','OrderController@create')->name('createOrders')->middleware('auth');
//NotifyController
Route::put('/notifications','NotifyController@Viewed')->name('viewNotify')->middleware('auth');
//SellerController
Route::get('/shop/{slug}','SellerController@Shop')->name('shop');
//EnjoyController
Route::post('/enjoy/add','EnjoyController@addEnjoy')->name('addEnjoy');
Route::post('/enjoy/delete','EnjoyController@delEnjoy')->name('delEnjoy'); 
//Review Controller
Route::post('/reviews','ReviewController@increPoint')->name('increPoint');
Route::post('/reviews/create/{idproduct}','ReviewController@create')->name('createReview');
//Manager Area not Login
Route::group(['prefix' => '/panel/manager','middleware' => 'guest'], function(){
    Route::get('dashboard-login', 'Manager\LoginController@Login')->name('superLogin');
    Route::post('dashboard-login', 'Manager\LoginController@postLogin')->name('superPostLogin');
});
//Message Resource
Route::resource('messages', 'MessageController');
Route::post('/messages-getMsg','MessageController@getMessages')->name('getMsgBySeller')->middleware('auth');
//Manager Area Logined 
Route::group(['prefix' => '/panel/manager',  'middleware' => 'roleauth'], function(){
    Route::get('/','Manager\DashboardController@Index')->name('dashboard');
    Route::get('/logout','Manager\LoginController@Logout')->name('superLogout');

    Route::get('/categories','Manager\CategoryController@show')->name('superCategory');
    Route::get('/categories.{slug}','Manager\CategoryController@editCategory')->name('superEditCategory');
    Route::get('/categories/new','Manager\CategoryController@addCategory')->name('superAddCategory');
    Route::post('/categories/new','Manager\CategoryController@postAddCategory')->name('superPostAddCategory');
    Route::post('/categories.{slug}','Manager\CategoryController@postEditCategory')->name('superPostEditCategory');
    Route::post('/categories/deleteMany','Manager\CategoryController@postDeleteCategory')->name('superDeleteEditCategory');
   
    Route::get('/products','Manager\ProductController@show')->name('superProduct');
    Route::get('/products.{id}','Manager\ProductController@getProduct')->name('superGetProduct');
    Route::get('/products/new','Manager\ProductController@addProduct')->name('superAddProduct');
    Route::post('/products/new','Manager\ProductController@postAddProduct')->name('superPostAddProduct');
    Route::post('/products.{slug}','Manager\ProductController@postEditProduct')->name('superPostEditProduct');
    Route::post('/products/deleteMany','Manager\ProductController@postDeleteProduct')->name('superDeleteEditProduct');
    
    Route::get('/reviews','Manager\ReviewController@show')->name('superReview');

    Route::get('/sellers','Manager\SellerController@show')->name('superSeller');
    Route::get('/sellers.{id}','Manager\SellerController@editSeller')->name('superEditSeller');
    Route::get('/sellers/new','Manager\SellerController@addSeller')->name('superAddSeller');
    Route::post('/sellers/new','Manager\SellerController@postAddSeller')->name('superPostAddSeller');
    Route::post('/sellers.{id}','Manager\SellerController@postEditSeller')->name('superPostEditSeller');
    Route::post('/sellers/deleteMany','Manager\SellerController@postDeleteSeller')->name('superDeleteEditSeller');

    Route::get('/shippers','Manager\ShipperController@show')->name('superShipper');
    Route::get('/shippers.{id}','Manager\ShipperController@editShipper')->name('superEditShipper');
    Route::get('/shippers/new','Manager\ShipperController@addShipper')->name('superAddShipper');
    Route::post('/shippers/new','Manager\ShipperController@postAddShipper')->name('superPostAddShipper');
    Route::post('/shippers.{id}','Manager\ShipperController@postEditShipper')->name('superPostEditShipper');
    Route::post('/shippers/deleteMany','Manager\ShipperController@postDeleteShipper')->name('superDeleteEditShipper');

    Route::get('/files','Manager\CategoryController@show')->name('superFile');

    Route::get('/customers','Manager\CustomerController@show')->name('superCustomer');
    Route::get('/customers.{id}','Manager\CustomerController@editCustomer')->name('superEditCustomer');
    Route::get('/customers-banner','Manager\CustomerController@getBannerCustomer')->name('superBannerCustomer');
    Route::get('/customers/new','Manager\CustomerController@addCustomer')->name('superAddCustomer');
    Route::post('/customers-banner','Manager\CustomerController@postUnbanCustomer')->name('superUnbanCustomer');
    Route::post('/customers/new','Manager\CustomerController@postAddCustomer')->name('superPostAddCustomer');
    Route::post('/customers.{id}','Manager\CustomerController@postEditCustomer')->name('superPostEditCustomer');
    Route::post('/customers/deleteMany','Manager\CustomerController@postDeleteCustomer')->name('superDeleteEditCustomer');

    Route::get('/histories','Manager\HistoryController@show')->name('history');

    Route::post('/traffic/moneys','Manager\TrafficController@getViewEachDay')->name('getViewEachDay');

    Route::get('/orders','Manager\OrderController@show')->name('superOrder');
    Route::get('/orders.{id}','Manager\OrderController@getOrder')->name('superGetOrder');
    Route::post('/orders-details','Manager\OrderController@getOrderDetail')->name('superGetOrderDetail');
    Route::post('/orders-accept','Manager\OrderController@editOrder')->name('superAcceptOrder');
    Route::post('/orders/deleteOrderDetail','Manager\OrderController@postDeleteOrderDetail')->name('superDeleteOrderDetail');
    Route::post('/orders/deleteMany','Manager\OrderController@postDeleteOrder')->name('superDeleteEditOrder');
    Route::post('/orders/moneys','Manager\OrderController@getMoneyEachDay')->name('getMoneyEachDay');

    Route::get('/coupons','Manager\CouponController@show')->name('superCoupon');
    Route::get('/coupons.{id}','Manager\CouponController@editCoupon')->name('superEditCoupon');
    Route::get('/coupons/new','Manager\CouponController@addCoupon')->name('superAddCoupon');
    Route::post('/coupons/new','Manager\CouponController@postAddCoupon')->name('superPostAddCoupon');
    Route::post('/coupons.{id}','Manager\CouponController@postEditCoupon')->name('superPostEditCoupon');
    Route::post('/coupons/deleteMany','Manager\CouponController@postDeleteCoupon')->name('superDeleteEditCoupon');

    Route::get('/discounts','Manager\DiscountController@show')->name('superDiscount');
    Route::get('/discounts.{id}','Manager\DiscountController@editDiscount')->name('superEditDiscount');
    Route::get('/discounts/new','Manager\DiscountController@addDiscount')->name('superAddDiscount');
    Route::post('/discounts/new','Manager\DiscountController@postAddDiscount')->name('superPostAddDiscount');
    Route::post('/discounts.{id}','Manager\DiscountController@postEditDiscount')->name('superPostEditDiscount');
    Route::post('/discounts/deleteMany','Manager\DiscountController@postDeleteDiscount')->name('superDeleteEditDiscount');
});