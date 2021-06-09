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
                                    <th>Preço s/IVA</th>
                                    <th>Quantidade</th>
                                    <th>Sub-total s/IVA</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalQuantity = 0;   
                                @endphp
                                @foreach ($cartItems as $item)
                                    @php
                                        $totalQuantity =+ $item->quantity;   
                                    @endphp
                                    <tr>
                                        <td style="border: none;">{{ $item->product->type->type }}</td>
                                        <td style="border: none;">{{ $item->product->collection->collection }}</td>
                                        <td style="border: none;">{{ $item->product->type->reference }}</td>
                                        <td style="border: none;">{{ $item->price }}€</td>
                                        <td style="border: none;"><b>Encomendado:</b> {{ $item->quantity }}</td>
                                        <td style="border: none;">{{ $item->price * $item->quantity }}€</td>
                                        <td style="border: none;">{{ $item->iva }}%</td>
                                        <td style="border: none;">{{ round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity }}€</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-2"><b>Total da Encomenda:</b>  {{ $order->total_price }}€ </div>
                            <div class="col-md-2"><b>Quantidade Total:</b> {{ $totalQuantity }} produto(s)</div>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4 style="text-align: center;"><b>Morada de Faturação</b></h4>
                            <hr>
                            <div style="margin-left: 153px">
                                {{ $order->billing->name }} <br>
                                {{ $order->billing->address }} <br>
                                T: {{ $order->billing->phone_number }} <br>
                                NIF: {{ $order->billing->nif }} <br>
                                {{ $order->billing->country }} <br>
                                {{ $order->billing->postal_code }} <br>
                                {{ $order->billing->city }} <br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4 style="text-align: center;"><b>Morada de Envio</b></h4>
                            <hr>
                            <div style="margin-left: 173px">
                                {{ $order->delivery->name }} <br>
                                {{ $order->delivery->address }} <br>
                                T: {{ $order->delivery->phone_number }} <br>
                                NIF: {{ $order->delivery->nif }} <br>
                                {{ $order->delivery->country }} <br>
                                {{ $order->delivery->postal_code }} <br>
                                {{ $order->delivery->city }} <br>
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <h4 style="text-align: center;"><b>Método de Envio e Pagamento</b></h4>
                            <hr>
                            <div style="margin-left: 112px">
                                <b>Envio: </b>{{ $order->delivery_method }} <br>
                                <b>Pagamento: </b>{{ $order->payment_method }} 
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div> 


@endsection