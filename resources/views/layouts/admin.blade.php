<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
</head>
<body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow justify-content-end">
            <ul class="nav">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Subcategoria</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('subcategory') }}">Listar</a></li>
                        <li><a class="dropdown-item" href="{{ url('subcategory/create') }}">Nova Subcategoria</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('subcategory/deleted') }}">Deletados</a></li>
                    </ul>
                </li>
                @endauth
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('login') }}" data-bs-toggle="dropdown" role="button" aria-expanded="false">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"> {{ Auth::user()->name }} </a>
                        <ul class="dropdown-menu">
                            <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
