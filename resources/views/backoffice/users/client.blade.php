@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Clientes</h4>
                    <p class="card-description">Todos os clientes existentes no website estão listados aqui, com o seu nome, e-mail e outras informações pertinentes. O administrador poderá editar a função de um utilizador, tornando-o um administrador, ou poderá eliminar o mesmo.</p>
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
                                        <form role="form" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" id="role_id" name="role_id" value="2">

                                            <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="top" title="Tornar Administrador">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                        </form>      
                                    </td>
                                    <td>   
                                        <form role="form" action="{{ route('users.delete', $user->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')                 
                                            <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar Cliente">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        </form>
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