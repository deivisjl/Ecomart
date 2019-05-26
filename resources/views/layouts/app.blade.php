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
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

    
  </head>
  <body>

  <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar sticky-top">
        <div class="container">
                <div class="mr-auto">
                        <img src="{{ asset('/img/logo-blanco.png') }}">
                    </div>
                    <div class="mr-auto">
                        <form class="form-inline my-2 my-lg-0" method="POST" action="/buscar">
                            {{ csrf_field() }}
                            <input name="nombre" class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </div>
                    <div class="mr-auto">
                        <a href="/carrito/mostrar" style="color:#fff" data-toggle="tooltip" data-placement="bottom" title="Ver carrito"><i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i></a>
                    </div>
        </div>
  </header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-custom navbar-static-top  ">
        <a class="navbar-brand" href="/"><i class="fa fa-home"></i> Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/acerca-de"><i class="fa fa-address-card"></i> Acerca de <span class="sr-only">(current)</span></a>
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
                    <a class="dropdown-item" href="/registro">Registrarse</a>
                @elseif(Auth::user()->esAdministrador())
                    <a class="dropdown-item" href="/home">Administrar</a>
                @endif
                @if(!Auth::guest())
                    <a class="dropdown-item" href="/logout">Cerrar sesión</a>
                @endif
                </div>
            </li>
        </ul>
    </div>
    </nav>
    <div class="divider-separator"></div>
    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <!--  -->
        @yield('js')
        @include('flash-toastr::message')
  </body>
</html>

<!-- <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    
                    <ul class="nav navbar-nav navbar-right">
                        
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        
    </div>

    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html> -->

