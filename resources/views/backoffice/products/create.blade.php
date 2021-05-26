@extends('layouts.backoffice')

@section('content')

  	<div class="row">
      	<div class="col-md-12 grid-margin stretch-card">
        	<div class="card">
				<div class="card-body">
					<h4 class="card-title">Criar Produto</h4>
					<p class="card-description">Este formulário tem como propósito criar um produto para exibir na loja online, seja o produto outlet ou não.</p>
					<form class="forms-sample" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
						@csrf
						
						<div class="form-group">
							<label for="reference">Referência do Produto</label>
							<input type="text" class="form-control" id="reference" name="reference" disabled>
						</div>

						<div class="form-group">
							<label for="tipo">Tipo de Produto</label>
							<select class="form-control form-control-lg" id="tipo" name="tipo" required>
								<option value="" selected disabled>--Escolha um tipo--</option>
							@foreach ($types as $type)
								@if ($type->disabled == 0)
									<option value="{{ $type->id }}">{{ $type->type }}</option>
								@endif
							@endforeach
							</select>
						</div>

						@if ($errors->has('tipo'))
							<p class="text-danger">{{$errors->first('tipo')}}</p>
						@endif

						<div class="form-group">
							<label for="colecao">Coleção</label>
							<select class="form-control form-control-lg" id="colecao" name="colecao" required>
								<option value="" selected disabled>--Escolha uma coleção--</option>
								@foreach ($collections as $collection)
									@if ($collection->disabled == 0)
										<option value="{{ $collection->id }}">{{ $collection->collection }}</option>
									@endif
								@endforeach
							</select>
						</div>

						@if ($errors->has('colecao'))
							<p class="text-danger">{{$errors->first('colecao')}}</p>
						@endif

						<div class="form-group">
							<label for="cor">Cores</label>
							<p style="font-size: 13px;">Utilize o <b>"CTRL"</b> para selecionadar mais cores</p>
							<select class="form-control form-control-lg" id="cor" name="cor[]" multiple>
								<option value="" selected disabled>--Escolha uma coleção--</option>
							</select>
						</div>

						<div class="form-group">
							<label for="colors">Cores do Produto</label>
							<input type="text" class="form-control" id="colors" name="colors" value="" data-validate="yes" data-min="1" data-max="255" data-type="select-colors" readonly>
						</div>

						@if ($errors->has('colors'))
							<p class="text-danger">{{$errors->first('colors')}}</p>
						@endif

						<div class="form-group">
							<label for="tamanho">Tamanho</label>
							<input type="text" class="form-control" id="tamanho" name="tamanho" placeholder="123x123" data-validate="yes" data-type="size" value="{{ old('tamanho') }}">
						</div>
						
						@if ($errors->has('tamanho'))
							<p class="text-danger">{{$errors->first('tamanho')}}</p>
						@endif

						<div class="form-group">
							<label for="preco">Preço s/IVA</label>
							<input type="number" min="0" class="form-control" id="preco" name="preco" step="0.01" data-validate="yes" data-min="1" data-max="500" data-type="float" value="{{ old('preco') }}" onchange="totalPriceIva()">
						</div>

						@if ($errors->has('preco'))
							<p class="text-danger">{{$errors->first('preco')}}</p>
						@endif

						<div class="form-group">
							<label for="iva">IVA</label>
							<input type="number" class="form-control" id="iva" name="iva" value="23" disabled>
						</div>

						<div class="form-group hidden totalPrice">
							<p id="totalPriceVal"></p>
						</div>

						<div class="form-group">
							<label for="peso">Peso</label>
							<input type="number" min="0" class="form-control" id="peso" name="peso" step="0.01" data-validate="yes" data-min="1" data-max="100" data-type="float" value="{{ old('peso') }}">
						</div>

						@if ($errors->has('peso'))
							<p class="text-danger">{{$errors->first('peso')}}</p>
						@endif

						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" min="1" class="form-control" id="stock" name="stock" data-validate="yes" data-min="1" data-max="1000" data-type="int" value="{{ old('stock') }}">
						</div>

						@if ($errors->has('stock'))
							<p class="text-danger">{{$errors->first('stock')}}</p>
						@endif

						<div class="form-group">
							<label for="descrição">Descrição</label>
							<textarea class="form-control" id="descrição" name="descrição" data-validate="yes" data-min="10" data-max="255" rows="2">{{ old('descrição') }}</textarea>
						</div>

						@if ($errors->has('descrição'))
							<p class="text-danger">{{$errors->first('descrição')}}</p>
						@endif
						
						{{-- Thumbnail --}}
						<div class="form-group">
							<label for="miniatura">Miniatura</label>
							<div>
								<input type="file" id="miniatura" name="miniatura" required>
							</div>
						</div>

						<div class="thumbnailPreview">
							
						</div>

						@if ($errors->has('miniatura'))
							<p class="danger">{{$errors->first('miniatura')}}</p>
						@endif

						<br>	

						{{-- Imagens  --}}
						<div class="form-group">
							<label for="imagens">Imagens de Detalhe</label>
							<div>
								<input type="file" class="imagens" id="imagens[]" name="imagens[]" multiple>
							</div>
						</div>

						<div class="imagesPreview">

						</div>

						@if ($errors->has('imagens'))
							<p class="danger">{{$errors->first('imagens')}}</p>
						@endif
						@if ($errors->has('imagens.*'))
							<p class="danger">{{$errors->first('imagens.*')}}</p>
						@endif

						<br>
						
						<button type="submit" class="btn btn-success mr-2">Criar</button>
						<a href="{{ route('products.index') }}" class="btn btn-danger">Cancelar</a>
					</form>
				</div>
        	</div>
      	</div>
  	</div>

@endsection