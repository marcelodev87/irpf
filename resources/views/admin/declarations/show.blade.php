@extends('admin.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cliente - {{ $user->name }} - {{ $user->document }}
            </li>
        </ol>
    </nav>
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
        <div class="col-6">
            <h1 class="text-primary">Declarações</h1>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-success btn-lg btn-block mb-2" data-toggle="modal" data-target="#decModal">+
                Nova
                Declaração</button>
        </div>
    </div>


    <div class="row mb-2 mt-5">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Ano</th>
                        <th class="text-center">Data de Criação</th>
                        <th class="text-center">Informações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($declarations as $declaration)
                        <tr>
                            <td class="text-center">{{ $declaration->id }}</td>
                            <td class="text-center">{{ $declaration->year }}</td>
                            <td class="text-center">{{ $declaration->created_at }}</td>
                            <td class="text-center"><a
                                    href="{{ route('admin.admin.declarations.index', ['declaration' => $declaration->id, 'id' => $user->id]) }}"
                                    class="btn btn-info">Ver Informações</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!--------------------------------------------------- MODAL NOVA DECLARAÇÃO ---------------------------------------------------------->
    <div class="modal fade" id="decModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Declaração</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('admin.admin.declarations.store', ['id' => $user->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Digite o ano da declaração:</label>
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input name="year" maxlength="4" type="text" class="form-control"
                                                value="{{ old('year') ?? date('Y') }}" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <h2>Marque as opções de acordo com a sua realidade:</h2>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Cursei Ensino Escolar ou Superior">
                                                <label class="form-check-label" for="description">Cursei Ensino Escolar ou
                                                    Superior</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Comprei/vendi imóvel ou veículo">
                                                <label class="form-check-label" for="description">Comprei/vendi imóvel ou
                                                    veículo</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Possuo financiamentos">
                                                <label class="form-check-label" for="description">Possuo
                                                    financiamentos</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Paguei pensão alimentícia">
                                                <label class="form-check-label" for="description">Paguei pensão
                                                    alimentícia</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]" value="Realizei investimentos na
                                                                Bolsa de Valores ou em Criptomoedas">
                                                <label class="form-check-label" for="description">Realizei investimentos na
                                                    Bolsa de Valores ou em Criptomoedas</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou funcionário de uma empresa">
                                                <label class="form-check-label" for="description">Sou funcionário de uma
                                                    empresa</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou funcionário de uma empresa">
                                                <label class="form-check-label" for="description">Sou funcionário
                                                    público</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou sócio de uma empresa">
                                                <label class="form-check-label" for="description">Sou sócio de uma
                                                    empresa</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou MEI">
                                                <label class="form-check-label" for="description">Sou MEI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou autônomo e não possuo CNPJ">
                                                <label class="form-check-label" for="description">Sou autônomo e não possuo
                                                    CNPJ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou presidente ou administrador de uma Igreja, Associação, etc">
                                                <label class="form-check-label" for="description">Sou presidente ou
                                                    administrador de uma Igreja, Associação, etc</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou aposentado ou pensionista">
                                                <label class="form-check-label" for="description">Sou aposentado ou
                                                    pensionista</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <p class="text-bold text-danger"><strong>Na próxima página, você deverá
                                                        enviar os comprovantes de acordo com as opções escolhidas.</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Cadastrar Declaração</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#decModal').modal('show');
        @endif
    </script>
@endsection
