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
                                <th>Estado</th>
                                <th>Preço Total</th>
                                <th>Data da Compra</th>
                                <th>Tipo de Pagamento</th>
                                <th>Tipo de Envio</th>
                                <th>Adicional</th>
                                <th>Ver Mais</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ $order->state }}</td>
                                    <td>{{ $order->total_price }}€</td>
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
                                    <td><a class="btn btn-primary" href="{{ route("orders.show", $order->order_number)}}" data-toggle="tooltip" data-placement="top" title="Ver Mais"><i class="fas fa-plus"></i></a></td>
                                    <td>@if ($order->paid == 0) 
                                            <td class="text-danger">Por pagar</td>
                                        @else
                                            <td class="text-success">Pago</td>
                                        @endif
                                    </td>
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