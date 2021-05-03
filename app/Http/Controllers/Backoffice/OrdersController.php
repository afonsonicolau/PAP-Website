<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Order;

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
}
