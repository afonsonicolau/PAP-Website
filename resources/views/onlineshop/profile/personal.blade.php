@extends('layouts.online-shop')

@section('content')

    <div class="ps-checkout pt-80 pb-80">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                        <h3>As Suas Informações</h3>
                        <hr>
                        <br>
                        <div>
                            <div class="col-md-12 addresses">
                                <p><b>Nome de Utilizador:</b> {{ auth()->user()->username }}</p>
                                <p><b>E-mail:</b> {{ auth()->user()->email }}</p>
                                <hr>

                                @if ($errors->has('any') || Session::has('error'))
                                    <input class="pb-10" type="checkbox" id="changepassword" onclick="hideInputs()" checked> Alterar Palavra-passe
                                @else
                                    <input class="pb-10" type="checkbox" id="changepassword" onclick="hideInputs()"> Alterar Palavra-passe
                                @endif

                                <form class="ps-checkout__form" method="POST" action="{{ route('online-shop.profile-changeinfo') }}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group pt-10 hidden info">
                                        <label>Palavra-passe Atual<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password" style="width: 40%;">
                                    </div>
                                    <div class="form-group pt-10 hidden info">
                                        <label>Nova Palavra-passe<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" autocomplete="password" data-validate="yes" data-type="password" style="width: 40%;">
                                    </div>
                                    <div class="form-group pt-10 hidden info">
                                        <label>Confirmar Palavra-passe<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="password_confirmation" data-validate="yes" data-type="confirmpassword" style="width: 40%;">
                                    </div>

                                    <div class="form-group pt-10 hidden info">
                                        <button type="submit" class="btn btn-success">Mudar Password</button>
                                    </div>

                                    @if ($errors->has('current_password'))
                                        <div class="pt-20">
                                            <p class="text-danger">{{ $errors->first('current_password') }}</p>
                                        </div>
                                    @endif
                                    @if ($errors->has('password'))
                                        <div class="pt-20">
                                            <p class="text-danger">{{ $errors->first('password') }}</p>
                                        </div>
                                    @endif

                                    @if (Session::has('error'))
                                        <div class="pt-20">
                                            <p class="text-danger">{{ Session::get('error') }}</p>
                                        </div>
                                    @endif

                                    @if (Session::has('success'))
                                        <div class="pt-20">
                                            <p class="text-danger">{{ Session::get('success') }}</p>
                                        </div>
                                    @endif
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
                        <p>Todas as suas informações constam nesta página, caso queira mudar a sua palara-passe, clique no botão "Alterar Palavra-passe".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
