<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function show(){
        $orders = Auth::user()->orders;
        return view('orders.index',compact('orders'));
    }

    public function update(Request $request){
        if(Auth::user()->rol_id==2){
            $request->validate([
                'order_id' => 'required|exists:orders,id',
                'state_id' => 'required|exists:order_states,id',
            ]);
            $order = Order::find($request->order_id);
            $order->state_id = $request->state_id;
            $order->save();
            $orders = Order::all();
            $states = OrderState::all();
            $html = view('admin._partial_orders_admin', compact('orders','states'))->render();
            return response()->json(['status' => 'ok', 'message' => "Pedido actualizado correctamente", 'view' => $html], 200);
        }else{
            return redirect()->back();
        }
    }
    public function destroy($id){
        if (Auth::user()->rol_id == 2) {
            $order = Order::find($id);
            if ($order) {

                $order->delete();
            }
            $orders = Order::all();
            $states = OrderState::all();
            $html = view('admin._partial_orders_admin', compact('orders','states'))->render();
            return response()->json(['status' => 'ok', 'message' => "Pedido eliminado correctamente", 'view' => $html], 200);
        } else {
            return response()->json(['status' => 'ok', 'message' => "No tienes permiso para hacer esto"], 403);
        }
    }
}
