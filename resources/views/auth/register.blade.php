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
                                <input type="text" class="form-control" value="{{ old('username') }}" name="username" id="username" autocomplete="username" placeholder="O seu nome de utilizador" autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @error('username')
							    <p class="danger" style="color:red; font-weight: bold;">{{$errors->first('username')}}</p>
                            @enderror
                        </div>  
                        <!-- Email -->
                        <div class="form-group">
                            <label class="label" for="email">E-mail</label>
                            <div class="input-group">
                                <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" autocomplete="email" placeholder="exemplo@exemplo.com">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @error('email')
							    <p class="danger" style="color:red; font-weight: bold;">{{$errors->first('email')}}</p>
                            @enderror
                        </div>  
                        <!-- Password -->
                        <div class="form-group">
                            <label class="label" for="password">Palavra-passe</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" placeholder="********">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @error('password')
							    <p class="danger" style="color:red; font-weight: bold;">{{$errors->first('password')}}</p>
                            @enderror
                        </div>  
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label class="label" for="password-confirm">Confirmar Palavra-passe</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation" id="password-confirm" autocomplete="new-password" placeholder="********">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="form-check form-check-flat mt-0">
                            <label class="form-check-label">
                                <input type="checkbox" name="termos" id="termos" class="form-check-input">Concordo com os Termos e Condições</label>
                            </div>
                        </div>
                        <div class="form-group">
                            @error('termos')
							    <p class="danger" style="color:red; font-weight: bold;">{{$errors->first('termos')}}</p>
                            @enderror
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