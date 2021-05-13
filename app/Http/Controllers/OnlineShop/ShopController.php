<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Collection;
use App\Models\ProductTypes;
use App\Models\Cart;
use App\Models\CartItems;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $cart = "";
        $cartItems = 0;
        $products = Product::all();

        if(auth()->user())
        {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cartItems = CartItems::where('cart_id', $cart->id)->get();
        }
        
        return view('onlineshop.index', compact('products', 'cart', 'cartItems'));
    }

    public function product_listing_index()
    {
        $cart = "";
        $cartItems = "";

        if(auth()->user())
        {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cartItems = CartItems::where('cart_id', $cart->id)->get();
        }

        $productList = Product::where('disabled', 0)->where('visible', 1)->get();
        $collectionsDistinct = "";
        $typesDistinct = "";

        foreach($productList as $product)
        {
            $typesDistinct = $product->distinct('type_id')->get();
            $collectionsDistinct = $product->distinct('collection_id')->get();
        }

        $productList = Product::where('disabled', 0)->where('visible', 1)->latest()->paginate(2);
        $max = Product::max('price');

        return view('onlineshop.product-listing', compact('cart', 'cartItems','productList', 'max', 'collectionsDistinct', 'typesDistinct'));
    }

    public function product_filter($collection, $type, $priceRange)
    {
        $price = explode("-", $priceRange);
        $collectionId = trim($collection, 'collection_');
        $typeId = trim($type, 'type_');
        $productsSelected = Product::where('price', '>=', $price[0])->where('price', '<=', $price[1])->with('collection')->with('type')->latest()->get();

        if ($collectionId > 0 && $typeId > 0)
        {
            $productsSelected = Product::where('collection_id', $collectionId)->where('type_id', $typeId)->where('price', '>=', $price[0])->where('price', '<=', $price[1])->with('collection')->with('type')->latest()->get();
        }
        elseif ($typeId > 0)
        {
            $productsSelected = Product::where('type_id', $typeId)->where('price', '>=', $price[0])->where('price', '<=', $price[1])->with('collection')->with('type')->latest()->get();
        }
        elseif ($collectionId > 0 )
        {
            $productsSelected = Product::where('collection_id', $collectionId)->with('collection')->with('type')->latest()->get();
        }

        return response()->json($productsSelected); 
    }

    public function product_detail_index($id)
    {
        $product = Product::find($id);
        $cart = "";
        $cartItems = "";

        if(auth()->user())
        {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cartItems = CartItems::where('cart_id', $cart->id)->get();
        }

        return view('onlineshop.product-detail', compact('product', 'cart', 'cartItems'));
    }
}
