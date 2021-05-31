<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

class CustomVerifyEmailNotification extends Notification
{

    public static $createUrlCallback;
    public static $toMailCallback;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return $this->buildMailMessage($verificationUrl);
    }

    protected function buildMailMessage($url)
    {
        $salutation = config('app.name');
        return (new MailMessage)
            ->subject(Lang::get('Bem-vindo à Olfaire.'))
            ->greeting('Seja bem-vindo!')
            ->line(Lang::get('Obrigado por registar-se na Olfaire, esperemos que encontre o que deseja.'))
            ->line(Lang::get('Por favor, clique no botão abaixo para verificar o seu e-mail.'))
            ->action(Lang::get('Verificar E-mail'), $url)
            ->line(Lang::get('Se você não criou uma conta, ignore este e-mail.'))
            ->salutation(new HtmlString("Com os melhores cumprimentos, <br>{$salutation}"));
    }

    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
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
