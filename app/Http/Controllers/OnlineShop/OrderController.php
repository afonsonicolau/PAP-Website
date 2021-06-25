<?php

namespace App\Http\Controllers\OnlineShop;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderEmail;
use App\Models\Product;

use Carbon\Carbon;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','verified']);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'delivery_id' => 'required',
            'billing_id' => 'required',
            'payment_method' => 'required',
            'delivery_method' => 'required',
            'total_price' => 'required',
        ],
        [
            'delivery_id.required' => "Selecione uma morada de envio.",
            'billing_id.required' => "Selecione uma morada de faturação.",
        ]);

        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        else {
            // Variable treatment
            $delivery = Address::find($request->delivery_id);
            $billing = Address::find($request->billing_id);
            $cart = Cart::where('user_id', $delivery->user_id)->latest()->first();
            $user = User::find($delivery->user_id);
            $cartItems = CartItems::where('cart_id', $cart->id)->get();
            $totalPrice = 0;

            $items = array();

            foreach($cartItems as $item) {
                // Gets product and it's stock
                $product = Product::find($item->product_id);
                $stock = $product->stock - $item->quantity;

                // product stock - item quantity
                if ($item->quantity > $product->stock)
                {
                    return redirect()->back()->with('error', 'A quantidade do produto ' . $item->product->type->type . ' de coleção ' . $item->product->collection->collection . ' tem uma quantidade inválida de ' . $item->quantity . ' unidades.');
                }

                if($stock < 0)
                {
                    $stock = 0;
                }

                $product->update([
                    'stock' => $stock,
                ]);

                $totalPrice += round((($item->iva / 100) * ($item->price)) + $item->price, 2) * $item->quantity;

                array_push($items, (new InvoiceItem())->title($item->product->type->type)->pricePerUnit($item->price)->quantity($item->quantity)->taxByPercent($item->iva));
            }

            $paid = 1;
            $state = "Em Processamento";
            if($request->payment_method == 'Multibanco') {
                $paid = 0;
                $state = "Falta Pagamento";
            }

            Order::create([
                'cart_id' => $cart->id,
                'user_id' => $user->id,
                'delivery_id' => $delivery->id,
                'billing_id' => $billing->id,
                'additional' => $request->additional,
                'date_bought' => date('Y-m-d'),
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'total_price' => $totalPrice,
                'paid' => $paid,
                'state' => $state,
            ]);

            // Update tables in database
            $delivery->update([
                'used' => 1,
            ]);

            $billing->update([
                'used' => 1,
            ]);

            $cart->update([
                'bought' => 1,
            ]);

            // Get order to send e-mail to user
            $order = Order::latest()->first();

            // Create a new cart for user
            Cart::create([
                'user_id' => $user->id,
            ]);

            $buyer = new Buyer([
                'name'          => $delivery->name,
                'custom_fields' => [
                    'email' => 'test@example.com',
                ],
            ]);

            $invoice = Invoice::make()
                ->buyer($buyer)
                ->shipping(2)
                ->addItems($items)
                //->logo(public_path('assets/images/logo_2.svg'))
                // You can additionally save generated invoice to configured disk
                ->filename($order->order_number . '_order_invoice')
                ->save('invoices');

            Mail::to($user->email)->send(new OrderEmail($order, $delivery, $billing, $cartItems), function($message) use($order) {
                $message->attach(storage_path('app/public/invoices/' . $order->order_number . '_order_invoice'));
            });

            return redirect(route('online-shop.order-confirmation', [$order->order_number, $delivery->id, $billing->id]));
        }
    }

    public function update(Request $request, $id) {
        if($request->has('paid')) {
            Order::where('order_number', $id)->update([
                'paid' => 1,
            ]);
        }

        return redirect()->back();
    }

    public function confirmation($order, $delivery, $billing) {
        $order = Order::where('order_number', $order)->first();
        $delivery = Address::find($delivery);
        $billing = Address::find($billing);

        if(auth()->user()->id == $order->user_id) {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cartItems = CartItems::where('cart_id', $cart->id)->get();

            return view('onlineshop.orderconfirmation', compact('cartItems', 'order', 'delivery', 'billing'));
        }
        else {
            abort(403, 'Ação Não-Autorizada.');
        }
    }

    public function show($order) {
        $order = Order::where('order_number', $order)->first();

        if(auth()->user()->id == $order->user_id) {
            $cart = Cart::where('user_id', auth()->user()->id)->where('bought', 0)->latest()->first();
            $cartItems = CartItems::where('cart_id', $cart->id)->get();

            $cartOrder = CartItems::where('cart_id', $order->cart_id)->get();
            $addresses = Address::all();

            return view('onlineshop.profile.orders.show', compact('cartOrder', 'cartItems', 'order', 'addresses'));
        }
        else {
            abort(403, 'Ação Não-Autorizada.');
        }
    }
}
