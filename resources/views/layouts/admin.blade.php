<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

    
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-custom fixed-top">
        <a class="navbar-brand" href="/"><i class="fa fa-home"></i> Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administración
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('categorias.index') }}">Categorías</a>
                <a class="dropdown-item" href="{{ route('productos.index') }}">Productos</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Ofertar</a>
                </div>
            </li> -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('categorias.index') }}">Categorías</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('pedidos.index') }}">Pedidos</a>
            </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/mi-empresa"><i class="fa fa-address-card"></i> Mi empresa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown active ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> 
                @if (!Auth::guest()) 
                    {{ Auth::user()->email }}
                @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if (Auth::guest())
                    <a class="dropdown-item" href="/login">Iniciar sesión</a>
                    <a class="dropdown-item" href="/register">Registrarse</a>
                @else
                    <a class="dropdown-item" href="/logout">Cerrar sesión</a>
                @endif
                </div>
            </li>
        </ul>
    </div>
    </nav>
    <div class="divider-separator-admin"></div>
    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <!--  -->
        @yield('js')
        @include('flash-toastr::message')
  </body>
</html>