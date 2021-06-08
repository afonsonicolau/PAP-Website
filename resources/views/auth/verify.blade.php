@extends('layouts.login-register')

@section('content')
  <!-- Change background image here "auth-bg-1" -->
  <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
    <div class="row w-100">
      <div class="col-lg-4 mx-auto">
        
        <div class="auto-form-wrapper"> 
			<h2 class="auth-title">Confirmação do seu E-mail</h2>
			<div class="form-group">
				<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
				@csrf
					Antes de proceder, por favor, verifique o seu e-mail e clique no link de verificação.
					<br>
					Se não recebeu nenhum e-mail clique <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="font-size: 16px">aqui</button> para receber outro.
				</form>
			</div>
			@if (session('resent'))
				<div class="form-group">
					<div class="alert alert-success" role="alert">
						Foi enviado um novo e-mail para verificação, verifique assim que possível.
					</div>
				</div>
			@endif
        </div>
      </div>
    </div>
  </div>
@endsection
