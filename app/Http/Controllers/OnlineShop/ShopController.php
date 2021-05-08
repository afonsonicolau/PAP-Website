<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Collection;
use App\Models\ProductTypes;
use App\Models\Cart;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        $products = Product::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();
        
        $i = 0;
        $totalQuantity = 0;
        $total = 0;

        return view('onlineshop.index', compact('products', 'i', 'carts', 'total', 'totalQuantity', 'cartCount'));
    }

    public function product_listing_index()
    {
        $carts = Cart::all();
        $products = Product::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();

        $i = 0;
        $totalQuantity = 0;
        $total = 0;

        $collectionsDistinct = "";
        $typesDistinct = "";
        $collections = Collection::all();
        $types = ProductTypes::all();

        foreach($products as $product)
        {
            $typesDistinct = Product::distinct()->get('type_id');
            $collectionsDistinct = Product::distinct()->get('collection_id');
        }

        $productList = Product::latest()->paginate(2);
        $max = Product::max('price');

        return view('onlineshop.product-listing', compact('products', 'i', 'carts', 'total', 'totalQuantity', 'productList', 'collections', 'types', 'carts', 'max', 'collectionsDistinct', 'typesDistinct', 'cartCount'));
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
        $products = Product::all();
        $carts = Cart::all();
        $cartCount = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->count();

        return view('onlineshop.product-detail', compact('product', 'products', 'carts', 'cartCount'));
    }
}
