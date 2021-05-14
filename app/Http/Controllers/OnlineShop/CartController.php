<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\CartItems;
use App\Models\Product;
use App\Models\Address;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);    
    }

    public function index()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();
            
        return view('onlineshop.cart', compact('cartItems'));
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->get();

        if ($cartItems->count() > 0)
        {   
            $addresses = Address::all();

            return view('onlineshop.checkout', compact('cart', 'addresses', 'cartItems'));
        }
        else
        {
            return redirect(route('online-shop.cart'))->with('cartItems');
        }
    }

    public function store(Request $request, $productId, $userId)
    {
        $validator = Validator::make($request->all(), [
            'quantidade' => 'required|numeric|gt:0',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $quantity = $request->quantidade;
            $product = $productId;

            $cart = Cart::where('user_id', $userId)->where('bought', 0)->latest()->first();
            $cartCheck = CartItems::where('cart_id', $cart->id)->where('product_id', $productId)->latest()->first();

            if ($cartCheck != null && $cartCheck->exists()) 
            {
                $cartCheck->increment('quantity', $quantity);
            }
            else
            {
                $product = Product::find($productId);
                
                if($cart == null)
                {
                    Cart::create([
                        'user_id' => $userId,
                    ]);
                }
                
                $cart = Cart::where('user_id', $userId)->latest()->first();
                
                CartItems::create([
                    'product_id' => $productId,
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'iva' => $product->iva,
                ]);
            }
            
            return redirect(route('online-shop.product-listing'));
        }  
    }

    public function update($productId, $quantity)
    {
        if($quantity >= 1 && is_numeric($quantity))
        {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cart = CartItems::where('cart_id', $cart->id)->where('product_id', $productId);

            $cart->update([
                'quantity' => $quantity
            ]);

            return true;
        }
        else
        {
            return false;
        }
    }

    public function destroy($productId)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItems = CartItems::where('cart_id', $cart->id)->where('product_id', $productId);

        $cartItems->delete();

        $cartItems = CartItems::where('cart_id', $cart->id)->count();

        return response()->json($cartItems); 
    }
}
