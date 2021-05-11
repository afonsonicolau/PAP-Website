@component('mail::message')
# Estimado(a) {{ $order->user->username }}

<p>Obrigado por comprar na Olfaire Mendes&Nicolau, esperemos que seja um produto que goste e que use no seu dia a dia.</p>
Caso necessite de algum esclarecimento relativamente à entrega da sua encomenda, poderá contactar os nossos serviços, através do e-mail encomendas@olfaire.com. <br>
Caso realize tracking da sua encomenda com a Guia entregue e o site dos CTT indicar "Objeto não encontrado/Informação Indisponível", deverá aguardar até cerca das 21h do dia em que a expedição é feita, por se tratar da hora prevista para registo das Guias CTT no sistema da Transportadora. <br>

<p style="font-size: 17px;"><b>Produtos Encomendados</b></p>
<hr>
@foreach (json_decode($order->cart_ids) as $cart_id)
    @foreach ($carts as $cart)
        @if ($cart->id == $cart_id)
            <div class="col-md-12" style="font-size: 15px;">
                <b>Item:</b> {{ $cart->product->type->type }}, {{ $cart->product->collection->collection }}<br>
                <b>REF:</b> {{ $cart->product->reference }} <br>
                <b>Quantidade:</b> {{ $cart->quantity }} <br>
                <b>Total:</b> {{ round($cart->price / ((100 - $cart->iva)/100), 2) * $cart->quantity }}€
            </div>
        @endif
    @endforeach
@endforeach

<br>
Muito obrigado,<br>
{{ config('app.name') }}
@endcomponent
