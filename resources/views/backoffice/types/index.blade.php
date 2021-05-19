@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Tipos de Produtos</h4>
                    <p class="card-description">Todos os tipos de produtos são listados nesta secção, os mesmos podem ser editados ou removidos.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Referência</th>
                                <th>Tipo de Produto</th>
                                <th>Número de Produtos Associados</th>
                                <th>Editar/Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr id="type_{{ $type->id }}">
                                    <td>{{ $type->reference }}</td>
                                    <td>{{ $type->type }}</td>
                                    <td>
                                        @php
                                            $i = 0;
                                        @endphp
                                        
                                        @foreach ($products as $product)
                                            @if ($product->type_id == $type->id)
                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                        @endforeach

                                        {{$i}}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('types.edit', $type->id) }}" title="Editar Tipo"><i class="fas fa-edit"></i></a>
                                         <button class="btn btn-danger" onclick="typeDelete({{ $type->id }})" type="button" title="Eliminar Tipo de Produto">
                                            <i class="fas fa-trash"></i>
                                        </button> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $types->links() }}
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div> 

@endsection