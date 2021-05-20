@extends('layouts.online-shop')

@section('content')

<div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
    <form class="ps-checkout__form" action="do_action" method="post">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                <div class="ps-checkout__billing">

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
                <h3>O seu perfil!</h3>
                <p>Confira todos os dados antes de efetuar a compra.
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

@endsection