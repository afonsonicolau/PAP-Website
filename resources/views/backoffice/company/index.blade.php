@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2>Informações da Empresa</h2>
                    <hr><br>
                    <h3>Entidades</h3>
                    <hr>
                    <div class="atm">
                        <h4>Multibanco</h4>
                        <p>REF: <b>{{ $data->atm_reference }}</b> <a type="button" href="#" onclick="changeDetails('atm', {{ $data->atm_reference }}, 0)"><i class="fas fa-pen"></i></a></p> 
                    </div>
                    <div class="paypal">
                        <h4>Paypal</h4>
                        <p>REF: <b>{{ $data->paypal_reference }}</b> <a type="button" href="#" onclick="changeDetails('paypal', {{ $data->paypal_reference }}, 0)"><i class="fas fa-pen"></i></a></p> 
                    </div>
                    <div class="debitcard">
                        <h4>Cartão de Débito</h4>
                        <p>REF: <b>{{ $data->debitcard_reference }}</b> <a type="button" href="#" onclick="changeDetails('debitcard', {{ $data->debitcard_reference }}, 0)"><i class="fas fa-pen"></i></a></p> 
                    </div>
 
                    <br>

                    <h3>IVA & Outros</h3>
                    <hr>
                    <div class="iva">
                        <h4>IVA</h4>
                        <p><b>{{ $data->iva }}%</b> <a type="button" href="#" onclick="changeDetails('iva', {{ $data->iva }}, 0)"><i class="fas fa-pen"></i></a></p>
                    </div>

                    @if(Session::has('error'))
                        <div class="pt-20 alert alert-danger text-center" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>   

@endsection        