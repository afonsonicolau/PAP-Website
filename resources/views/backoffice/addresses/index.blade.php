@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Endereços</h4>
                    <p class="card-description">Todos os endereços criados por todos os utilziadores constam nesta tabela.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Criador</th>
                                <th>Registado Em</th>
                                <th>Endereço</th>
                                <th>Telemóvel</th>
                                <th>NIF</th>
                                <th>País</th>
                                <th>Cidade</th>
                                <th>Código-Postal</th>
                                <th>Empresa</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $address)
                                <tr>
                                    <td>{{ $address->user->email }}</td>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>{{ $address->phone_number }}</td>
                                    <td>{{ $address->nif }}</td>  
                                    <td>{{ $address->country }}</td>
                                    <td>{{ $address->city }}</td>  
                                    <td>{{ $address->postal_code }}</td>
                                    <td>@if ($address->company == null)
                                            Nenhuma
                                        @else
                                            {{ $address->company }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($address->type == 1)
                                            Faturação	
                                        @elseif($address->type == 2)
                                            Envio
                                        @elseif($address->type == 3)
                                            Ambas
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $addresses->links() }}
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
 
@endsection