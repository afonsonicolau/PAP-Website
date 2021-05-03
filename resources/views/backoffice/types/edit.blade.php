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
							<label for="tipo">Tipo de Produto</label>
							<input type="text" class="form-control" id="tipo" name="tipo" data-validate="yes" data-min="2" data-max="30" data-type="string" value="{{ old('tipo') ?? $types->type }}">
						</div>
					
						@if($errors->has('tipo'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('tipo')}}</p>
						@endif

						<button type="submit" class="btn btn-success mr-2">Atualizar</button>
						<a href="{{ route('types.index') }}" class="btn btn-danger">Cancelar</a>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
