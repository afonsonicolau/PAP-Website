@extends('layouts.backoffice')

@section('content')

	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Criar Produto</h4>
					<p class="card-description">Este formulário tem como propósito criar um produto para exibir na loja online, seja o produto outlet ou não.</p>
					<form class="forms-sample" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PATCH')

						<div class="form-group">
							<label for="referência">Referência do Produto</label>
							<input type="text" class="form-control" id="referência" name="referência" data-validate="yes" data-min="2" data-max="5" data-type="int" value="{{ old('referência') ?? $product->reference }}">
						</div>

						@if ($errors->has('referência'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('referência')}}</p>
						@endif

						<div class="form-group">
							<label for="tipo">Tipo de Produto</label>
							<select class="form-control form-control-lg" id="tipo" name="tipo">
								{{-- Get the type attached to the product and then all the other types--}}
								@foreach ($types as $type)
									@if ($type->type == 0)
										@if ($product->type_id == $type->id)
											<option value="{{ $type->id }}" selected>{{ $type->type }}</option>
										@else
											<option value="{{ $type->id }}">{{ $type->type }}</option>		
										@endif
									@endif
								@endforeach
							</select>
						</div>

						@if ($errors->has('tipo'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('tipo')}}</p>
						@endif	

						<div class="form-group">
							<label for="coleção">Coleção</label>
							<select class="form-control form-control-lg" id="coleção" name="coleção">
								{{-- Get the collection attached to the product and then the rest of the collections --}}
								@foreach ($collections as $collection)
									@if ($collection->disabled == 0)
										@if ($product->collection_id == $collection->id)
										<option value="{{ $collection->id }}" selected>{{ $collection->collection }}</option>
										@else
											<option value="{{ $collection->id }}">{{ $collection->collection }}</option>
										@endif
									@endif
								@endforeach
							</select>
						</div>

						@if ($errors->has('coleção'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('coleção')}}</p>
						@endif

						<div class="form-group">
							<label for="cor">Cor</label>
							<select class="form-control form-control-lg" id="cor" name="cor">
								@foreach (json_decode($product->collection->colors) as $color)
									@if ($product->color == $color)
										<option value="{{ $color }}" selected>{{ $color }}</option>
									@else
										<option value="{{ $color }}">{{ $color }}</option>
									@endif
								@endforeach
							</select>
						</div>

						@if ($errors->has('cor'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('cor')}}</p>
						@endif

						<div class="form-group">
							<label for="tamanho">Tamanho</label>
							<input type="text" class="form-control" id="tamanho" name="tamanho" data-validate="yes" data-type="size" value="{{ old('tamanho') ?? $product->size }}">
						</div>

						@if ($errors->has('tamanho'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('tamanho')}}</p>
						@endif

						<div class="form-group">
							<label for="preço">Preço</label>
							<input type="number" class="form-control" id="preço" name="preço" step="0.01" data-validate="yes" data-min="1" data-max="5" data-type="float" value="{{ old('preço') ?? $product->price }}" onchange="totalPriceIva()">
						</div>

						@if ($errors->has('preço'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('preço')}}</p>
						@endif

						<div class="form-group">
							<label for="iva">IVA</label>
							<input type="number" min="0" class="form-control" id="iva" name="iva" step="0.1" data-validate="yes" data-min="1" data-max="5" data-type="float" value="{{ old('iva') ?? $product->iva }}" onchange="totalPriceIva()">
						</div>

						@if ($errors->has('iva'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('iva')}}</p>
						@endif

						<div class="form-group hidden totalPrice">
							<p id="totalPriceVal"></p>
						</div>

						<div class="form-group">
							<label for="peso">Peso</label>
							<input type="number" min="0" class="form-control" id="peso" name="peso" step="0.01" data-validate="yes" data-min="1" data-max="8" data-type="float" value="{{ old('peso') ?? $product->weight }}">
						</div>

						@if ($errors->has('peso'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('peso')}}</p>
						@endif

						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" class="form-control" min="1" class="form-control" id="stock" name="stock" data-validate="yes" data-min="1" data-max="4" data-type="int" value="{{ old('stock') ?? $product->stock }}">
						</div>

						@if ($errors->has('stock'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('stock')}}</p>
						@endif

						<div class="form-group">
							<label for="descrição">Descrição</label>
							<textarea class="form-control" id="descrição" name="descrição" data-validate="yes" data-min="10" data-max="255" rows="2" required>{{ old('descrição') ?? $product->description }}</textarea>
						</div>

						@if ($errors->has('descrição'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('descrição')}}</p>
						@endif
						
					
						{{-- Thumbnail --}}
						<div class="form-group">
							<label for="miniatura">Miniatura</label>
							<div>
								<input type="file" id="miniatura" name="miniatura">
							</div>
						</div>

						{{-- Thumbnail Preview --}}
						<div class="form-group thumbnailPreview">
							<img src="/storage/thumbnail/{{ $product->thumbnail }}" height="200">
						</div>

						@if ($errors->has('miniatura'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('miniatura')}}</p>
						@endif

						{{-- Images --}}
						<div class="form-group">
							<label for="imagens">Imagens Restantes</label>
							<div>
								<input type="file" class="imagens" id="imagens[]" name="imagens[]" multiple>
							</div>
						</div>

						@if ($errors->has('imagens.*'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('imagens.*')}}</p>
						@endif

						{{-- Images Preview --}}
						<div class="form-group">
							<div class="imagePreview imagesPreview">
								@foreach ($imageNames as $name)
									@if (Storage::exists('public/products/' . $name))
										<span class="pic" id="{{ $loop->index }}">
											<a href="javascript:void(0)" onclick="imageDelete('{{ $name }}', '{{ $loop->index }}', {{ $product->id }})">
												<i class="fas fa-times-circle close text-danger" style="position: absolute;"></i>
											</a>
											<img src="/storage/products/{{ $name }}" height="200">
										</span>
									@endif
								@endforeach
							</div>
						</div>
					
						<button type="submit" class="btn btn-success mr-2">Atualizar</button>
						<a href="{{ route('products.index') }}" class="btn btn-danger">Cancelar</a>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
