@extends('app.master.master')

@section('content')
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


    <div class="row mb-2 mt-5">
        <div class="col-6">
            <h1 class="text-primary">Minhas Declarações</h1>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-success btn-lg btn-block mb-2" data-toggle="modal" data-target="#decModal">+
                Nova
                Declaração</button>
        </div>
        <table class="table m-5">
            <thead>
                <tr>
                    <th class="text-center">Ano da Declaração</th>
                    <th class="text-center">Data da última Alteração</th>
                    <th class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($declarations as $declaration)
                    <tr>
                        <td class="text-center"><strong>{{ $declaration->year }}</strong></td>
                        <td class="text-center">{{ $declaration->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('declaration.year', ['document' => session('document'), 'declaration' => $declaration->id]) }}"
                                    class="btn btn-primary shadow btn-xs mr-1">
                                    Editar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!------------------------------------------------------ DADOS PESSOAIS ---------------------------------------------->

    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Meus dados</h1>
    </div>

    <div class="row mb-2 mt-5">
        <div class="col-12">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Dados Pessoais</h3>
                    <h4 class="d-inline-block mb-2 text-{{ $color }}">{{ $status }}</h4>

                    <form action="{{ route('user.update', ['document' => session('document')])}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        @foreach ($array as $key => $a)
                            <div class="col-sm-12 col-lg-6">
                                <label for="{{ $a['name'] }}">{{ $a['label'] }}:</label>
                                <input type="text" class="form-control" name="{{ $a['name'] }}" value="{{ old($a['name']) }}"
                                    onkeypress="{{ htmlspecialchars_decode($a['format']) }}">
                            </div>
                        @endforeach
                        @if($button == "1")
                            <button type="submit" class="btn btn-lg btn-success m-2">Salvar meus Dados Pessoais</button>
                            <div class="m-2 text-dark">Última alteração: {{ $user->updated_at }} </div>
                            @else
                            <div class="m-2 text-dark">Última alteração: {{ $user->updated_at }} </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div
                class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="d-inline-block mb-2 text-primary">Dados Bancários</h3>
                    <h4 class="d-inline-block mb-2 text-{{ $color_bank }}">{{ $status_bank }}
                    </h4>
                    <form action="{{ route('user.bank.update', ['document' => session('document'), 'bank' => $bank->id ])}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $bank->id }}">
                        @foreach ($array_bank as $key => $a)
                            <div class="col-sm-12 col-lg-6">
                                <label for="{{ $a['name'] }}">{{ $a['label'] }}:</label>
                                <input type="text" class="form-control" name="{{ $a['name'] }}">
                            </div>
                        @endforeach
                        @if($button_bank == "1")
                            <button type="submit" class="btn btn-lg btn-success m-2">Salvar meus Dados Bancários</button>
                            <div class="m-2 text-dark">Última alteração: {{ $bank->updated_at }} </div>
                            @else
                            <div class="m-2 text-dark">Última alteração: {{ $bank->updated_at }} </div>
                        @endif
                    </form>
                </div>
            </div>
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
                    <form action="{{ route('declaration.year.store') }}" method="POST" enctype="multipart/form-data">
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
                                                <label class="form-check-label" for="description">Sou funcionário de uma empresa</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]"
                                                    value="Sou funcionário de uma empresa">
                                                <label class="form-check-label" for="description">Sou funcionário público</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]" value="Sou sócio de uma empresa">
                                                <label class="form-check-label" for="description">Sou sócio de uma empresa</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]" value="Sou MEI">
                                                <label class="form-check-label" for="description">Sou MEI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]" value="Sou autônomo e não possuo CNPJ">
                                                <label class="form-check-label" for="description">Sou autônomo e não possuo CNPJ</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]" value="Sou presidente ou administrador de uma Igreja, Associação, etc">
                                                <label class="form-check-label" for="description">Sou presidente ou administrador de uma Igreja, Associação, etc</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="description[]" value="Sou aposentado ou pensionista">
                                                <label class="form-check-label" for="description">Sou aposentado ou pensionista</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <p class="text-bold text-danger"><strong>Na próxima página, você deverá enviar os comprovantes de acordo com as opções escolhidas.</strong></p>
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
