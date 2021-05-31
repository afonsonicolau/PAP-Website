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
    public function __construct()
    {
        $this->paginateNumber = 20;
    }

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

        $productList = Product::where('disabled', 0)->where('visible', 1);
        $collectionsDistinct = "";
        $typesDistinct = "";

        $typesDistinct = $productList->distinct()->get('type_id');
        $collectionsDistinct = $productList->distinct()->get('collection_id');

        $productList = Product::where('disabled', 0)->where('visible', 1)->latest()->paginate($this->paginateNumber);
        $max = Product::max('price');

        return view('onlineshop.product-listing', compact('cart', 'cartItems', 'max', 'productList', 'collectionsDistinct', 'typesDistinct'));
    }

    public function product_filter($collection, $type, $priceRange)
    {
        $price = explode("-", $priceRange);
        $collectionId = trim($collection, 'collection_');
        $typeId = trim($type, 'type_');

        $productsSelected = new Product;
        
        if ($collectionId > 0 && $typeId > 0)
        {
            $productsSelected = $productsSelected->where('collection_id', $collectionId)->where('type_id', $typeId);
        }
        elseif ($typeId > 0)
        {
            $productsSelected = $productsSelected->where('type_id', $typeId);
        }
        elseif ($collectionId > 0 )
        {
            $productsSelected = $productsSelected->where('collection_id', $collectionId);
        }
        
        $productsSelected = $productsSelected->where('disabled', 0)->where('price', '>=', $price[0])->where('price', '<=', $price[1])->with('collection')->with('type')->latest()->paginate($this->paginateNumber);

        if($productsSelected->first() == "") {
            return false;
        }

        return response()->json($productsSelected); 
    }

    public function product_search($searchedString)
    {
        $productsSearched = new Product;
        $collections = Collection::where('disabled', 0)->get();
        $types = ProductTypes::where('disabled', 0)->get();

        if($searchedString != "null") {
            $collectionsLike = ""; $typesLike = "";

            foreach ($collections as $collection) {
                $collectionsLike = $collection->where('collection', 'LIKE', "%{$searchedString}%")->get();
            }
            foreach ($types as $type) {
                $typesLike = $type->where('type', 'LIKE', "%{$searchedString}%")->get();
            }

            if($collectionsLike->first() != "") {
                foreach ($collectionsLike as $collection) {
                    $productsSearched = $productsSearched->where('collection_id', $collection->id);
                }
            }
            
            if($typesLike->first() != "") {
                foreach ($typesLike as $type) {
                    $productsSearched = $productsSearched->where('type_id', $type->id)->get();
                }
            }
        }
        
        $productsSearched = $productsSearched->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber);

        if($productsSearched->first() == "") {
            return false;
        }

        return response()->json($productsSearched); 
    }

    public function product_detail_index($id)
    {
        $product = Product::find($id);
        $cartItems = "";

        if(auth()->user())
        {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cartItems = CartItems::where('cart_id', $cart->id)->get();
        }

        return view('onlineshop.product-detail', compact('product', 'cartItems'));
    }
}
