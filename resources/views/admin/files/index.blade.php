@extends('app.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.admin.declarations.show', ['id' => $user->id]) }}">Cliente - {{ $user->name }} - {{ $user->document }}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.admin.declarations.index', ['declaration' => $declaration->id, 'id' => $user->id]) }}">Ano da Declaração - {{ $declaration->year }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Enviar arquivos e comprovantes</li>
        </ol>
    </nav>
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Envio de Arquivos e Comprovantes</h1>
    </div>

    <div class="row mb-2 mt-5">
        <div class="col-md-12">
            <form action="{{ route('admin.admin.declaration.file.store', ['id' => $user->id ,'declaration' => $declaration->id ])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row m-2">
                    <div class="col-lg-3">
                        <input type="hidden" name="id" value="{{ $declaration->id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id}}">
                    </div>
                    <div class="col-12">
                        <label for="agency">Descrição:</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="col-12">
                        <label for="agency">Arquivos:</label>
                        <input type="file" class="form-control" name="file[]" multiple>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success m-2">Enviar Arquivos</button>
            </form>
        </div>


    </div>
@endsection
