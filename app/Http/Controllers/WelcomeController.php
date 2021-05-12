<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class WelcomeController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $i = 0;

        return view('welcome', compact('products', 'i'));
    }

    public function terms()
    {
        return view('terms');
    }
}
