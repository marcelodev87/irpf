@extends('app.master.master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard', ['document' => session('document')]) }}">Página Inicial</a></li>
        <li class="breadcrumb-item"><a href="{{ route('declaration.year', ['document' => session('document'), $declaration->id]) }}">Declaração - {{ $declaration->year }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo Dependente</li>
    </ol>
</nav>
    <!------------------------------------------------------ DECLARAÇÕES ---------------------------------------------->
    @if ($errors->all())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>{{ $error }}</strong>
            </div>
        @endforeach
    @endif

    @if (session()->exists('message'))
        <div class="alert alert-{{ session()->get('color') }}" role="alert">
            <strong>{{ session()->get('message') }}</strong>
        </div>
    @endif
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Declaração: {{ $declaration->year }} </h1>
    </div>
    <hr>
    <div class="row mb-2 mt-1 p-1">
        <h3 class="text-primary">Novo Dependente</h3>
    </div>

    <div class="row mb-2 mt-5">
            <div class="col-12">
                <form method="POST" action="{{ route('declaration.year.parents.store', [$declaration->id])}}">
                    @csrf
                    <div class="row m-2">
                        <div class="col">
                            <label for="name">Nome Completo:</label>
                            <input type="hidden" name="declaration_id" value="{{ $declaration->id }}">
                            <input type="hidden" name="user_id" value="{{ $declaration->user_id }}">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="row m-2">
                        <div class="col-sm-12 col-lg-6">
                            <label for="document">CPF:</label>
                            <input type="text" class="form-control" name="document" value="{{ old('document') }}" onkeypress="$(this).mask('000.000.000-00');">
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label for="date_of_born">Data de Nascimento:</label>
                            <input type="text" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" onkeypress="$(this).mask('00/00/0000');">
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="description[]" value="Cursou Ensino Escolar ou
                            Superior">
                            <label class="form-check-label" for="description">Cursou Ensino Escolar ou
                                Superior</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="description[]" value="Este dependente trabalhou ou possiu alguma fonte de renda">
                            <label class="form-check-label" for="description">Este dependente trabalhou ou possiu alguma fonte de renda</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="description[]" value="Paguei pensão alimentícia para este dependente">
                            <label class="form-check-label" for="description">Paguei pensão alimentícia para este dependente</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="description[]" value="Este dependente recebeu benefício do governo">
                            <label class="form-check-label" for="description">Este dependente recebeu benefício do governo</label>
                        </div>
                        <div class="form-check mt-2">
                            <p class="text-bold text-danger"><strong>Na próxima página, você deverá enviar os comprovantes de acordo com as opções escolhidas.</strong></p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>

    </div>

@endsection
