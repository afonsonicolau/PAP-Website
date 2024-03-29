@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>As Suas Encomendas</h3>
                            <hr>
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
                                                <h4 class="pb-10">Encomenda Nº {{ $order->order_number }} - @if($order->paid == 0) <b class="text-danger text-uppercase">{{ $order->state }}</b> @else <b class="text-info text-uppercase">{{ $order->state }}</b> @endif</h4>  
                                                <p style="color:black;">{{ $order->date_bought }}</p> 
                                                <p style="color: black;">{{ $order->total_price }} €</p> 
                                                <a href="{{ route('online-shop.show-orders', $order->order_number) }}" type="button" class="btn btn-info">Ver Detalhes</a>
                                                <hr>
                                            @endif
                                            
                                        @endforeach
                                        @if ($count == 0)
                                            <hr>    
                                            <p>Não existe nenhuma encomenda, por enquanto.</p>
                                        @else
                                            {{ $count }} Encomenda(s)
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div>  
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="ps-profile">
                                <header>
                                    <h3>O SEU PERFIL</h3>
                                </header>
                                <div class="content">
                                    <a class="profile-side-text" href="{{ route('online-shop.profile-personal') }}">Informações da Conta</a> <br>
                                    <a class="profile-side-text" href="{{ route('online-shop.profile-addresses') }}" >As Minhas Moradas</a> <br>
                                    <a class="profile-side-text" href="{{ route('online-shop.profile-orders') }}">As Minhas Encomendas</a> <br>
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