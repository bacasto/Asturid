<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function showProductsAdmin(){
        if(Auth::user()->rol_id==2){
            $productos = Product::all();
            $categorias = Category::all();
            return view('admin.products_index',compact('productos','categorias'));
        }else{
            return redirect()->back();
        }

    }

    public function showOrdersAdmin(){
        if(Auth::user()->rol_id==2){
            $orders = Order::all();
            $states = OrderState::all();
            return view('admin.orders_index',compact('orders','states'));
        }else{
            return redirect()->back();
        }

    }
    public function showUsersAdmin(){
        if(Auth::user()->rol_id==2){
            $users = User::all();
            return view('admin.users_index',compact('users'));
        }else{
            return redirect()->back();
        }

    }

    public function showMenusAdmin(){
        $menus = Menu::all();
        return view('admin.menus_index',compact('menus'));
    }
}
