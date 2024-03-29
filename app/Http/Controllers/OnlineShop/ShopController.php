<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Collection;
use App\Models\ProductTypes;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\CompanyDetails;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->paginateNumber = 50;
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
        $dateNow = date('Y-m-d');

        return view('onlineshop.product-listing', compact('cart', 'cartItems', 'max', 'productList', 'collectionsDistinct', 'typesDistinct', 'dateNow'));
    }

    public function product_filter($collection, $type, $priceRange, $outlet)
    {
        $iva = CompanyDetails::first()->iva;
        $iva = ($iva / 100) + 1;
        $price = explode("-", $priceRange);
        $priceMin = round($price[0] / ($iva), 2);
        $priceMax = round($price[1] / ($iva), 2);
        $collectionId = trim($collection, 'collection_');
        $typeId = trim($type, 'type_');

        $productsSelected = new Product;

        if ($outlet == 1) {
            $productsSelected = $productsSelected->where('outlet', $outlet);
        }

        if ($collectionId > 0 && $typeId > 0) {
            $productsSelected = $productsSelected->where('collection_id', $collectionId)->where('type_id', $typeId);
        }
        elseif ($typeId > 0) {
            $productsSelected = $productsSelected->where('type_id', $typeId);
        }
        elseif ($collectionId > 0 ) {
            $productsSelected = $productsSelected->where('collection_id', $collectionId);
        }

        $productsSelected = $productsSelected->where('disabled', 0)->where('price', '>=', $priceMin)->where('price', '<=', $priceMax)->with('collection')->with('type')->latest()->paginate($this->paginateNumber);

        if($productsSelected->first() == "") {
            return false;
        }

        return response()->json($productsSelected);
    }

    public function product_search($searchedString, $outlet)
    {
        $searchResult = array();
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
                    $checkCollection = $productsSearched->where('collection_id', $collection->id)->first();
                    if ($checkCollection && $outlet == 1) {
                        array_push($searchResult, $productsSearched->where('collection_id', $collection->id)->where('outlet', $outlet)->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber));
                    }
                    elseif ($checkCollection) {
                        array_push($searchResult, $productsSearched->where('collection_id', $collection->id)->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber));
                    }
                }
            }
            if($typesLike->first() != "") {
                foreach ($typesLike as $type) {
                    $checkType = $productsSearched->where('type_id', $type->id)->first();
                    if($checkType && $outlet == 1) {
                        array_push($searchResult, $productsSearched->where('type_id', $type->id)->where('outlet', $outlet)->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber));
                    }
                    elseif($checkType) {
                        array_push($searchResult, $productsSearched->where('type_id', $type->id)->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber));
                    }
                }
            }

            if(empty($searchResult)) {
                return false;
            }
        }
        else {
            if($outlet == 1) {
                array_push($searchResult, $productsSearched->where('outlet', $outlet)->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber));
            }
            else {
                array_push($searchResult, $productsSearched->where('disabled', 0)->with('collection')->with('type')->latest()->paginate($this->paginateNumber));
            }

            return response()->json($searchResult);
        }

        if(!empty($searchResult)) {
            return response()->json($searchResult);
        }
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
