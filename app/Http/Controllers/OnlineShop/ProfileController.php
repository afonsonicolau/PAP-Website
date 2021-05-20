<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);    
    }


    // Personal
    public function personal_index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();

        return view('onlineshop.profile.personal', compact('cartItems'));
    }

    // Addresses
    public function addresses_index()
    {
        $addresses = Address::all();
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();

        return view('onlineshop.profile.addresses.addresses', compact('addresses', 'cartItems'));
    }

    public function orders_index()
    {
        $orders = Order::all();
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();

        return view('onlineshop.profile.orders.orders', compact('orders', 'cartItems'));
    }
}
