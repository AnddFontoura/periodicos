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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />
</head>
<body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow justify-content-end">
            <ul class="nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Categoria</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('admin/category') }}">Listar</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/category/form') }}">Nova Subcategoria</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('admin/category/deleted') }}">Deletados</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Subcategoria</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('admin/subcategory') }}">Listar</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/subcategory/form') }}">Nova Subcategoria</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('admin/subcategory/deleted') }}">Deletados</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Artigo</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('admin/article') }}">Listar</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/article/form') }}">Novo Artigo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('admin/article/deleted') }}">Deletados</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Página</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('admin/page') }}">Listar</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/page/form') }}">Nova Página</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('admin/page/deleted') }}">Deletados</a></li>
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
