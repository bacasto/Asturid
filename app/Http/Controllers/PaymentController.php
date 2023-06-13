<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderState;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function charge(Request $request){
       $cartItems = Cart::all()->count();
       if($cartItems==0){
           return redirect()->route('show.cart')->with('error', 'Debes añadir algo al carrito.');
       }
        $finalAmount = $request->amount;
        $response = $this->gateway->purchase(array(
            'amount' => $finalAmount,
            'currency' => env('PAYPAL_CURRENCY'),
            'returnUrl' => url('success'),
            'cancelUrl' => url('error'),
        ))->send();

        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            return $response->getMessage();
        }
    }

    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // El cliente ha completado el pago
                $arr_body = $response->getData();
                // Inserta los datos de transaccion en la bd
                $payment = Payment::create([
                    'payment_id' => $arr_body['id'],
                    'payer_id' => $arr_body['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr_body['payer']['payer_info']['email'],
                    'amount' => $arr_body['transactions'][0]['amount']['total'],
                    'currency' => env('PAYPAL_CURRENCY'),
                    'payment_status' => $arr_body['state'],
                ]);

                $state = OrderState::where('state','Pagado')->first();
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total' => $payment->amount,
                    'transaction' => $payment->payment_id,
                    'state_id' => $state->id,
                ]);
                $cartItems = Auth::user()->cartItems;
                foreach ($cartItems as $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'menu_id' => $item->menu_id,
                        'extras' => $item->extras,
                    ]);
                    if($item->product_id != null){
                        $product = Product::find($item->product_id);
                        $product->stock = ($product->stock - 1);
                        $product->save();
                    }
                    $item->delete();
                }
                return redirect()->route('show.orders')
                    ->with('success', 'Pedido realizado correctamente');

            } else {
                return $response->getMessage();
            }
        } else {
            return redirect()->route('show.cart')->with('error', 'Pago cancelado.');
        }
    }


    public function error()
    {
        return redirect()->route('show.cart')->with('error', 'Pago cancelado.');
    }
}
