@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Encomenda Nº {{ $order->order_number }}</h4>
                    <p class="card-description">Aqui estão todos os detalhes da encomenda Nº {{ $order->order_number }}.</p>
                    <hr>
                    <div class="form-group">
                        <h4 class="card-title">ARTIGOS ENCOMENDADOS</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tipo do Item</th>
                                    <th>Coleção do Item</th>
                                    <th>Referência</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($order->cart_ids) as $cart_id)
                                    @foreach ($carts as $cart)
                                        @if ($cart->id == $cart_id)
                                            <tr>
                                                <td style="border: none;">{{ $cart->product->type->type }}</td>
                                                <td style="border: none;">{{ $cart->product->collection->collection }}</td>
                                                <td style="border: none;">{{ $cart->product->reference }}</td>
                                                <td style="border: none;">{{ $cart->price }}€</td>
                                                <td style="border: none;"><b>Encomendado:</b> {{ $cart->quantity }}</td>
                                                <td style="border: none;">{{ $cart->quantity * $cart->price }}€</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4><b>Morada de Faturação</b></h4>
                            <br>
                            {{ $order->billing->name }} <br>
                            {{ $order->billing->address }} <br>
                            T: {{ $order->billing->phone_number }} <br>
                            NIF: {{ $order->billing->nif }} <br>
                            {{ $order->billing->country }} <br>
                            {{ $order->billing->postal_code }} <br>
                            {{ $order->billing->city }} <br>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Morada de Envio</b></h4>
                            <br>
                            {{ $order->delivery->name }} <br>
                            {{ $order->delivery->address }} <br>
                            T: {{ $order->delivery->phone_number }} <br>
                            NIF: {{ $order->delivery->nif }} <br>
                            {{ $order->delivery->country }} <br>
                            {{ $order->delivery->postal_code }} <br>
                            {{ $order->delivery->city }} <br>
                        </div>
                        <div class="col-md-4">
                            <h4><b>Método de Envio e Pagamento</b></h4>
                            <br>
                            <b>Envio: </b>{{ $order->delivery_method }} <br>
                            <b>Pagamento: </b>{{ $order->payment_method }} 
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div> 


@endsection