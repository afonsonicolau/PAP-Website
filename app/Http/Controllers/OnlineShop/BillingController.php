<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Product;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);    
    }

    public function addresses_create()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();

        return view('onlineshop.profile.addresses.create', compact('cartItems'));
    }

    public function addresses_store(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'endereço' => 'required',
            'telemóvel' => 'required|int',
            'país' => 'required',
            'códigopostal' => 'required|regex:/^([0-9]){4}-([0-9]){3}/',
            'cidade' => 'required',
            'default' => 'required|int',
            'type' => 'required|int',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $nif = $request->nif;

            if($nif == null)
            {
                $nif = "PT999999990";
            }

            Address::create([
                'user_id' => $userId,
                'name' => $request->nome,
                'address' => $request->endereço,
                'phone_number' => $request->telemóvel,
                'nif' => $nif,
                'country' => $request->país,
                'postal_code' => $request->códigopostal,
                'city' => $request->cidade,
                'company' => $request->empresa,
                'default' => $request->default,
                'type' => $request->type,
            ]);

            if($request->here == null)
            {
                return redirect(route('online-shop.profile-addresses'));
            }
            else
            {
                return redirect(route('online-shop.checkout'));
            }
            
        }
    }

    public function addresses_edit($addressId)
    {
        $address = Address::find($addressId);

        if($address->used == 0 && $address->user_id == auth()->user()->id)
        {
            $countries = array('Portugal', 'Espanha', 'França');
            $types = array('1' => 'Faturação', '2' => 'Envio', '3' => 'Ambas');

            $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();
            $carts = Cart::all();
            $products = Product::all();
            $total = 0;

            return view('onlineshop.profile.addresses.edit', compact('carts', 'products', 'total', 'address', 'countries', 'types', 'cartCount'));
        }
        else
        {
            abort('403', 'Ação Não-Autorizada');
        }
        
    }

    public function addresses_update(Request $request, $addressId)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'endereço' => 'required',
            'telemóvel' => 'required|int',
            'país' => 'required',
            'códigopostal' => 'required|regex:/^([0-9]){4}-([0-9]){3}/',
            'cidade' => 'required',
            'default' => 'required|int', 
            'type' => 'required|int',
        ]);

        $address = Address::find($addressId);

        if($validator->fails() || $address->used == 1)
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $nif = $request->nif;

            if($nif == null)
            {
                $nif = "PT999999990";
            }

            $address->update([
                'name' => $request->nome,
                'address' => $request->endereço,
                'phone_number' => $request->telemóvel,
                'nif' => $nif,
                'country' => $request->país,
                'postal_code' => $request->códigopostal,
                'city' => $request->cidade,
                'company' => $request->empresa,
                'default' => $request->default,
                'type' => $request->type,
            ]);

            return redirect(route('online-shop.profile-addresses'));
        }
    }
}
