<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $delivery, $billing;

    public function __construct($order, $delivery, $billing)
    {
        $this->order = $order;
        $this->delivery = $delivery;
        $this->billing = $billing;
    }
    public function build()
    {
        return $this->markdown('emails.order')->with(['order' => $this->order, 'delivery' => $this->delivery, 'billing' => $this->billing])->subject('Olfaire - Nova Encomenda');
    }
}
