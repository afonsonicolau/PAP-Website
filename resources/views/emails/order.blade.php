@component('mail::message')
# Estimado(a) {{ $order->user->username }}

<p>Obrigado por comprar na Olfaire Mendes&Nicolau, esperemos que seja um produto que goste e que use no seu dia a dia.</p>
Caso necessite de algum esclarecimento relativamente à entrega da sua encomenda, poderá contactar os nossos serviços, através do e-mail encomendas@olfaire.com. <br>
Caso realize tracking da sua encomenda com a Guia entregue e o site dos CTT indicar "Objeto não encontrado/Informação Indisponível", deverá aguardar até cerca das 21h do dia em que a expedição é feita, por se tratar da hora prevista para registo das Guias CTT no sistema da Transportadora. <br>

<br>
<p style="font-size: 17px;"><b>Produtos Encomendados</b></p>
<hr>
@foreach ($cartItems as $item)
    <div class="col-md-12" style="font-size: 15px;">
        <b>Item:</b> {{ $item->product->type->type }}, {{ $item->product->collection->collection }}<br>
        <b>REF:</b> {{ $item->product->reference }} <br>
        <b>Quantidade:</b> {{ $item->quantity }} <br>
        <b>IVA:</b> {{ $item->iva }}% <br>
        <b>Sub-total:</b> {{ $item->price *  $item->quantity }}€ <br>
        <b>Total c/IVA:</b> {{ round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity }}€
    </div>
    <hr>
@endforeach

<br>
Muito obrigado,<br>
{{ config('app.name') }}
@endcomponent
