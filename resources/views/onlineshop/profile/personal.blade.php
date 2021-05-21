@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <form class="ps-checkout__form">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing">
                            <h3>As Suas Informações</h3>
                            <hr>
                            <br>
                            <div class="form-group">
                                    <div class="col-md-12 addresses">
                                        <p><b>Nome de Utilizador:</b> {{ auth()->user()->username }}</p> 
                                        <p><b>E-mail:</b> {{ auth()->user()->email }}</p>
                                        <hr>
                                        <input class="pt-10" type="checkbox" id="changepassword"> Alterar Palavra-passe

                                        <form class="ps-checkout__form" method="POST" action="{{ route('online-shop.profile-changeinfo') }}" enctype="multipart/form-data" style="margin-top: 50px;">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group pt-30 info hidden">
                                                <label>Palavra-passe Atual<span class="text-danger">*</span></label><br>
                                                <input type="password" class="form-input" id="old-password" name="old-password"> 
                                            </div>
                                            <div class="form-group pt-10 info hidden">
                                                <label>Nova Palavra-passe<span class="text-danger fw-bolder">*</span></label><br>
                                                <input type="password" class="form-input" id="password" name="password" data-validate="yes" data-type="password"> 
                                            </div>
                                            <div class="form-group pt-10 info hidden">
                                                <label>Confirmar Palavra-passe<span class="text-danger">*</span></label><br>
                                                <input type="password" class="form-input" name="password_confirmation" id="password-confirm" data-validate="yes" data-type="confirmpassword"> 
                                            </div>
                                        </form>
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
                                    <a class="profile-side-text" href="{{ route('online-shop.profile-addresses') }}">As Minhas Moradas</a> <br>
                                    <a class="profile-side-text" href="{{ route('online-shop.profile-orders') }}">As Minhas Encomendas</a> <br>
                                </div>
                            </div>
                            <div class="ps-shipping">
                                <h3>Informações</h3>
                                <p>Todas as suas informações constam nesta página, caso queira mudar a sua palara-passe, clique no botão a dizer "Alterar Palavra-passe".</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection