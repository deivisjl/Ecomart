<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Ecomart</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-center">Cambiar mi contraseña</p>

      <form action="/cambiar-credencial" method="POST">
      {{ csrf_field() }}
        <input type="hidden" name="usuario" value="{{ $usuario->id }}">

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña">
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
          @if ($errors->has('password'))
              <div class="invalid-feedback">{{ $errors->first('password') }}</div>
          @endif
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir contraseña">
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
          @if ($errors->has('password'))
              <div class="invalid-feedback">{{ $errors->first('password') }}</div>
          @endif
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Guardar</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="/recuperar-credencial">¿Olvidó su contraseña?</a>
      </p>
      <p class="mb-0">
        <a href="/register" class="text-center">Registrarse</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script src="{{ asset('js/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
@include('flash-toastr::message')
</body>
</html>

