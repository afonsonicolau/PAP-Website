<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required|int',
            'cart_ids' => 'required',
            'payment_method' => 'required',
            'delivery_method' => 'required',
            'total_price' => 'required|int'
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $address = Address::find($request->address_id);
            $cartIds = $request->cart_ids;

            Order::create([
                'cart_ids' => $cartIds,
                'user_id' => $address->user_id,
                'address_id' => $address->id,
                'additional' => $request->additional,
                'date_bought' => date('Y-m-d'),
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'total_price' => $request->total_price,
            ]);

            foreach(json_decode($cartIds) as $cartId)
            {
                Cart::find($cartId)->update([
                    'bought' => 1,
                ]);
            }
            $order = Order::latest()->first();

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
            $total = 0;
            $orderNumber = $order->order_number;

            return view('onlineshop.orderconfirmation', compact('carts', 'products', 'total', 'orderNumber'));
        }
        else
        {
            abort(403, 'Ação Não-Autorizada.');
        }
    }

    public function show($order)
    {

    }
}
