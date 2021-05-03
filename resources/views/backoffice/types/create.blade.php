@extends('layouts.backoffice')

@section('content')

	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Criar Tipo de Produto</h4>
					<p class="card-description">Este formulário cria uma coleção que poderá ser utilizada para associar a produtos.</p>
					<form class="forms-sample" method="POST" action="{{ route('types.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="tipo">Tipo de Produto</label>
							<input type="text" class="form-control" id="tipo" name="tipo" data-validate="yes" data-min="2" data-max="30" data-type="string" value="{{ old('tipo') }}">
						</div>
						
						@if($errors->has('tipo'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('tipo')}}</p>
						@endif

						<button type="submit" class="btn btn-success mr-2">Criar</button>
						<a href="{{ route('types.index') }}" class="btn btn-danger">Cancelar</a>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection