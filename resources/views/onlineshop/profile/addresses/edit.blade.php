@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form" action="{{ route('online-shop.update-addresses', $address->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>Atualizar uma Morada</h3>
                            <p class="required-red">*Obrigatório</p>
                            <hr>
                            <div class="form-group form-group--inline">
                                <label>Nome<span class="required-red">*</span></label>
                                <input class="form-control" id="nome" name="nome" type="text" placeholder="Nome em que fica registado a morada" value="{{ $address->name }}" data-validate="yes" data-min="5" data-max="144" data-type="string">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Endereço<span class="required-red">*</span> </label>
                                <input id="endereço" name="endereço" class="form-control" type="text" placeholder="Endereço desejado" value="{{ $address->address }}" data-validate="yes" data-min="5" data-max="255" data-type="string">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Telemóvel<span class="required-red">*</span></label>
                                <input id="telemóvel" name="telemóvel" class="form-control" type="text" placeholder="Número de telemóvel" value="{{ $address->phone_number }}" data-validate="yes" data-min="9" data-max="9" data-type="int">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>NIF<span class="required-red">*</span></label>
                                <input id="nif" name="nif" class="form-control" type="text" placeholder="Não preencher caso não queira registar o mesmo" value="{{ $address->nif }}" data-validate="yes" data-min="9" data-max="9" data-type="nif">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>País<span class="required-red">*</span></label>
                                <select class="form-control" name="país" id="país" required>
                                    @foreach ($countries as $country)
                                        @if ($address->country == $country)
                                            <option value="{{ $address->country }}" selected>{{ $address->country }}</option>
                                        @else
                                            <option value="{{ $country }}" selected>{{ $country }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Código Postal<span class="required-red">*</span></label>
                                <input id="códigopostal" name="códigopostal" class="form-control" type="text" value="{{ $address->postal_code }}" placeholder="1234-123" data-validate="yes" data-type="postalcode">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Cidade<span class="required-red">*</span></label>
                                <input id="cidade" name="cidade" class="form-control" type="text" placeholder="Cidade onde se encontra a morada" value="{{ $address->city }}" data-validate="yes" data-min="2" data-max="100" data-type="string"> 
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Empresa (Se aplicável)</label>
                                <input id="empresa" name="empresa" class="form-control" type="text" placeholder="Preencher caso a mesma seja numa empresa" value="{{ $address->company }}" data-validate="yes" data-min="0" data-max="100" data-type="string">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Definição da Morada<span class="required-red">*</span></label>
                                <select class="form-control" name="type" id="type" required>
                                    @foreach ($types as $key => $type)
                                        @if ($address->type == $key)
                                            <option value="{{ $key }}" selected>{{ $type }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="ps-checkbox">
                                    <button type="submit" class="btn btn-warning">Atualizar Morada</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                    <h3>Atenção</h3>
                    <p>Confira todos os dados antes de efetuar a compra.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection