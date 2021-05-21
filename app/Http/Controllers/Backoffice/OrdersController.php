<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CartItems;

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

    public function update($id, $state)
    {
        if($state != "" && $id != "")
        {
            Order::where('order_number', $id)->update([
                'state' => $state,
            ]);

            return true;
        }

        return false;
    }

    public function show($orderNum)
    {
        $order = Order::where('order_number', $orderNum)->first();
        $cartItems = CartItems::where('cart_id', $order->cart_id)->get();

        return view('backoffice.orders.show', compact('order', 'cartItems'));
    }
}
