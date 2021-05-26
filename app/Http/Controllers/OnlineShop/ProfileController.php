<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Order;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', 'regex:/^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})/'],
            'password_confirmation' => 'required',
        ],
        [
            'password.*' => 'A palavra-passe deve ter 8 caracteres, uma letra, um número e um caractere especial.',
            'password_confirmation.*' => 'O campo "Confirmar Palavra-passe" é obrigatório.',
            'current_password.*' => 'O campo "Palavra-passe Atual" é obrigatório.',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        else {
            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)){
                return redirect()->back()->with('error', 'A palavra-passe atual inserida não está correta.');
            }
            elseif ($request->current_password == $request->password){
                return redirect()->back()->with('error', 'A palavra-passe atual não pode ser igual à nova palavra-passe.');
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        
            return redirect()->back()->with('success', 'Palavra-passe mudada com sucesso.');
        }
    }
}
