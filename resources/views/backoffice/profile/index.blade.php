@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2>Perfil do Administrador</h2>
                    <hr>
                    <p><b>Nome de Utilizador:</b> {{ auth()->user()->username }}</p> 
                    <p><b>E-mail:</b> {{ auth()->user()->email }}</p>

                    <hr>

                    @if($errors->has('any') || Session::has('error'))
                        <input class="pb-10" type="checkbox" id="changepassword" onclick="hideInputs()" checked> Alterar Palavra-passe
                    @else
                        <input class="pb-10" type="checkbox" id="changepassword" onclick="hideInputs()"> Alterar Palavra-passe
                    @endif
                    
                    <div style="margin-top: 20px;">
                        @if($errors->has('current_password'))
                            <p class="text-danger">{{$errors->first('current_password')}}</p>
                        @endif
                        
                        @if($errors->has('password'))
                                <p class="text-danger">{{$errors->first('password')}}</p>
                        @endif

                        @if(Session::has('error'))
                                <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif

                        @if (Session::has('success'))
                                <p class="text-success">{{ Session::get('success') }}</p>
                        @endif
                    </div>

                    <form class="forms-sample" method="POST" action="{{ route('backoffice.profile-changeinfo') }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group hidden info" style="margin-top: 20px;">
                            <label for="current_password">Palavra-passe Atual<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="current_password" name="current_password" data-validate="yes" data-type="password" autocomplete="current-password"> 
                        </div>
                        <div class="form-group hidden info">
                            <label>Nova Palavra-passe<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="password" data-validate="yes" data-type="password"> 
                        </div>
                        <div class="form-group hidden info">
                            <label>Confirmar Palavra-passe<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="password_confirmation" data-validate="yes" data-type="confirmpassword"> 
                        </div>

                        <div class="form-group hidden info">
                            <button type="submit" class="btn btn-success">Mudar Password</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>   

@endsection        