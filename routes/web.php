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
Route::get('/products/{slug}','ProductController@Product');
Route::get('/categories/{slug}','CategoryController@Category');
Route::get('/shop/{slug}','SellerController@Seller');

Route::get('/search','FilterController@Search')->name('filter');
//Cart Route
Route::get('/cart','CartController@Cart');
Route::post('/cart/add','CartController@addCart')->name('addCart');
Route::post('/cart/edit','CartController@editCart')->name('editCart');
Route::post('/cart/delete','CartController@deleteCart')->name('deleteCart');
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
//NotifyController
Route::put('/notifications','NotifyController@Viewed')->name('viewNotify')->middleware('auth');
//SellerController
Route::get('/shop/{slug}','SellerController@Shop')->name('shop');
//EnjoyController
Route::post('/enjoy/add','EnjoyController@addEnjoy')->name('addEnjoy');
Route::post('/enjoy/delete','EnjoyController@delEnjoy')->name('delEnjoy'); 


//Manager Area
Route::group(['prefix' => '/panel/manager',  'middleware' => 'roleauth'], function(){
    Route::get('login', 'Manager\LoginController@Login');
});