<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
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
            'cart_ids' => 'required',
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
            $cartIds = $request->cart_ids;

            Order::create([
                'cart_ids' => $cartIds,
                'user_id' => $delivery->user_id,
                'delivery_id' => $delivery->id,
                'billing_id' => $billing->id,
                'additional' => $request->additional,
                'date_bought' => date('Y-m-d'),
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'total_price' => $request->total_price,
            ]);

            $delivery->update([
                'used' => 1,
            ]);

            $billing->update([
                'used' => 1,
            ]);

            foreach(json_decode($cartIds) as $cartId)
            {
                Cart::find($cartId)->update([
                    'bought' => 1,
                ]);
            }
           
            $order = Order::latest()->first();
            $carts = Cart::all();

            Mail::to($order->user->email)->send(new OrderEmail($order, $carts, $delivery, $billing));

            return redirect(route('online-shop.order-confirmation', $order->order_number));
        }
    }

    public function confirmation($order)
    {
        $order = Order::where('order_number', $order)->first();
        
        if(auth()->user()->id == $order->user_id)
        {
            $carts = Cart::all();
            $products = Product::all();
            $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();
            $total = 0;

            return view('onlineshop.orderconfirmation', compact('carts', 'products', 'total', 'order', 'cartCount'));
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
            $carts = Cart::all();
            $cartCount = Cart::all()->count();
            $addresses = Address::all();
            $total = 0;

            return view('onlineshop.profile.orders.show', compact('carts', 'total', 'order', 'addresses', 'cartCount'));
        }
        else
        {
            abort(403, 'Ação Não-Autorizada.');
        }
    }
}
