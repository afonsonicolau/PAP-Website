@extends('layouts.online-shop')

@section('content')

<div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
    <form class="ps-checkout__form" action="do_action" method="post">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                <div class="ps-checkout__billing">
                <h3>As Suas Informações</h3>
                        <div class="form-group form-group--inline">
                        <label>First Name<span>*</span>
                        </label>
                        <input class="form-control" type="text">
                        </div>
                        <div class="form-group form-group--inline">
                        <label>Last Name<span>*</span>
                        </label>
                        <input class="form-control" type="text">
                        </div>
                        <div class="form-group form-group--inline">
                        <label>Company Name<span>*</span>
                        </label>
                        <input class="form-control" type="text">
                        </div>
                        <div class="form-group form-group--inline">
                        <label>Email Address<span>*</span>
                        </label>
                        <input class="form-control" type="email">
                        </div>
                        <div class="form-group form-group--inline">
                        <label>Company Name<span>*</span>
                        </label>
                        <input class="form-control" type="text">
                        </div>
                        <div class="form-group form-group--inline">
                        <label>Phone<span>*</span>
                        </label>
                        <input class="form-control" type="text">
                        </div>
                        <div class="form-group form-group--inline">
                        <label>Address<span>*</span>
                        </label>
                        <input class="form-control" type="text">
                        </div>
                <div class="form-group">
                    <div class="ps-checkbox">
                    <input class="form-control" type="checkbox" id="cb01">
                    <label for="cb01">Criar outra morada?</label>
                    </div>
                </div>
                <h3 class="mt-40">Informação Adicional (Não obrigatório)</h3>
                <div class="form-group form-group--inline textarea">
                    <label>Notas</label>
                    <textarea class="form-control" rows="5" placeholder="Notas adicionais para a sua entrega."></textarea>
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
                <h3>Atenção</h3>
                <p>Confira todos os dados antes de efetuar a compra.
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

@endsection