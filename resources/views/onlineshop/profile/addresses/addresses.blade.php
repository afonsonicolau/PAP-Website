@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form" action="do_action" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>As Suas Moradas</h3>
                            <br>  
                            <div class="form-group">
                                <h4 class="col-md-6">MORADA DE ENVIO PADRÃO</h4>
                                <h4 class="col-md-6">MORADA DE FATURAÇÃO PADRÃO</h4>
                                <br>
                                <br>
                                    <div class="col-md-6">
                                        @php
                                            $count = 0;    
                                        @endphp
                                        @foreach ($addresses as $address)
                                            @if ($address->user_id == auth()->user()->id && $address->default == 0 && ($address->type == 2 || $address->type == 3))
                                                @php
                                                    $count++;    
                                                @endphp
                                                <p>{{ $address->name }}</p> 
                                                <p>{{ $address->address }}</p> 
                                                <p>T: {{ $address->phone_number }}</p> 
                                                <p>NIF: {{ $address->nif }}</p> 
                                                <p>{{ $address->country }}</p> 
                                                <p>{{ $address->postal_code }}</p> 
                                                <p>{{ $address->city }}</p> 
                                                @if ($address->used == 0)
                                                    <a href="{{ route('online-shop.edit-addresses', $address->id) }}" type="button" class="btn btn-warning">Editar Morada</a>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($count == 0)
                                            <p>Não existe uma morada de envio padrão.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6"> 
                                        @php
                                            $count = 0;    
                                        @endphp
                                        @foreach ($addresses as $address)
                                            @if ($address->user_id == auth()->user()->id && $address->default == 0 && ($address->type == 1 || $address->type == 3))
                                                @php
                                                    $count++;    
                                                @endphp
                                                <p>{{ $address->name }}</p> 
                                                <p>{{ $address->address }}</p> 
                                                <p>T: {{ $address->phone_number }}</p> 
                                                <p>NIF: {{ $address->nif }}</p> 
                                                <p>{{ $address->country }}</p> 
                                                <p>{{ $address->postal_code }}</p> 
                                                <p>{{ $address->city }}</p> 
                                                @if ($address->used == 0)
                                                    <a href="{{ route('online-shop.edit-addresses', $address->id) }}" type="button" class="btn btn-warning">Editar Morada</a>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($count == 0)
                                            <p>Não existe uma morada de faturação padrão.</p>
                                        @endif
                                    </div>  
                                    <div class="col-md-12 pt-20">
                                        <h4>MORADAS ADICIONAIS</h4>
                                        <hr>
                                    </div>
                                    @php
                                        $count = 0;    
                                    @endphp
                                    @foreach ($addresses as $address)
                                        @if ($address->user_id == auth()->user()->id && $address->default == 1)
                                        @php
                                            $count++;    
                                        @endphp
                                            <div class="col-md-6 pt-10">
                                                <p>{{ $address->name }}</p> 
                                                <p>{{ $address->address }}</p> 
                                                <p>T: {{ $address->phone_number }}</p> 
                                                <p>NIF: {{ $address->nif }}</p> 
                                                <p>{{ $address->country }}</p> 
                                                <p>{{ $address->postal_code }}</p> 
                                                <p>{{ $address->city }}</p> 
                                                @if ($address->used == 0)
                                                    <a href="{{ route('online-shop.edit-addresses', $address->id) }}" type="button" class="btn btn-warning">Editar Morada</a>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach 
                                    @if ($count == 0)
                                        <div class="col-md-6">
                                            <p>Não existem moradas adicionais.</p>
                                        </div>
                                    @endif
                                </div> 
                            </div>  
                            <div class="col-md-12 pt-20"> 
                                
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
                                <h3>Moradas</h3>
                                <p>Aqui estão todas as suas moradas, pode editá-las e criar outras se precisar! Lembre-se, após utilizar uma morada não poderá editá-la novamente.</p>
                                <a href="{{ route('online-shop.create-addresses') }}" type="button" class="btn btn-primary" style="color: white; text-decoration: none;">Criar Morada</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection