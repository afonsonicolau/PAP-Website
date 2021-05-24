@extends('layouts.login-register')

@section('content')
  <!-- Change background image here "auth-bg-1" -->
  	<div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
    	<div class="row w-100">
      		<div class="col-lg-4 mx-auto">
        	<h2 class="auth-title">Inicio de Sessão</h2>
        	<div class="auto-form-wrapper"> 
          		<form method="POST" action="{{ route('login') }}">
					@csrf
					<!-- E-mail -->
					<div class="form-group">
						<label class="label">E-mail</label>
						<div class="input-group">
							<input type="email" class="form-control" name="email" id="email" data-validate="yes" data-min="5" data-max="144" data-type="email" autocomplete="email" placeholder="exemplo@exemplo.com" value="{{ old('email') }}" autofocus>
							<div class="input-group-append">
								<span class="input-group-text">
								</span>
							</div>
						</div>
					</div>
					<!-- Password -->   
					<div class="form-group">
						<label class="label">Palavra-passe</label>
						<div class="input-group">
							<input type="password" class="form-control" name="password" id="password" autocomplete="current-password" data-validate="yes" data-min="8" data-type="required" placeholder="***********">
							<div class="input-group-append">
								<span class="input-group-text">
								</span>
							</div>
						</div>
					</div>
					@if ($errors->has('email') || $errors->has('password'))
						<p class="text-danger">As suas credenciais estão incorretas, tente novamente.</p>
					@endif
					<div class="form-group">
						<button type="submit" class="btn btn-success submit-btn btn-block">Iniciar Sessão</button>
					</div>
					<div class="form-group d-flex justify-content-between">
						<div class="form-check form-check-flat mt-0">
							<label class="form-check-label">
							<input type="checkbox" class="form-check-input" name="remember" id="remember">Lembrar-me</label>
						</div>
						<a href="#" class="text-small forgot-password text-black">Esqueci a minha palavra-passe</a>
					</div>
					<div class="text-block text-center my-3">
						<span class="text-black text-small">Ainda não criou uma conta?</span>
						<a href="{{ route('register') }}" class="text-small font-weight-semibold text-black">Clique aqui para registar-se</a>
					</div>
				</form>
        	</div>

@endsection