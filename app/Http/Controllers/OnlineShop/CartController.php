<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Address;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function index()
    {
        $cartCheck = Cart::where('bought', 0)->where('user_id', auth()->user()->id)->first();

        $carts = Cart::all();
        $products = Product::all();
        $total = 0;

        if($cartCheck != null)
        {
            $carts = Cart::all();
            $products = Product::all();
            $total = 0;
            return view('onlineshop.cart', compact('carts', 'products', 'total'));
        }
        else
        {
            return redirect(route('online-shop.product-listing'))->with(['carts', 'products', 'total']);
        }
    }

    public function checkout()
    {
        $cartCheck = Cart::where('bought', 0)->where('user_id', auth()->user()->id)->first();
        
        $carts = Cart::all();
        $products = Product::all();
        $total = 0;

        if ($cartCheck != null)
        {   
            $addresses = Address::all();
            $cartIds = "";

            return view('onlineshop.checkout', compact('carts', 'products', 'total', 'addresses', 'cartIds'));
        }
        else
        {
            return redirect(route('online-shop.product-listing'))->with(['carts', 'products', 'total']);
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
            $cartCheck = Cart::where('user_id', $userId)->where('product_id', $request->product)->latest()->first();
            
            if ($cartCheck != null && $cartCheck->exists() && $cartCheck->bought == 0) 
            {
                $cartCheck->increment('quantity', $quantity);
            }
            else
            {
                $product = Product::find($productId);

                Cart::create([
                    'user_id' => $userId,
                    'quantity' => $quantity,
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'bought' => 0,
                ]);
            }
            
            return redirect(route('online-shop.product-listing'));
        }  
    }

    public function update($cartId, $quantity)
    {
        $cart = Cart::find($cartId);

        if($quantity >= 1 && is_numeric($quantity))
        {
            $cart->update([
                'quantity' => $quantity
            ]);

            return true;
        }
    }

    public function destroy($cartId)
    {
        $cart = Cart::find($cartId);

        $cart->delete();

        return true;
    }
}
