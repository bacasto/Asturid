<?php

namespace App\Http\Controllers;

use App\CartHelper;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show (){
        $cartElements = Cart::where('user_id',Auth::id())->get();

        return view ('cart.index',compact('cartElements'));
    }
    public function add(Request $request)
    {
        $product_id = $request->product_id;
        if($request->isMenu==0){
            $product = Product::find($request->product_id);
            if($product->stock == 0){
                return response()->json(['status'=>'error','message'=>'No hay stock.'],404);
            }
        }

        $extras = explode(",", $request->extras);
        $extras_json = null;
        $numExtras = count($extras);
        $isMenu = $request->isMenu == 1 ? true : false;
        if ($numExtras > 1) {
            $extras_json = $request->extras;
        }

        $cart = Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $isMenu ? null : $product_id,
            'menu_id' => $isMenu ? $product_id : null,
            'extras' => $extras_json,
        ]);

        $cartCount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['status'=>'ok','message'=>'Elemento añadido al carrito.','cartCount'=>$cartCount]);
    }

    public function destroy($id){
        $cartElement = Cart::find($id);
        if($cartElement){
            $cartElement->delete();
        }

        return response()->json(['status'=>'ok','message'=>'Elemento del carrito eliminado.',
            'totalAmount'=> CartHelper::getTotalAmount(),
            'cartCount'=>CartHelper::cartCount()
            ]);

    }
}
