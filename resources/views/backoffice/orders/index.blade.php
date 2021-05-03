@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Encomendas</h4>
                    <p class="card-description">Todas as encomendas feitas por parte de todos os utilizadores são listadas nesta tabela.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Criador</th>
                                <th>Registado Em</th>
                                <th>Endereço</th>
                                <th>Data da Compra</th>
                                <th>Tipo de Pagamento</th>
                                <th>Tipo de Envio</th>
                                <th>Adicional</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ $order->address->name }}</td>
                                    <td>{{ $order->address->address }}</td>
                                    <td>{{ $order->date_bought }}</td>
                                    <td>{{ $order->payment_method }}</td>  
                                    <td>{{ $order->delivery_method }}</td>
                                    <td>
                                        @if ($order->adittional == null)
                                            Nenhuma informação adicional
                                        @else
                                            {{ $order->adittional }}
                                        @endif 
                                    </td>
                                    <td><a class="btn btn-primary" href="" data-toggle="tooltip" data-placement="top" title="Ver Mais"><i class="fas fa-plus"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
 
@endsection