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

                                        <form class="ps-checkout__form" method="POST" action="{{ route('online-shop.profile-changeinfo') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            @if($errors->has('current-password'))
                                                <p class="text-danger">{{$errors->first('current-password')}}</p>
                                            @endif
                                            @if($errors->has('password'))
                                                <p class="text-danger">{{$errors->first('password')}}</p>
                                            @endif

                                            <div class="form-group pt-30 info">
                                                <label>Palavra-passe Atual<span class="text-danger">*</span></label><br>
                                                <input type="password" class="form-input" id="current-password" name="current-password" data-validate="yes" data-min="8" data-type="required" autocomplete="current-password"> 
                                            </div>
                                            <div class="form-group pt-10 info">
                                                <label>Nova Palavra-passe<span class="text-danger">*</span></label><br>
                                                <input type="password" class="form-input" id="password" name="password" autocomplete="password" data-validate="yes" data-type="password"> 
                                            </div>
                                            <div class="form-group pt-10 info">
                                                <label>Confirmar Palavra-passe<span class="text-danger">*</span></label><br>
                                                <input type="password" class="form-input" id="password_confirmation" name="password_confirmation" name="password_confirmation" autocomplete="password_confirmation" data-validate="yes" data-type="confirmpassword"> 
                                            </div>
                                            
                                            <div class="form-group pt-10 info">
                                                <button type="submit" class="btn btn-success">Mudar Password</button>
                                            </div>
                                        </form>
                                        @if(Session::has('error'))
                                            <div class="alert alert-danger">
                                                <p>{{ Session::get('error') }}</p>
                                            </div>
                                        @endif
                                        @if (Session::has('success'))
                                            <div class="alert alert-success">
                                                <p>{{ Session::get('success') }}</p>
                                            </div>
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