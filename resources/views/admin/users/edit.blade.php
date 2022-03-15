@extends('admin.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cliente - Editar</li>
        </ol>
    </nav>
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Meus dados</h1>
    </div>
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

    <div class="row mb-2 mt-5">
        <div class="col-md-12">
            <form action="{{ route('admin.admin.user.update', ['id' => $user->id]) }}" method="POST">
                @csrf
                <div class="row m-2">
                    <h2>Dados Pessoais</h2>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
                    </div>
                    <div class="col">
                        <label for="document">CPF:</label>
                        <input type="text" class="form-control" name="document"
                            value="{{ old('document') ?? $user->document }}" onkeypress="$(this).mask('000.000.000-00')">
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-sm-12 col-lg-4">
                        <label for="date_of_born">Data de Nascimento:</label>
                        <input type="text" class="form-control" name="date_of_birth"
                            value="{{ old('date_of_birth') ?? $user->date_of_birth }}" onkeypress="$(this).mask('00/00/0000');">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label for="email">Profissão:</label>
                        <input type="text" class="form-control" name="occupation"
                            value="{{ old('occupation') ?? $user->occupation }}">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label for="telephone">Titulo de Eleitor:</label>
                        <input type="text" class="form-control" name="document_voter"
                            value="{{ old('document_voter') ?? $user->document_voter }}">
                    </div>
                </div>
                <hr>
                <div class="row m-2">
                    <h2>Contatos</h2>
                </div>
                <div class="row m-2">
                    <div class="col-sm-12 col-lg-4">
                        <label for="telephone">Telefone:</label>
                        <input type="text" class="form-control" name="telephone"
                            value="{{ old('telephone') ?? $user->telephone }}"
                            onkeypress="$(this).mask('(00) 0000-00009')">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label for="cell">Celular:</label>
                        <input type="text" class="form-control" name="cell" value="{{ old('cell') ?? $user->cell }}"
                            onkeypress="$(this).mask('(00) 0000-00009')">
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email"
                            value="{{ old('email') ?? $user->email }}">
                    </div>
                </div>
                <hr>
                <div class="row m-2">
                    <h2>Endereço</h2>
                </div>
                <div class="row m-2">
                    <div class="col-12">
                        <label for="street">Endereço:</label>
                        <input type="text" class="form-control" name="street"
                            value="{{ old('street') ?? $user->street }}">
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-lg-3">
                        <label for="number">Número:</label>
                        <input type="text" class="form-control" name="number"
                            value="{{ old('number') ?? $user->number }}">
                    </div>
                    <div class="col-lg-3">
                        <label for="complement">Complemento:</label>
                        <input type="text" class="form-control" name="complement"
                            value="{{ old('complement') ?? $user->complement }}">
                    </div>
                    <div class="col-lg-6">
                        <label for="neighborhood">Bairro:</label>
                        <input type="text" class="form-control" name="neighborhood"
                            value="{{ old('neighborhood') ?? $user->neighborhood }}">
                    </div>
                </div>

                <div class="row m-2">
                    <div class="col-lg-3">
                        <label for="city">Cidade:</label>
                        <input type="text" class="form-control" name="city" value="{{ old('city') ?? $user->city }}">
                    </div>
                    <div class="col-lg-3">
                        <label for="state">Estado:</label>
                        <input type="text" class="form-control" name="state"
                            value="{{ old('state') ?? $user->state }}"  maxlength="2">
                    </div>
                    <div class="col-lg-6">
                        <label for="zipcode">CEP:</label>
                        <input type="text" class="form-control" name="zipcode"
                            value="{{ old('zipcode') ?? $user->zipcode }}" onkeypress="$(this).mask('00000-000')">
                    </div>
                </div>
                <div class="row m-3">
                    <button type="submit" class="btn btn-lg btn-success m-2">Salvar</button>
                </div>

            </form>
        </div>


    </div>
@endsection
