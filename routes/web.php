<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
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


Route::group(['middleware'=>'only.users'],function(){
    Route::get('/','App\Http\Controllers\ProductController@index')->name('dashboard');
    Route::get('/producto/{id}','App\Http\Controllers\ProductController@showProduct')->name('show.product');
    Route::get('/producto/categoria/{id}','App\Http\Controllers\ProductController@showProductCategory')->name('show.product.category');
    Route::post('products_search','App\Http\Controllers\ProductController@searchProducts')->name('search.products');
    Route::post('menus_search','App\Http\Controllers\MenuController@searchMenus')->name('search.menus');
    Route::get('/menus','App\Http\Controllers\MenuController@showMenus')->name('show.menus');
    Route::get('/menu/{id}','App\Http\Controllers\MenuController@showMenu')->name('show.menu');

});

Route::group(['middleware'=>'auth'],function(){
    ## Profile
    Route::get('/mi-perfil','App\Http\Controllers\UserController@showProfile')->name('show.profile');
    Route::Post('/update-profile','App\Http\Controllers\UserController@updateProfile')->name('update.profile');

    ## Index Admin
    Route::get('/productos','App\Http\Controllers\AdminController@showProductsAdmin')->name('show.products.admin');
    Route::get('/usuarios','App\Http\Controllers\AdminController@showUsersAdmin')->name('show.users.admin');
    Route::get('/menus_admin','App\Http\Controllers\AdminController@showMenusAdmin')->name('show.menus.admin');
    Route::get('/extras','App\Http\Controllers\ExtrasController@showExtrasAdmin')->name('show.extras.admin');

    ##Products
    Route::post('/addproduct','App\Http\Controllers\ProductController@store')->name('add.producto');
    Route::post('/updateproduct','App\Http\Controllers\ProductController@updateProduct')->name('update.producto');
    Route::get('/removeproduct/{id}','App\Http\Controllers\ProductController@destroy')->name('destroy.producto');

    ##Users
    Route::post('/adduser','App\Http\Controllers\UserController@store')->name('add.user');
    Route::post('/updateuser','App\Http\Controllers\UserController@update')->name('update.user');
    Route::get('/removeuser/{id}','App\Http\Controllers\UserController@destroy')->name('destroy.user');

    #Menus
    Route::post('/addmenu','App\Http\Controllers\MenuController@store')->name('add.menu');
    Route::post('/updatemenu','App\Http\Controllers\MenuController@update')->name('update.menu');
    Route::get('/removemenu/{id}','App\Http\Controllers\MenuController@destroy')->name('destroy.menu');

    #Extras
    Route::post('/addextra','App\Http\Controllers\ExtrasController@store')->name('add.extra');
    Route::post('/updateextra','App\Http\Controllers\ExtrasController@update')->name('update.extra');
    Route::get('/removeextra/{id}','App\Http\Controllers\ExtrasController@destroy')->name('destroy.extra');

    #Cart
    Route::post('/addcart','App\Http\Controllers\CartController@add')->name('add.cart');
    Route::get('/carrito','App\Http\Controllers\CartController@show')->name('show.cart');
    Route::get('/destroyCartElement/{id}','App\Http\Controllers\CartController@destroy')->name('destroy.cart');

    #Order
    Route::get('/pedidos-admin','App\Http\Controllers\AdminController@showOrdersAdmin')->name('show.orders.admin');
    Route::get('/pedidos','App\Http\Controllers\OrderController@show')->name('show.orders');
    Route::post('/updateorder','App\Http\Controllers\OrderController@update')->name('update.order');
    Route::get('/removeorder/{id}','App\Http\Controllers\OrderController@destroy')->name('destroy.order');

    #Pay
    Route::post('charge','App\Http\Controllers\PaymentController@charge')->name('charge');
    Route::get('success', 'App\Http\Controllers\PaymentController@success');
    Route::get('error', 'App\Http\Controllers\PaymentController@error');

});


require __DIR__.'/auth.php';
