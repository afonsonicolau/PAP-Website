@extends('layouts.backoffice')

@section('content')

	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Editar Tipo de Produto</h4>
					<p class="card-description">Este formulário tem como propósito criar um tipo de produto para ser utilizado na criação de produtos.</p>
					<form class="forms-sample" method="POST" action="{{ route('types.update', $types->id) }}" enctype="multipart/form-data">
						@csrf
						@method('PATCH')

						<div class="form-group">
							<label for="referencia">Referência do Produto</label>
							<input type="number" class="form-control" id="referencia" name="referencia" min="1" data-validate="yes" data-min="1" data-max="50000" data-type="int" value="{{ old('referencia') }}">
						</div>

						@if ($errors->has('referencia'))
							<p class="text-danger">{{$errors->first('referencia')}}</p>
						@endif

						<div class="form-group">
							<label for="tipo">Tipo de Produto</label>
							<input type="text" class="form-control" id="tipo" name="tipo" data-validate="yes" data-min="2" data-max="50" data-type="string" value="{{ old('tipo') ?? $types->type }}">
						</div>
					
						@if($errors->has('tipo'))
							<p class="text-danger">{{$errors->first('tipo')}}</p>
						@endif

						<button type="submit" class="btn btn-success mr-2">Atualizar</button>
						<a href="{{ route('types.index') }}" class="btn btn-danger">Cancelar</a>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
