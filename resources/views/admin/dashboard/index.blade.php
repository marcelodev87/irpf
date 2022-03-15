@extends('admin.master.master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <h1 class="text-primary">Clientes</h1>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">CPF</th>
                        <th class="text-center">Telefone</th>
                        <th class="text-center">Celular</th>
                        <th class="text-center">Informações</th>
                        <th class="text-center">Declarações</th>
                        <th class="text-center">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->document }}</td>
                            <td class="text-center">{{ $user->telephone }}</td>
                            <td class="text-center">{{ $user->cell }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info shadow btn-xs btnInfoModal"
                                    data-user_id="{{ $user->id }}"
                                    data-route="{{ route('admin.modal.user.show', $user->id) }}">
                                    <i class="fa fa-desktop"></i> Info
                                </button>
                            </td>
                            <td class="text-center"><a href="{{ route('admin.admin.declarations.show', ['id' => $user->id]) }}"
                                class="btn btn-dark">Declarações</a></td>
                            <td class="text-center"><a href="{{ route('admin.admin.user.edit', ['id' => $user->id]) }}"
                                    class="btn btn-primary">Editar</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row mt-5">
            <h1 class="text-primary">Últimas Declarações Cadastradas</h1>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Ano</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Data de Criação</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($declarations as $declaration)
                        <tr>
                            <td class="text-center">{{ $declaration->id }}</td>
                            <td class="text-center">{{ $declaration->year }}</td>
                            <td class="text-center">{{-- <a
                                    href="{{ route('admin.modal.user.show', ['id' => $declaration->user_id]) }}"> --}}
                                    {{ $declaration->user->name }}</a></td>
                            <td class="text-center">{{ $declaration->created_at }}</td>
                            <td class="text-center"><a href="{{ route('admin.admin.declarations.index', ['declaration' => $declaration->id, 'id' => $user->id]) }}"" class="btn btn-dark">Ver Declaração</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!------------------------------------------------------ MODAL SHOW ---------------------------------------------->

        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dados do Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-header">
                                <h4 id="name" class="card-title"></h4>
                            </div>
                            <div class="card-body">
                                <h3>Dados Pessoais</h3>
                                <p><strong>Nome:</strong> <span id="namex"> </span></p>
                                <p><strong>CPF:</strong> <span id="documentx"> </span></p>
                                <p><strong>Título de Eleitor:</strong> <span id="document_voterx"> </span></p>
                                <p><strong>Data de Nascimento:</strong> <span id="date_of_birthx"> </span></p>
                                <p><strong>Profissão:</strong> <span id="occupationx"> </span></p>
                                <hr>
                                <h3>Contatos</h3>
                                <p><strong>Telefone:</strong> <span id="telephonex"> </span></p>
                                <p><strong>Celular:</strong> <span id="cellx"> </span></p>
                                <p><strong>Email:</strong> <span id="emailx"> </span></p>
                                <hr>
                                <h3>Endereço</h3>
                                <p><strong>Endereço:</strong> <span id="streetx"> </span>,
                                    <span id="numberx"> </span>
                                </p>
                                <p><strong>Complemento: </strong><span id="complementx"> </span></p>
                                <p><strong>Bairro:</strong> <span id="neighborhoodx"> </span></p>
                                <p><strong>Cidade:</strong> <span id="cityx"> </span></p>
                                <p><strong>UF:</strong> <span id="statex"> </span></p>
                                <p><strong>CEP:</strong> <span id="zipcodex"> </span></p>
                                <hr>
                                <h3>Dados Bancários</h3>
                                <p><strong>Banco:</strong> <span id="bankx"> </span></p>
                                <p><strong>Agência:</strong> <span id="agencyx"> </span></p>
                                <p><strong>Conta:</strong> <span id="accountx"> </span></p>
                                <p><strong>Tipo de Conta:</strong> <span id="typex"> </span></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <!---------------  MODAL SHOW ---------------------------------->
    @endsection
    @section('js')
        <script>
            $(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $('.btnInfoModal').click(function() {

                let route = $(this).attr('data-route');
                let user_id = $(this).attr('data-user-id');

                $.ajax({
                    url: route,
                    method: 'POST',
                    data: {
                        _method: 'POST',
                        user: user_id
                    },
                    dataType: 'json',
                    success: function(response) {

                        if (response) {

                            $('#infoModal #namex').html(response.user.name);
                            $('#infoModal #documentx').html(response.user.document);
                            $('#infoModal #document_voterx').html(response.user.document_voter);
                            $('#infoModal #date_of_birthx').html(response.user.date_of_birth);
                            $('#infoModal #occupationx').html(response.user.occupation);

                            //===================== CONTACTS ==========================
                            $('#infoModal #telephonex').html(response.user.telephone);
                            $('#infoModal #cellx').html(response.user.cell);
                            $('#infoModal #emailx').html(response.user.email);

                            //===================== ADDRESS ==========================
                            $('#infoModal #streetx').html(response.user.street);
                            $('#infoModal #numberx').html(response.user.number);
                            $('#infoModal #complementx').html(response.user.complement);
                            $('#infoModal #neighborhoodx').html(response.user.neighborhood);
                            $('#infoModal #cityx').html(response.user.city);
                            $('#infoModal #statex').html(response.user.state);
                            $('#infoModal #zipcodex').html(response.user.zipcode);

                            //===================== BANK ==========================
                            $('#infoModal #bankx').html(response.bank.name);
                            $('#infoModal #agencyx').html(response.bank.agency);
                            $('#infoModal #accountx').html(response.bank.account);
                            $('#infoModal #typex').html(response.bank.type);


                            $('#infoModal').modal('show');
                        }

                    }
                });
            });
        </script>
    @endsection
