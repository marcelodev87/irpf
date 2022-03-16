<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <title>Login</title>
</head>

<body>
    <div class="container w-50">
        <div class="content mt-2 p-5">
            @if (session()->exists('message'))
                <div class="alert alert-{{ session()->get('color') }}" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                </div>
            @endif
            <form class="form-signin" name="login" method="POST" action="{{ route('admin.admin.login.do') }}">
                @csrf

                <div class="text-center">
                <img class="mb-4" src="https://etikasolucoes.com.br/wp-content/uploads/2022/03/logo_grupo_etika.png"
                    alt="" width="300">
                </div>

                <h1 class="h3 mb-3 font-weight-normal text-center">Insira seus dados</h1>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="document">Senha: </label>
                    <input type="password" name="password" class="form-control" placeholder="Informe sua senha" />
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
