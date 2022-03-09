@extends('app.master.master')

@section('content')
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Meus dados</h1>
    </div>


    <div class="row mb-2 mt-5">
        <div class="col-sm-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-danger">Dados Pessoais</h3>
                    <h4 class="d-inline-block mb-2 text-danger">Ainda resta nos enviar as seguintes informações:</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Título de Eleitor:</strong></li>
                    </ul>
                    <div class="m-2 text-danger">Última alteração: {{ $user->updated_at }}</div>
                    <a href="{{ route('cliente.edit', ['cliente' => $user->id]) }}" class="btn btn-danger">Enviar Informações</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Contatos</h3>
                    <h4 class="d-inline-block mb-2 text-primary">Parabéns! Você nos enviou todos os contatos.</h4>
                    <div class="m-2 text-danger">Última alteração: {{ $user->updated_at }}</div>
                    <a href="#" class="btn btn-primary">Atualizar Contatos</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Endereço</h3>
                    <h4 class="d-inline-block mb-2 text-primary">Parabéns! Suas informações de endereço estão completas.</h4>
                    <div class="m-2 text-danger">Última alteração: {{ $user->updated_at }}</div>
                    <a href="#" class="btn btn-primary">Atualizar Endereço</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-danger">Dados Bancários</h3>
                    <h4 class="d-inline-block mb-2 text-danger">Precisamos seus dados bancários, para o caso de restituição</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nome do Banco:</strong></li>
                        <li class="list-group-item"><strong>Agência:</strong></li>
                        <li class="list-group-item"><strong>Conta:</strong></li>
                        <li class="list-group-item"><strong>Tipo de Conta:</strong></li>
                    </ul>
                    <div class="m-2 text-danger">Última alteração: {{ $bank->updated_at }}</div>
                    <a href="{{ route('dados-bancarios.index', ['cliente' => $user->id]) }}"
                        class="btn btn-danger">Enviar dados Bancários</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2 mt-1 p-1">
        <div class="col-sm-6">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Informações Adicionais</h3>
                    <h4 class="d-inline-block mb-2 text-danger">Ainda resta nos enviar as seguintes informações:</h4>
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
