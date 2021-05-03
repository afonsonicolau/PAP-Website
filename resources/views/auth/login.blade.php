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
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="exemplo@exemplo.com" autofocus>
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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="***********">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <!-- Resolver, retirar do CSS e adicionar a border no final.
                    <i class="mdi mdi-check-circle-outline"></i> -->
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success submit-btn btn-block">Iniciar Sessão</button>
            </div>
            <div class="form-group d-flex justify-content-between">
              <div class="form-check form-check-flat mt-0">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" checked>Lembrar-me</label>
              </div>
              <a href="#" class="text-small forgot-password text-black">Esqueci a minha palavra-passe</a>
            </div>
            <!-- Google Login - verificar se necessário
              <div class="form-group">
                <button class="btn btn-block g-login">
                  <img class="mr-3" src="/assets/images/file-icons/icon-google.svg" alt="">Iniciar sessão com o Google</button>
              </div>
            -->
            @if ($errors)
              <div class="form-group">
                <span class="invalid-feedback" role="alert">
                  <strong>Os seus dados para inicio de sessão estão incorretos, por favor, tente novamente.</strong>
                </span>     
              </div>
            @endif
            <div class="text-block text-center my-3">
              <span class="text-black text-small">Ainda não criou uma conta?</span>
              <a href="{{ route('register') }}" class="text-small font-weight-semibold text-black">Clique aqui para registar-se</a>
            </div>
          </form>

        </div>

        <ul class="auth-footer">
            <!-- Terms and Conditions -->
            <li>
            <a href="#">Termos e Condições</a>
            </li>
            <!-- Client Support -->
            <li>
            <a href="#">Ajuda ao Cliente</a>
            </li>
        </ul>
        
      </div>
    </div>
  </div>
@endsection