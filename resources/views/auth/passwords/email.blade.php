@extends('layouts.login-register')

@section('content')

    <!-- Change background image here "auth-bg-1" -->
    <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <h2 class="auth-title">Esqueci a minha palavra-passe</h2>
                <div class="auto-form-wrapper"> 
                    <form method="POST" action="{{ route('password.email') }}">
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
                        <div class="form-group">
                            @error('email')
							    <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success submit-btn btn-block">Enviar E-mail</button>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
