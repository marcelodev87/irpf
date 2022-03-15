@extends('admin.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.admin.dashboard') }}">Home</a></li>
           <li class="breadcrumb-item active" aria-current="page">Novo Cliente</li>
        </ol>
    </nav>
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Envio de Arquivos e Comprovantes</h1>
    </div>

    <div class="container">
        <div class="row mb-2 mt-1 p-1">
            <h1 class="text-primary">Dados Pessoais</h1>
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
                <form action="{{ route('admin.admin.user.store')}}" method="POST">
                    @csrf
                    <div class="row m-2">
                        <div class="col-12 bg-white rounded-top tab-head">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal"
                                        role="tab" aria-controls="personal" aria-selected="true">Dados Pessoais</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="address-tab" data-toggle="tab" href="#address"
                                        role="tab" aria-controls="address" aria-selected="false">Endereço</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                        role="tab" aria-controls="contact" aria-selected="false">Contatos</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8 offset-lg-2 bg-white p-3">
                            <div class="tab-content mt-4" id="myTabContent">
                                {{-- ------------------------------------ TAB DADOS PESSOAIS ---------------------------------- --}}
                                <div class="tab-pane fade show active" id="personal" role="tabpanel"
                                    aria-labelledby="personal-tab">
                                    <h5 class="pl-2">Dados Pessoais</h5>
                                    <div class="row m-2">
                                        <div class="col-12">
                                            <label for="name">Nome Completo:</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                        </div>

                                    </div>

                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-4">
                                            <label for="document">CPF:</label>
                                            <input type="text" class="form-control" name="document" value="{{ old('document') }}"
                                                data-mask="000.000.000-00">
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <label for="date_of_birth">Data de Nascimento:</label>
                                            <input type="text" class="form-control" name="date_of_birth"
                                                value="{{ old('date_of_birth') }}" data-mask="00/00/0000">
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <label for="telephone">Titulo de Eleitor:</label>
                                            <input type="text" class="form-control" name="document_voter"
                                                value="{{ old('document_voter') }}">
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-6">
                                            <label for="occupation">Profissão:</label>
                                            <input type="text" class="form-control" name="occupation"
                                                value="{{ old('occupation') }}">
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <label for="telephone">Estado Civil:</label>
                                            <input type="text" class="form-control" name="civil_status"
                                                value="{{ old('civil_status') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 mt-3">
                                        <a class="btn-next btn btn-primary btn-lg btn-block p-2" id="address-tab"
                                            data-toggle="tab" href="#address" role="tab" aria-controls="address"
                                            aria-selected="false">Próximo >></a>
                                    </div>

                                </div>
                                {{-- ------------------------------------ TAB ENDEREÇO ---------------------------------- --}}
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <h5 class="pl-2">Endereço</h5>
                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-12">
                                            <label for="street">Endereço:</label>
                                            <input type="text" class="form-control" name="street"
                                                value="{{ old('street') }}">
                                        </div>
                                    </div>

                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="number">Número:</label>
                                            <input type="text" class="form-control" name="number"
                                                value="{{ old('number') }}">
                                        </div>
                                        <div class="col-sm-12 col-lg-5">
                                            <label for="complement">Complemento:</label>
                                            <input type="text" class="form-control" name="complement"
                                                value="{{ old('complement') }}"
                                                placeholder="Quadra, Lote, Apto, Bloco, etc">
                                        </div>
                                        <div class="col-sm-12 col-lg-5">
                                            <label for="neighborhood">Bairro:</label>
                                            <input type="text" class="form-control" name="neighborhood"
                                                value="{{ old('neighborhood') }}">
                                        </div>
                                    </div>

                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-7">
                                            <label for="city">Cidade:</label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ old('city') }}">
                                        </div>
                                        <div class="col-sm-12 col-lg-2">
                                            <label for="state">Estado:</label>
                                            <input type="text" class="form-control" name="state" maxlength="2"
                                                value="{{ old('state') }}" placeholder="XX">
                                        </div>
                                        <div class="col-sm-12 col-lg-3">
                                            <label for="zipcode">CEP:</label>
                                            <input type="text" class="form-control" name="zipcode"
                                                value="{{ old('zipcode') }}" onkeypress="$(this).mask('00000-000');"
                                                placeholder="00000-000">
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-6 mt-3">
                                            <a class="btn-prev btn btn-primary btn-lg btn-block" id="personal-tab"
                                                data-toggle="tab" href="#personal" role="tab" aria-controls="personal"
                                                aria-selected="false"><< Anterior</a>
                                        </div>
                                        <div class="col-sm-12 col-lg-6 mt-3">
                                            <a class="btn-next btn btn-primary btn-lg btn-block" id="contact-tab"
                                                data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                                aria-selected="false">Próximo >></a>
                                        </div>
                                    </div>
                                </div>

                                {{-- ------------------------------------ TAB CONTATOS ---------------------------------- --}}
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <h5 class="pl-2">Contatos</h5>
                                    <div class="row m-2">
                                        <div class="col-sm-12 col-lg-4">
                                            <label for="telephone">Telefone:</label>
                                            <input type="text" class="form-control" name="telephone"
                                                value="{{ old('telephone') }}"
                                                onkeypress="$(this).mask('(00) 0000-00009')"">
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <label for="cell">Celular:</label>
                                            <input type="text" class="form-control" name="cell"
                                                value="{{ old('cell') }}" onkeypress="$(this).mask('(00) 0000-00009')">
                                        </div>
                                        <div class="col-sm-12 col-lg-12">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 mt-3">
                                        <a class="btn-prev btn btn-primary btn-lg btn-block p-2" id="address-tab"
                                            data-toggle="tab" href="#address" role="tab" aria-controls="address"
                                            aria-selected="false">
                                            << Anterior</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <button type="submit" class="btn btn-lg btn-success m-2">Salvar</button>
                            </div>
                        </div>


                    </div>
            </div>

        </div>
        </form>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('input').keypress(function(e) {
            var code = null;
            code = (e.keyCode ? e.keyCode : e.which);
            return (code == 13) ? false : true;
        });

        $('.btn-prev').click(function() {
            $('.nav-item > .active').parent().prev('li').find('a').trigger('click');
        });
        $('.btn-next').click(function() {
            $('.nav-item > .active').parent().next('li').find('a').trigger('click');
        });
    });
</script>
@endsection
