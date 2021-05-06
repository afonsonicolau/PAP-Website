<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Address;
use App\Models\Cart;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $orders = Order::latest()->paginate('10');

        return view('backoffice.orders.index', compact('orders'));
    }

    public function show($orderNum)
    {
        $order = Order::where('order_number', $orderNum)->first();
        $carts = Cart::all();

        return view('backoffice.orders.show', compact('order', 'carts'));
    }
}
