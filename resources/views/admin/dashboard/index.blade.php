@extends('app.master.master')

@section('content')
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Meus dados</h1>
    </div>


    <div class="row mb-2 mt-5">
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Dados Pessoais</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nome Completo:</strong> {{ $user->name }}</li>
                        <li class="list-group-item"><strong>CPF:</strong> {{ $user->document }}</li>
                        <li class="list-group-item"><strong>Título de Eleitor:</strong> {{ $user->document_voter }}</li>
                        <li class="list-group-item"><strong>Data de Nascimento:</strong> {{ $user->date_of_birth }}</li>
                        <li class="list-group-item"><strong>Profissão:</strong> {{ $user->occupation }}</li>
                    </ul>
                    <div class="m-2 text-danger">Última alteração: {{ $user->updated_at }}</div>
                    <a href="{{ route('cliente.edit', ['cliente' => $user->id]) }}" class="btn btn-primary">Alterar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Contatos</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Telefone:</strong> {{ $user->telephone }}</li>
                        <li class="list-group-item"><strong>Celular:</strong> {{ $user->cell }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                    </ul>
                    <div class="m-2 text-danger">Última alteração: {{ $user->updated_at }}</div>
                    <a href="#" class="btn btn-primary">Alterar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Endereço</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Logradouro:</strong> {{ $user->street }}</li>
                        <li class="list-group-item"><strong>Número/Complemento:</strong> {{ $user->number }} -
                            {{ $user->complement }}</li>
                        <li class="list-group-item"><strong>Bairro/Cidade:</strong> {{ $user->neighborhood }} -
                            {{ $user->city }}</li>
                        <li class="list-group-item"><strong>Estado:</strong> {{ $user->state }}</li>
                        <li class="list-group-item"><strong>CEP:</strong> {{ $user->zipcode }}</li>
                    </ul>
                    <div class="m-2 text-danger">Última alteração: {{ $user->updated_at }}</div>
                    <a href="#" class="btn btn-primary">Alterar</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Dados Bancários</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nome do Banco:</strong> {{ $bank->name }}</li>
                        <li class="list-group-item"><strong>Agência:</strong> {{ $bank->agency }}</li>
                        <li class="list-group-item"><strong>Conta:</strong> {{ $bank->account }}</li>
                        <li class="list-group-item"><strong>Tipo de Conta:</strong> {{ $bank->type }}</li>
                    </ul>
                    <div class="m-2 text-danger">Última alteração: {{ $bank->updated_at }}</div>
                    <a href="{{ route('dados-bancarios.index', ['cliente' => $user->id]) }}"
                        class="btn btn-primary">Alterar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2 mt-1 p-1">
        <div class="col-md-12">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Informações Adicionais</h3>
                    {!! $user->description !!}
                    <div class="m-2 text-danger">Última alteração: 24/02/2022</div>
                    <a href="#" class="btn btn-primary">Alterar</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!------------------------------------------------------ DECLARAÇÕES ---------------------------------------------->
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Minhas Declarações</h1>
    </div>
    <div class="row mb-2 mt-1 p-1">
        <a href="{{ route('nova-declaracao.index') }}" class="btn btn-info m-2 p-3">+ Nova Declaração</a>
    </div>

    <div class="row mb-2 mt-5">
        <div class="col-md-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Imposto de Renda 2022</h3>
                    <div class="mb-1 text-danger">Última alteração: 24/02/2022</div>
                    <a href="#" class="btn btn-primary">Abrir</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Imposto de Renda 2020</h3>
                    <div class="mb-1 text-danger">Última alteração: 24/02/2020</div>
                    <a href="#" class="btn btn-primary">Abrir</a>
                </div>
            </div>
        </div>
    </div>
@endsection
