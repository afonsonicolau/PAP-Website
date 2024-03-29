<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $delivery, $billing, $cartItems;

    public function __construct($order, $delivery, $billing, $cartItems)
    {
        $this->order = $order;
        $this->delivery = $delivery;
        $this->billing = $billing;
        $this->cartItems = $cartItems;
    }
    public function build()
    {
        return $this->markdown('emails.order')->with([  'order' => $this->order,
                                                        'delivery' => $this->delivery,
                                                        'billing' => $this->billing,
                                                        'cartItems' => $this->cartItems,])->subject('Olfaire - Nova Encomenda');
    }
}
