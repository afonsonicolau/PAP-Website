<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);    
    }

    public function index()
    {
        $products = Product::all();
        $i = 0;

        return view('welcome', compact('products', 'i'));
    }
}
