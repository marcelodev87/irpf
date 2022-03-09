@extends('app.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['document' => session('document')]) }}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar Dados pessoais</li>
        </ol>
    </nav>
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Editar Dados Pessoais</h1>
    </div>

    <div class="row mb-2 mt-5">
        <div class="col-md-12">
            <form action="{{ route('user.update', ['document' => session('document')])}}" method="POST">
                @csrf
                <div class="row m-2">
                    <div class="col-12 bg-white rounded-top tab-head">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal" role="tab"
                                    aria-controls="personal" aria-selected="true">Dados Pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                    aria-controls="address" aria-selected="false">Endereço</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Contatos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8 offset-lg-2 bg-white p-3">
                        <div class="tab-content mt-4" id="myTabContent">
{{-------------------------------------- TAB DADOS PESSOAIS ------------------------------------}}
                            <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                <h5 class="pl-2">Dados Pessoais</h5>
                                <div class="row m-2">
                                    <div class="col">
                                        <label for="name">Nome Completo:</label>
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
                                    </div>
                                    <div class="col">
                                        <label for="document">CPF:</label>
                                        <input type="text" class="form-control" name="document"
                                            value="{{ old('document') ?? $user->document }}" onkeypress="$(this).mask('000.000.000-00');" readonly>
                                    </div>
                                </div>

                                <div class="row m-2">
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="date_of_born">Data de Nascimento:</label>
                                        <input type="text" class="form-control" name="date_of_born"
                                            value="{{ old('date_of_born') ?? $user->date_of_birth }}" onkeypress="$(this).mask('00/00/0000');">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="telephone">Titulo de Eleitor:</label>
                                        <input type="text" class="form-control" name="document_voter"
                                            value="{{ old('document_voter') ?? $user->document_voter }}">
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="email">Profissão:</label>
                                        <input type="text" class="form-control" name="occupation"
                                            value="{{ old('occupation') ?? $user->occupation }}">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="telephone">Estado Civil:</label>
                                        <input type="text" class="form-control" name="civil_status"
                                            value="{{ old('civil_status') ?? $user->civil_status }}">
                                    </div>
                                </div>

                            </div>
{{-------------------------------------- TAB ENDEREÇO ------------------------------------}}
                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <h5 class="pl-2">Profile</h5>
                                <div class="row">
                                    <div class="col m-2">
                                        <label for="street">Endereço:</label>
                                        <input type="text" class="form-control" name="street" value="{{ old('street') ?? $user->street }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 m-2">
                                        <label for="number">Número:</label>
                                        <input type="text" class="form-control" name="number" value="{{ old('number') ?? $user->number }}">
                                    </div>
                                    <div class="col-4 m-2">
                                        <label for="complement">Complemento:</label>
                                        <input type="text" class="form-control" name="complement" value="{{ old('complement') ?? $user->complement }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 m-2">
                                        <label for="neighborhood">Bairro:</label>
                                        <input type="text" class="form-control" name="neighborhood" value="{{ old('neighborhood') ?? $user->neighborhood }}">
                                    </div>
                                    <div class="col-5 m-2">
                                        <label for="city">Cidade:</label>
                                        <input type="text" class="form-control" name="city" value="{{ old('city') ?? $user->city }}">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-3 m-2">
                                        <label for="state">Estado:</label>
                                        <input type="text" class="form-control" name="state" value="{{ old('state') ?? $user->state }}">
                                    </div>
                                    <div class="col-3 m-2">
                                        <label for="zipcode">CEP:</label>
                                        <input type="text" class="form-control" name="zipcode" value="{{ old('zipcode') ?? $user->zipcode }}" onkeypress="$(this).mask('00000-000');">
                                    </div>
                                </div>
                            </div>
{{-------------------------------------- TAB CONTATOS ------------------------------------}}
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <h5 class="pl-2">Contatos</h5>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-4 m-2">
                                        <label for="telephone">Telefone:</label>
                                        <input type="text" class="form-control" name="telephone"
                                            value="{{ old('telephone') ?? $user->telephone }}" onkeypress="$(this).mask('(00) 0000-00009')"">
                                    </div>
                                    <div class="col-sm-12 col-lg-4 m-2">
                                        <label for="cell">Celular:</label>
                                        <input type="text" class="form-control" name="cell" value="{{ old('cell') ?? $user->cell }}" onkeypress="$(this).mask('(00) 0000-00009')">
                                    </div>
                                    <div class="col-sm-12 col-lg-12 m-2">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success m-2">Salvar</button>
        </div>

        </form>
    </div>


    </div>
@endsection
