@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Produtos</h4>
                    <p class="card-description">Todos os produtos criados são listados aqui com toda a sua informação relevante. O administrador poderá editar os mesmos da forma desejada.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Referência</th>
                                <th>Tipo</th>
                                <th>Cor</th>
                                <th>Coleção</th>
                                <th>Tamanho</th>
                                <th>Preço s/IVA</th>
                                <th>IVA</th>
                                <th>Preço c/IVA</th>
                                <th>Peso</th>
                                <th>Stock</th>
                                <th>Destaque?</th>
                                <th>Produto Outlet?</th>
                                <th>Visível?</th>
                                <th>Editar/Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->type->reference }}</td>
                                    <td>{{ $product->type->type }}</td>
                                    <td>
                                        @php
                                            $colors = json_decode($product->color);
                                            $colorsText = "";
                                        
                                            foreach ($colors as $value) {
                                                $colorsText .= $value . ', ';
                                            }

                                            $colorsText = rtrim($colorsText, ", ");
                                        @endphp     
                                        {{ $colorsText }}
                                    </td>
                                    <td>{{ $product->collection->collection }}</td>
                                    <td>{{ $product->size }}</td>  
                                    <td>{{ $product->price }}€</td>
                                    <td>{{ $product->iva }}%</td>
                                    <td>{{ round($product->price / ((100 - $product->iva)/100), 2) }}€</td>
                                    <td>{{ $product->weight }}Kg</td>  
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @unless ($standoutCount == 9)
                                            @if ($product->standout == 0 && $product->visible == 1) 
                                                {{-- Make product standout --}} 
                                                <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" id="standout" name="standout" value="1">

                                                    <button class="btn btn-dark" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para destacar">
                                                        <i class="fas fa-bookmark"></i>
                                                    </button>
                                                </form>    
                                            @else
                                                {{-- Make product not standout --}} 
                                                <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" id="standout" name="standout" value="0">

                                                    <button class="btn btn-dark" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para retirar do destaque">
                                                        <i class="far fa-bookmark"></i>
                                                    </button>
                                                </form>    
                                            @endif
                                        @endunless
                                    </td>
                                    <td>
                                        @if ($product->outlet == 1) 
                                            {{-- Make product not outlet --}} 
                                            <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" id="outlet" name="outlet" value="0">

                                                <button class="btn btn-dark" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para tornar um produto normal">
                                                    <i class="far fa-circle"></i>
                                                </button>
                                            </form>    
                                        @else
                                            {{-- Make product outlet --}} 
                                            <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" id="outlet" name="outlet" value="1">

                                                <button class="btn btn-dark" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para tornar um produto outlet">
                                                    <i class="fas fa-circle"></i>
                                                </button>
                                            </form>    
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->visible == 1) 
                                            {{-- Make product not visible --}} 
                                            <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" id="visible" name="visible" value="0">

                                                <button class="btn btn-dark" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para o produto não ser vísivel">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </form>    
                                        @else
                                            {{-- Make product visible --}} 
                                            <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" id="visible" name="visible" value="1">

                                                <button class="btn btn-dark" type="submit" data-toggle="tooltip" data-placement="top" title="Clique para tornar o produto visível">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </form>    
                                        @endif
                                    </td>
                                    <td>
                                        <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')            
                                            
                                            <input type="hidden" id="disable" name="disable">

                                            <a class="btn btn-primary" href="{{ route('products.edit', ['product' => $product->id]) }}" data-toggle="tooltip" data-placement="top" title="Editar Produto"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar Produto">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
 
@endsection