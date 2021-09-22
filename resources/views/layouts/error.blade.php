<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/0cc6f43f73.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 text-center">
                <div class="card">
                    <div class="card-header">
                        <h1> Oops! </h1>
                    </div>

                    <div class="'card-body">
                        <p class="card-title"> 404 Página não encontrada </p>
                        <p class="card-text"> Essa página não foi encontrada no sistema. </p>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ url('/login') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Leve-me a primeira página </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
