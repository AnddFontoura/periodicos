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
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/site.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container-fluid">
    <header>
        <div class="row">
            <div class="col-12 background-blue" style="height: 200px;">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 offset-2">
                        <h1 class="mt-3"> BIBLIOTECA DE ARTIGOS CIENTÍFICOS </h1>
                        <p> Seja bem vindo ao acervo de artigos da <b> Fontoura Editora </b> </p>
                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <img class="img mt-3" src="{{ asset('img/cpef_logo.png') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="navbar navbar-expand-lg navbar-light bg-light navbar-text justify-content-center">
                <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0 ">
                    @if(isset($pageForMenu) && count($pageForMenu) > 0)
                        @foreach($pageForMenu as $menu)
                            <li class="nav-item  text-center">
                                <a class="nav-link " href="{{ url('/page/' . $menu->id) }}"> {{ $menu->name }} </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </header>

    <main class="row m-3">
        <div class="offset-2 col-md-6 col-sm-8 col-lg-6">
            @yield('content')
        </div>

        <div class="col-sm-12 col-lg-4 col-md-4">
            <h3> Publicações </h3>

            <ul class="list-group">
                @if(isset($categoryForMenu) && count($categoryForMenu) > 0)
                    @foreach($categoryForMenu as $categoryMenu)
                        <a href="{{ url('category/' . $categoryMenu->id) }}"> <li class="list-group-item"> {{ $categoryMenu->name }}</li> </a>
                    @endforeach
                @endif
            </ul>
        </div>
    </main>

    <div class="row">
        <div class="col-12 background-blue">
            <div class="row">
                <div class="offset-2 col-md-4 col-lg-4 col-sm-12">   
                    <img class="img w-100 m-3" src="{{ asset('img/fd_logo_branco.png') }}">
                </div>
            </div>
        </div>
    </div>
</div>


@yield('js')

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: "bootstrap"
        });
    });
</script>
</body>
</html>
