@extends('layouts.backoffice')

@section('content')

	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Criar Coleção</h4>	
					<p class="card-description">Este formulário cria uma coleção que poderá ser utilizada para associar a produtos.</p>

					<form class="forms-sample" method="POST" action="{{ route('collections.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="colecao">Nome da Coleção</label>
							<input type="text" class="form-control" id="colecao" name="colecao" data-validate="yes" data-min="2" data-max="30" data-type="string" value="{{ old('colecao') }}">
						</div>

						@if ($errors->has('colecao'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('colecao')}}</p>
						@endif

						<div class="form-group">
							<label for="cores">Cores</label>
							<input type="text" id="cores" name="cores" data-validate="yes" data-min="1" data-max="80" data-type="string" value="{{ old('cores') }}">
						</div>
						
						@if ($errors->has('cores'))
							<p class="danger" style="color:red; font-weight: bold;">{{$errors->first('cores')}}</p>
						@endiF
						
						<button type="submit" class="btn btn-success mr-2">Criar</button>
						<a href="{{ route('collections.index') }}" class="btn btn-danger">Cancelar</a>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	
@endsection