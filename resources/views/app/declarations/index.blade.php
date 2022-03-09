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
    <div class="row mb-2 mt-1">
        <h1 class="text-primary">Ano da Declaração: {{ $declaration->year }}</h1>
    </div>
    <div class="row mb-2 mt-1">
        <a href="{{ route('declaration.year.parents', [$declaration->id]) }}" class="btn btn-info m-2 p-3">+ Adicionar
            Dependente</a>
        <a href="{{ route('declaration.year.files', ['document' => session('document'), 'declaration' => $declaration->id]) }}"
            class="btn btn-primary text-white m-2 p-3">+ Adicionar
            Documentos ou Comprovantes</a>
    </div>
    <div class="row mb-2 mt-1">
        <h2 class="text-primary">Resumo</h2>
    </div>
    <div class="row mb-2 mt-1">
        <ul class="list-group">
            @foreach ($declarationResume as $resume)
                <li class="ml-5">{{ $resume }}</li>
            @endforeach
        </ul>
    </div>

    <div class="row mb-2 mt-5">
        <div class="row">
            <h2 class="text-primary">Documentos e Comprovantes</h2>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Data da última Alteração</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="text-center">{{ $file->description }}</td>
                            <td class="text-center">{{ $file->created_at }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary shadow btn-xs mr-1"><i class="fa fa-pencil"></i>
                                        Editar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <h2 class="text-primary">Dependentes</h2>
            <table class="table m-5">
                <thead>
                    <tr>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Data da última Alteração</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parents as $parent)
                        <tr>
                            <td class="text-center">{{ $parent->name }}</td>
                            <td class="text-center">{{ $parent->updated_at }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary shadow btn-xs mr-1"><i class="fa fa-pencil"></i>
                                        Editar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
