<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $carts, $delivery, $billing;

    public function __construct($order, $carts, $delivery, $billing)
    {
        $this->order = $order;
        $this->carts = $carts;
        $this->delivery = $delivery;
        $this->billing = $billing;
    }
    public function build()
    {
        return $this->markdown('emails.order')->with(['order' => $this->order, 'carts' =>$this->carts]);
    }
}
