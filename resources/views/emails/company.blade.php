@component('mail::message')

<h1 class="text-center">Novo e-mail por parte de um utilizador</h1>

<br>
<p><b>Nome do utilizador:</b> {{ $name }}</p>
<p><b>E-mail do utilizador:</b> {{ $email }}</p>
<br>

<p><b>Mensagem do Utilizador:</b> {{ $message }}</p>

@endcomponent
