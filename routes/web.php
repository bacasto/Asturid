<?php

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

Route::get('/','App\Http\Controllers\ProductController@index')->name('dashboard');
Route::get('/producto/{id}','App\Http\Controllers\ProductController@showProduct')->name('show.product');

Route::get('/producto/categoria/{id}','App\Http\Controllers\ProductController@showProductCategory')->name('show.product.category');
Route::post('products_search','App\Http\Controllers\ProductController@searchProducts')->name('search.products');
Route::get('/menus','App\Http\Controllers\MenuController@showMenus')->name('show.menus');
Route::get('/menu/{id}','App\Http\Controllers\MenuController@showMenu')->name('show.menu');


Route::group(['middleware'=>'auth'],function(){
    ## Profile
    Route::get('/mi-perfil','App\Http\Controllers\UserController@showProfile')->name('show.profile');
    Route::Post('/update-profile','App\Http\Controllers\UserController@updateProfile')->name('update.profile');


    ## Index Admin
    Route::get('/productos','App\Http\Controllers\AdminController@showProductsAdmin')->name('show.products.admin');
    Route::get('/usuarios','App\Http\Controllers\AdminController@showUsersAdmin')->name('show.users.admin');
    Route::get('/menus_admin','App\Http\Controllers\AdminController@showMenusAdmin')->name('show.menus.admin');

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



});



require __DIR__.'/auth.php';