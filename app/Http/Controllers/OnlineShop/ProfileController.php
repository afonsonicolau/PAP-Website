<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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

    // Orders
    public function orders_index()
    {
        $orders = Order::all();
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();

        return view('onlineshop.profile.orders.orders', compact('orders', 'cartItems'));
    }

    // Change password
    public function user_change_info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'password' => 'required|regex:/^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})/',
            'password_confirmation' => 'required',
        ],
        [
            'password.*' => 'A palavra-passe deve ter 8 caracteres, uma letra, um número e um caractere especial.',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            $user = Auth::user();

            if (!Hash::check($request->password, $user->password)){
                return redirect()->back()->with('error', 'A palavra-passe inserida não coincide com a palavra-passe atual.');
            }

            $user->password = Hash::make($request->password);
            $user->save;
        

            return redirect()->back()->with('success', 'Palavra-passe mudada com sucesso.');
        }
    }
}
