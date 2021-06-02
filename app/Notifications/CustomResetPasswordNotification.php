<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Lang;

class CustomResetPasswordNotification extends Notification
{
    
    public $token;
    public static $createUrlCallback;
    public static $toMailCallback;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        if (static::$createUrlCallback) {
            $url = call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        } else {
            $url = url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        }

        return $this->buildMailMessage($url);
    }

    protected function buildMailMessage($url)
    { 
        $salutation = config('app.name');
        return (new MailMessage)
            ->subject('Olfaire - Mudar Palavra-passe')
            ->greeting('Esqueceu-se da sua palavra-passe?')
            ->line('Você está a receber este e-mail porque nós recebemos um pedido de mudança de palavra-passe para a sua conta.')
            ->action('Mudar Palavra-passe', $url)
            ->line(Lang::get('Este pedido vai expirar em :count minutos, caso o tenha feito, mude a sua palavra-passe dentro do tempo referido', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line('Se não fez qualquer pedido para mudar a palavra-passe, por favor, ignore este e-mail')
            ->salutation(new HtmlString("Com os melhores cumprimentos, <br>{$salutation}"));
    }

    public static function createUrlUsing($callback)
    {
        static::$createUrlCallback = $callback;
    }

    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
