@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form" action="do_action" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing form-group--inline">
                            <h3 >A Sua Conta</h3>
                            <hr>
                            <div class="form-group">
                                <div>
                                    <h4>INFORMAÇÕES DE CONTACTO</h4>
                                    <br>
                                    {{ auth()->user()->username }} <br>
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                            @foreach ($addresses as $address)
                                @if ($address->user_id == auth()->user()->id && $address->default == 0 && ($address->type == 2 || $address->type == 3))
                                    <hr>
                                    <div class="form-group">
                                        <div>
                                            <h4>MORADA DE ENVIO PADRÃO</h4>
                                            <br>
                                            {{ $address->name }} <br>
                                            {{ $address->address }} <br>
                                            T: {{ $address->phone_number }} <br> 
                                            NIF: {{ $address->nif }} <br>
                                            {{ $address->country }} <br>
                                            {{ $address->postal_code }} <br>
                                            {{ $address->city }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            
                            @foreach ($addresses as $address)
                                @if ($address->user_id == auth()->user()->id && $address->default == 0 && ($address->type == 1 || $address->type == 3))
                                    <hr>
                                    <div class="form-group">
                                        <div>
                                            <h4>MORADA DE ENVIO PADRÃO</h4>
                                            <br>
                                            {{ $address->name }} <br>
                                            {{ $address->address }} <br>
                                            T: {{ $address->phone_number }} <br>
                                            NIF: {{ $address->nif }} <br>
                                            {{ $address->country }} <br>
                                            {{ $address->postal_code }} <br>
                                            {{ $address->city }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <hr>
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
                        <h3>Atenção</h3>
                        <p>Confira todos os dados antes de efetuar a compra.
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection