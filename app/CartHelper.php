<?php

namespace App;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartHelper
{
    public static function cartCount(){
        return Cart::where('user_id',Auth::id())->count();
    }
    public static function getTotalAmount(){
       $elementsCart =  Cart::where('user_id',Auth::id())->get();
       $totalAmount = 0;
       foreach($elementsCart as $element){
           if($element->product_id!=null){
               $totalAmount+=$element->product->price;
           }else{
               $totalAmount+=$element->menu->price;
           }

       }
       return $totalAmount;
    }
}