@extends('layouts.backoffice')

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listagem de Encomendas</h4>
                    <p class="card-description">Todas as encomendas feitas por parte de todos os utilizadores são listadas nesta tabela.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Assunto</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emailsSent as $email)
                                <tr>
                                    <td>{{ $email->name }}</td>
                                    <td>{{ $email->email }}</td>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ $email->message }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 pt-5 d-flex justify-content-center">
                            {{ $emailsSent->links() }}
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
 
@endsection