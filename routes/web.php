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



Route::group(['middleware'=>'auth'],function(){
    Route::get('/productos','App\Http\Controllers\ProductController@showProductsAdmin')->name('show.products.admin');



});



require __DIR__.'/auth.php';
