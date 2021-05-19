<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $subject, $message, $email;

    public function __construct($name, $subject, $message, $email)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message;
        $this->email = $email;
    }

    public function build()
    {
        return $this->markdown('emails.company')->with([  'name' => $this->name, 
                                                        'message' => $this->message,
                                                        'email' => $this->email])->subject('Nova mensagem - ' . $this->subject);
    }   
}
