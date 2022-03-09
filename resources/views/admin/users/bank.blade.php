@extends('app.master.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Dados Bancários</li>
        </ol>
    </nav>
    <div class="row mb-2 mt-1 p-1">
        <h1 class="text-primary">Dados Bancários</h1>
    </div>

    <div class="row mb-2 mt-5">
        <div class="col-md-12">
            <form>

                <div class="row m-2">
                    <div class="col-lg-3">
                        <label for="name">Banco:</label>
                        <input type="text" class="form-control" name="bank" value="{{ old('bank') ?? $bank->name }}">
                    </div>
                    <div class="col-lg-3">
                        <label for="agency">Agência:</label>
                        <input type="text" class="form-control" name="agency" value="{{ old('agency') ?? $bank->agency }}">
                    </div>
                    <div class="col-lg-3">
                        <label for="account">Conta:</label>
                        <input type="text" class="form-control" name="account" value="{{ old('account') ?? $bank->account }}">
                    </div>
                    <div class="col-lg-3">
                        <label for="type">Tipo Conta:</label>
                        <input type="text" class="form-control" name="type" value="{{ old('type') ?? $bank->type }}">
                    </div>
                </div>

            </form>
        </div>


    </div>
@endsection
