<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);    
    }

    public function index()
    {
        $addresses = Address::all();
        $carts = Cart::all();
        $products = Product::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();

        $total = 0;

        return view('onlineshop.profile.index', compact('carts', 'products', 'total', 'addresses', 'cartCount'));
    }

    public function personal_index()
    {
        $carts = Cart::all();
        $products = Product::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();

        $total = 0;

        return view('onlineshop.profile.personal', compact('carts', 'products', 'total', 'cartCount'));
    }

    // Addresses
    public function addresses_index()
    {
        $carts = Cart::all();
        $products = Product::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();
        $addresses = Address::all();

        $total = 0;

        return view('onlineshop.profile.addresses.addresses', compact('carts', 'products', 'total', 'addresses', 'cartCount'));
    }

    public function orders_index()
    {
        $carts = Cart::all();
        $products = Product::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();
        $orders = Order::all();

        $total = 0;

        return view('onlineshop.profile.orders.orders', compact('carts', 'products', 'total', 'orders', 'cartCount'));
    }
}
