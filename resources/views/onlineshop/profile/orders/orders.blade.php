@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>As Suas Encomendas</h3>
                            <br>
                            <div class="form-group">
                                    <div class="col-md-12">
                                        @php
                                            $count = 0;    
                                        @endphp
                                        @foreach ($orders as $order)
                                            @if ($order->user_id == auth()->user()->id)
                                                @php
                                                    $count++;    
                                                @endphp
                                                <h4 class="pb-10">Encomenda Nº {{ $order->order_number }} - <i>{{ $order->state }}</i></h4> @if($order->paid == 0) <form action="{{ route('online-shop.update-order', $order->id) }}" method="POST"><button type="submit" class="btn btn-primary">Acabar Pagamento</button></form> @endif
                                                
                                                <p style="color:black;">{{ $order->date_bought }}</p> 
                                                <p style="color: black;">{{ $order->total_price }} €</p> 
                                                <a href="{{ route('online-shop.show-orders', $order->order_number) }}" type="button" class="btn btn-info">Ver Detalhes</a>
                                            @endif
                                            <hr>
                                        @endforeach
                                        @if ($count == 0)
                                            <p>Não existe nenhuma encomenda, por enquanto.</p>
                                        @else
                                            {{ $count }} Item(s)
                                        @endif
                                    </div>
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
                                <p>Aqui estão todas as suas encomendas!</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection