@extends('app.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['document' => session('document')]) }}">Página Inicial</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Declaração - {{ $declaration->year }}</li>
        </ol>
    </nav>
    <!------------------------------------------------------ DECLARAÇÕES ---------------------------------------------->
    <div class="row m-2 mt-1">
        <h1 class="text-primary">Ano da Declaração: {{ $declaration->year }}</h1>
    </div>
    <div class="row m-2 mt-1">
        <a href="{{ route('declaration.year.parents', [$declaration->id]) }}" class="btn btn-info m-2 p-3">+ Adicionar
            Dependente</a>
        <a href="{{ route('declaration.year.files', ['document' => session('document'), 'declaration' => $declaration->id]) }}"
            class="btn btn-primary text-white m-2 p-3">+ Adicionar
            Documentos ou Comprovantes</a>
    </div>
    <div class="row m-2 mt-1">
        <h2 class="text-primary">Resumo</h2>
    </div>
    <div class="row mb-2 mt-1">
        <ul class="list-group">
            @foreach ($declarationResume as $resume)
                <li class="ml-5">{{ $resume }}</li>
            @endforeach
        </ul>
    </div>


        <div class="row m-2">
            <h2 class="text-primary">Documentos e Comprovantes</h2>
            <table class="table table-bordered m-5">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Data de Envio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="text-center">{{ $file->description }}</td>
                            <td class="text-center">{{ $file->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row m-2">
            <h2 class="text-primary">Dependentes</h2>
            <table class="table table-bordered m-5">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Data da última Alteração</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parents as $parent)
                        <tr>
                            <td class="text-center">{{ $parent->name }}</td>
                            <td class="text-center">{{ $parent->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
