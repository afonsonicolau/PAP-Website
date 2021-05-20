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
                                <th>Pago?</th>
                                <th>Adicional</th>
                                <th>Ver Mais</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $states = array('Falta Pagamento', 'Em Processamento', 'Produtos em Distribuição')   
                            @endphp
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->email }}</td>
                                    <td>
                                        <select class="form-control form-control-lg" name="state" id="state">
                                            @foreach ($states as $state)
                                                @if($state == $order->state)
                                                    <option value="{{ $order->state }}" selected disabled>{{ $order->state }}</option>  
                                                @else
                                                    <option value="{{ $state }}">{{ $state }}</option> 
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $order->total_price }}€</td>
                                    <td>{{ $order->date_bought }}</td>
                                    <td>{{ $order->payment_method }}</td>  
                                    <td>{{ $order->delivery_method }}</td>
                                    @if ($order->paid == 0) 
                                        <td class="text-danger"><b>Por pagar</b></td>
                                    @else
                                        <td class="text-success"><b>Pago</b></td>
                                    @endif
                                    <td>
                                        @if ($order->adittional == null)
                                            Nenhuma informação adicional
                                        @else
                                            {{ $order->adittional }}
                                        @endif 
                                    </td>
                                    <td><a class="btn btn-primary" href="{{ route("orders.show", $order->order_number)}}" data-toggle="tooltip" data-placement="top" title="Ver Mais"><i class="fas fa-plus"></i></a></td>
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