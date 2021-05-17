<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderEmail;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);    
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_id' => 'required',
            'billing_id' => 'required',
            'payment_method' => 'required',
            'delivery_method' => 'required',
            'total_price' => 'required',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $delivery = Address::find($request->delivery_id);
            $billing = Address::find($request->billing_id);
            $cart = Cart::where('user_id', $delivery->user_id)->latest()->first();
            $user = User::find($delivery->user_id);

            Order::create([
                'cart_id' => $cart->id,
                'user_id' => $user->id,
                'delivery_id' => $delivery->id,
                'billing_id' => $billing->id,
                'additional' => $request->additional,
                'date_bought' => date('Y-m-d'),
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'total_price' => $request->total_price,
            ]);

            // Update tables in database 
            $delivery->update([
                'used' => 1,
            ]);

            $billing->update([
                'used' => 1,
            ]);

            $cart->update([
                'bought' => 1,
            ]);
                
            // Create a new cart for user
            Cart::create([
                'user_id' => $user->id,
            ]);

            // Get order to send e-mail to user
            $order = Order::latest()->first();
            $cartItems = CartItems::where('cart_id', 1)->get();

            Mail::to($user->email)->send(new OrderEmail($order, $delivery, $billing, $cartItems));

            return redirect(route('online-shop.order-confirmation', [$order->order_number, $delivery->id, $billing->id]));
        }
    }

    public function confirmation($order, $delivery, $billing)
    {
        $order = Order::where('order_number', $order)->first();
        $delivery = Address::find($delivery);
        $billing = Address::find($billing);
        
        if(auth()->user()->id == $order->user_id)
        {
            $cartItems = CartItems::where('cart_id', $order->cart_id)->get();

            return view('onlineshop.orderconfirmation', compact('cartItems', 'order', 'delivery', 'billing'));
        }
        else
        {
            abort(403, 'Ação Não-Autorizada.');
        }
    }

    public function show($order)
    {
        $order = Order::where('order_number', $order)->first();
        
        if(auth()->user()->id == $order->user_id)
        {
            $cartItems = CartItems::where('cart_id', $order->cart_id)->get();
            $addresses = Address::all();

            return view('onlineshop.profile.orders.show', compact('cartItems', 'order', 'addresses'));
        }
        else
        {
            abort(403, 'Ação Não-Autorizada.');
        }
    }
}
