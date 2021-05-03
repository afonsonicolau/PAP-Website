@extends('layouts.backoffice')

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                    <div class="card-body">
                        <header class="h1">Perfil do Administrador</header>
                        <hr>
                        
                        <header class="h4">Nome do utilizador</header>
                        <p>{{ auth()->user()->username }}</p>

                        <header class="h4">Email</header >
                        <p>{{ auth()->user()->email }}</p>

                        <header class="h4">Password</header >
                        <p>{{ auth()->user()->password }}</p>
                    </div>
                </div>
            </div>
        </div>  
    </div> 

@endsection        