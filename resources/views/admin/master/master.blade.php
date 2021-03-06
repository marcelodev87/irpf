<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }


        .content {
            min-height: 100%;
            position: relative;
            width: 100%;
        }

        .footer {
            bottom: 0;
            text-align: center;
            width: 100%;
            margin: 50px 0 0 0;
            padding: 5px 0;
        }

    </style>

    @hasSection('css')
        @yield('css')
    @endif


    <title>DECLARAÇÃO DE IMPOSTO DE RENDA</title>
</head>

<body>


    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">ÉTIKA SOLUÇÕES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('admin.admin.dashboard')}}">Página Inicial <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.admin.user.create')}}">Adicionar Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.admin.logout')}}">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

    </div>
    <div class="footer mx-auto bg-dark text-white text-center">
        <p>ÉTIKA SOLUÇÕES</p>
    </div>



    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('input').keypress(function(e) {
                var code = null;
                code = (e.keyCode ? e.keyCode : e.which);
                return (code == 13) ? false : true;
            });
        });
    </script>


    @hasSection('js')
        @yield('js')
    @endif

</body>

</html>
