<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Backoffice\ProductsController;
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
        $product = Product::find($productId);

        $validator = Validator::make($request->all(), [
            'quantidade' => 'required|numeric|gt:0|max:' . $product->stock,
        ],
        [
            'quantidade.*' => 'A quantidade deverá estar entre 1 a :max unidades'
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else
        {
            $quantity = $request->quantidade;
            
            $cart = Cart::where('user_id', $userId)->where('bought', 0)->latest()->first();
            $cartCheck = CartItems::where('cart_id', $cart->id)->where('product_id', $productId)->latest()->first();

            if ($cartCheck != null && $cartCheck->exists()) {
                $quantity = $cartCheck->quantity + $quantity;

                if($quantity < $product->stock) {
                    $cartCheck->update([
                        'quantity' => $quantity,
                    ]);
                } 
                else {
                    return redirect()->back()->with('error', 'A quantidade que escolheu juntamente com a quantidade no carrinho excede o stock atual.');
                }
            }
            else
            {
                if($quantity < $product->stock) {
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
            }
            
            return redirect(route('online-shop.product-listing'));
        }  
    }

    public function update($productId, $quantity)
    {
        $product = "";
        $cart = "";
        $cartItem = "";

        if($quantity >= 1 && is_numeric($quantity)) {
            $product = Product::find($productId);
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            
            if ($quantity <= $product->stock) {
                CartItems::where('cart_id', $cart->id)->where('product_id', $product->id)->update([
                    'quantity' => $quantity,
                ]);

                return response()->json(CartItems::where('cart_id', $cart->id)->where('product_id', $product->id)->first());
            }
            else {
                return false;
            }            
        }
        else {
            return false;
        }
    }

    public function destroy($productId)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
        $cartItem = CartItems::where('cart_id', $cart->id)->where('product_id', $productId)->get();

        $cartItem->delete();

        $cartItem = CartItems::where('cart_id', $cart->id)->count();

        return response()->json($cartItem); 
    }
}
