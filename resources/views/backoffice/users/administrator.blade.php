@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Administradores</h4>
                    <p class="card-description">Todos os administratores presentes no sistema são apresentados na tabela abaixo</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Função</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (auth()->user()->id == $user->id)
                                            Utilizador em uso
                                        @else
                                            <form role="form" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" id="role_id" name="role_id" value="1">

                                                <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="top" title="Tornar Cliente">
                                                    <i class="fas fa-user-minus"></i>
                                                </button>
                                            </form>      
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->id == $user->id)
                                            Utilizador em uso
                                        @else
                                            <form role="form" action="{{ route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')      
                                                
                                                <input type="hidden" id="disable" name="disable" value="1">

                                                <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar Administrador">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>
                                            </form>   
                                        @endif
                                    </td>
                                </tr>
                            @endforeach  
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
 
@endsection