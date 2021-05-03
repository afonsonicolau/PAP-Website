@extends('layouts.login-register')

@section('content')
    <!-- Change background image here -->  
    <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <h2 class="auth-title">Registar a minha conta</h2>
                <div class="auto-form-wrapper">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Username -->
                        <div class="form-group">
                            <label class="label" for="username">Nome do Utilizador</label>
                            <div class="input-group">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username" autocomplete="username" placeholder="O seu nome" autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                                <div>
                                    @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label class="label" for="email">E-mail</label>
                            <div class="input-group">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" autocomplete="email" placeholder="exemplo@exemplo.com">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                                <div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                            <label class="label" for="password">Palavra-passe</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="********">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                                <div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                            </div>
                        </div>
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label class="label" for="password-confirm">Confirmar Palavra-passe</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="********">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="form-check form-check-flat mt-0">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked>Concordo com os Termos e Condições</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success submit-btn btn-block">Registar</button>
                        </div>
                        <div class="text-block text-center my-3">
                            <span class="text-black text-small">Já criou a sua conta?</span>
                            <a href="{{ route('login') }}" class="text-small font-weight-semibold text-black">Inicie sessão aqui</a>
                        </div>
                    </form>
                </div>
                <ul class="auth-footer">
                    <!-- Terms and Conditions -->
                    <li>
                    <a href="#">Termos e Condições</a>
                    </li>
                    <!-- Help and Client Support -->
                    <li>
                    <a href="#">Ajuda ao Cliente</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection