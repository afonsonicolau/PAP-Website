@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Coleções</h4>
                    <p class="card-description">Todas as coleções estão presentes nesta listagem. O administrador poderá editar ou remover as mesmas. Caso seja removida uma coleção que pertença a algum produto esse produto será removido também.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Coleção</th>
                                <th>Cores</th>
                                <th>Número de Produtos Associados</th>
                                <th>Editar/Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $colors = "";
                                $colorsText = "";
                            @endphp  
                            @foreach ($collections as $collection)
                                @if ($collection->disabled == 0)
                                    <tr id="collection_{{$collection->id}}">
                                        <td>{{ $collection->collection }}</td>
                                        <td>
                                            @php
                                                $colors = json_decode($collection->colors);
                                                $colorsText = "";
                                            
                                                foreach ($colors as $value) {
                                                    $colorsText .= $value . ', ';
                                                }

                                                $colorsText = rtrim($colorsText, ", ");
                                            @endphp     
                                            {{ $colorsText }}
                                        </td>
                                        <td>
                                            @php
                                                $i = 0;
                                            @endphp                                      
                                            @foreach ($products as $product)
                                                @if ($product->collection_id == $collection->id)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{ $i }}
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('collections.edit', $collection->id) }}" title="Editar Coleção"><i class="fas fa-edit"></i></a>
                                            
                                            <button class="btn btn-danger" onclick="collectionDelete({{ $collection->id }})" type="button" title="Eliminar Coleção">
                                                <i class="fas fa-trash"></i>
                                            </button> 
                                        </td>                                    
                                    </tr>
                                @endif
                            @endforeach                          
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $collections->links() }}
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div> 

@endsection