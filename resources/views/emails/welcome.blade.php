@component('mail::message')
# Bem-vindo à Olfaire Mendes&Nicolau

Obrigado por registar-se, esperemos que encontre o que deseja no nosso website. Por favor, confirme o seu e-mail ao clicar no botão abaixo.

@component('mail::button', ['url' => route('mailable.verifyemail', $user->token)])
Confirmar E-mail
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
