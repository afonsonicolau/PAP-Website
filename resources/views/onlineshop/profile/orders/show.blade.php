@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        <div class="ps-checkout__billing">
                            <h3>Encomenda # {{ $order->order_number }}</h3>
                            <hr>
                            <div class="form-group">
                                <h4>ARTIGOS ENCOMENDADOS</h4>
                                <br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tipo do Item</th>
                                            <th>Coleção do Item</th>
                                            <th>Referência</th>
                                            <th>Preço</th>
                                            <th>Quantidade</th>
                                            <th>IVA</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td style="border: none;">{{ $item->product->type->type }}</td>
                                                <td style="border: none;">{{ $item->product->collection->collection }}</td>
                                                <td style="border: none;">{{ $item->product->reference }}</td>
                                                <td style="border: none;">{{ $item->price }}€</td>
                                                <td style="border: none;"><b>Encomendado:</b> {{ $item->quantity }}</td>
                                                <td style="border: none;">{{ $item->iva }}%</td>
                                                <td style="border: none;">{{ round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity }}€</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-4">
                                    <h4><b>Morada de Faturação</b></h4>
                                    <br>
                                    @foreach ($addresses as $address)
                                        @if ($address->id == $order->billing_id)
                                            {{ $address->name }} <br>
                                            {{ $address->address }} <br>
                                            T: {{ $address->phone_number }} <br>
                                            NIF: {{ $address->nif }} <br>
                                            {{ $address->country }} <br>
                                            {{ $address->postal_code }} <br>
                                            {{ $address->city }} <br>
                                            @break
                                        @endif
                                    @endforeach
                                </div>  
                                <div class="col-md-4">
                                    <h4><b>Morada de Envio</b></h4>
                                    <br>
                                    @foreach ($addresses as $address)
                                        @if ($address->id == $order->delivery_id)
                                            {{ $address->name }} <br>
                                            {{ $address->address }} <br>
                                            T: {{ $address->phone_number }} <br>
                                            NIF: {{ $address->nif }} <br>
                                            {{ $address->country }} <br>
                                            {{ $address->postal_code }} <br>
                                            {{ $address->city }} <br>
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <h4><b>Método de Envio e Pagamento</b></h4>
                                    <br>
                                    <b>Envio: </b>{{ $order->delivery_method }} <br>
                                    <b>Pagamento: </b>{{ $order->payment_method }}
                                </div>
                                
                            </div>                        
                        </div>  
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="ps-checkout__order" style="background-color: rgb(160, 161, 163);">
                                <header>
                                    <h3><a href="{{ route('online-shop.profile-index') }}">A Sua Conta</a></h3>
                                </header>
                                <div class="content" >
                                    <a href="{{ route('online-shop.profile-orders') }}">As Minhas Encomendas</a>         <br>
                                    <a href="{{ route('online-shop.profile-addresses') }}">As Minhas Moradas</a>            <br>
                                    <a href="{{ route('online-shop.profile-personal') }}">Mudar Informações da Conta</a>
                                </div>
                            </div>
                            <div class="ps-shipping">
                                <h3>Encomendas</h3>
                                <p>Aqui estão todas as suas encomendas, pode editá-las e criar outras se precisar!</p>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>
        
        </div>
    </div>

@endsection