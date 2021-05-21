@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form" action="{{ route('online-shop.store-addresses', auth()->user()->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>Registar uma Morada</h3>
                            <p class="required-red">*Obrigatório</p>
                            <div class="form-group form-group--inline">
                                <label>Nome<span class="required-red">*</span></label>
                                <input class="form-control" id="nome" name="nome"type="text" placeholder="Nome em que fica registado a morada" value="{{ old('nome') }}" data-validate="yes" data-min="5" data-max="144" data-type="string">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Endereço<span class="required-red">*</span> </label>
                                <input id="endereço" name="endereço" class="form-control" type="text" placeholder="Endereço desejado" value="{{ old('endereço') }}" data-validate="yes" data-min="5" data-max="255" data-type="string">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Telemóvel<span class="required-red">*</span></label>
                                <input id="telemóvel" name="telemóvel" class="form-control" type="text" placeholder="Número de telemóvel" value="{{ old('telemóvel') }}" data-validate="yes" data-min="9" data-max="9" data-type="int">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>NIF</label>
                                <input id="nif" name="nif" class="form-control" type="text" placeholder="Não preencher caso não queira registar o mesmo" value="{{ old('nif') }}" data-validate="yes" data-min="9" data-max="9" data-type="nif">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>País<span class="required-red">*</span></label>
                                <select class="form-control" name="país" id="país" required>
                                    <option value="" disabled selected>--Selecione um país--</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Espanha">Espanha</option>
                                    <option value="França">França</option>
                                </select>
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Código Postal<span class="required-red">*</span></label>
                                <input id="códigopostal" name="códigopostal" class="form-control" type="text" placeholder="1234-123" value="{{ old('códigopostal') }}" data-validate="yes" data-type="postalcode">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Cidade<span class="required-red">*</span></label>
                                <input id="cidade" name="cidade" class="form-control" type="text" placeholder="Cidade onde se encontra a morada" value="{{ old('cidade') }}" data-validate="yes" data-min="2" data-max="100" data-type="string"> 
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Empresa</label>
                                <input id="empresa" name="empresa" class="form-control" type="text" placeholder="Preencher com o nome da empresa caso a morada seja numa" value="{{ old('empresa') }}" data-validate="yes" data-min="0" data-max="255" data-type="string">
                            </div>
                            <div class="form-group form-group--inline">
                                <label>Definição da Morada<span class="required-red">*</span></label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="" disabled selected>--Escolha uma opção--</option>
                                    <option value="1">Faturação</option>
                                    <option value="2">Envio</option>
                                    <option value="3">Ambas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="ps-checkbox">
                                    <input class="form-control" type="checkbox" id="cb01">
                                    <button type="submit" class="btn btn-primary">Criar Morada</button>
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