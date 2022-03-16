@extends('admin.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.admin.declarations.show', ['id' => $user->id]) }}">Cliente - {{ $user->name }} - {{ $user->document }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ano da Declaração - {{ $declaration->year }}</li>
        </ol>
    </nav>
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Declarações</h1>
    </div>

    <div class="row m-2 mt-1">
        <h1 class="text-primary">Ano da Declaração: {{ $declaration->year }}</h1>
    </div>
    <div class="row m-2 mt-1">
        <a href="{{ route('admin.admin.declaration.parent', ['declaration' => $declaration->id, 'id' => $user->id]) }}" class="btn btn-info m-2 p-3">+
            Adicionar
            Dependente</a>
        <a href="{{ route('admin.admin.declaration.file.index', ['declaration' => $declaration->id, 'id' => $user->id]) }}" class="btn btn-primary text-white m-2 p-3">+ Adicionar
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
                    <th class="text-center">Abrir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td class="text-center">{{ $file->description }}</td>
                        <td class="text-center">{{ $file->created_at }}</td>
                        <td class="text-center"><a target="_blank"
                                href="{{ Storage::url($file->path) }}" class="btn btn-info">Ver
                                Informações</a> {{ Storage::url($file->path) }}</td>
                                {{-- <td class="text-center"><a target="_blank"
                                    href="{{ env('APP_URL') }}/storage/{{ $file->path }}" class="btn btn-info">Ver
                                    Informações</a></td> --}}
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
                    <th class="text-center">CPF</th>
                    <th class="text-center">Data de Nascimento</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Data da última Alteração</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parents as $parent)
                    <tr>
                        <td class="text-center">{{ $parent->name }}</td>
                        <td class="text-center">{{ $parent->document }}</td>
                        <td class="text-center">{{ $parent->date_of_birth }}</td>
                        <td class="text-center">{{ $parent->description }}</td>
                        <td class="text-center">{{ $parent->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
