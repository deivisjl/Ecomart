<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarse</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
      <p class="login-box-msg text-center">Registrarse</p>

      <form action="{{ route('registro.store') }}" method="POST">
      {{ csrf_field() }}
        <div class="input-group mb-3">
            <input type="text" name="nombres" class="form-control {{ $errors->has('nombres') ? ' is-invalid' : '' }}" placeholder="Nombres" value="{{ old('nombres') }}">
            <div class="input-group-append">
                <span class="fa fa-user input-group-text"></span>
            </div>
          @if ($errors->has('nombres'))
              <div class="invalid-feedback">{{ $errors->first('nombres') }}</div>
          @endif
        </div>
        <div class="input-group mb-3">
            <input type="text" name="apellidos" class="form-control {{ $errors->has('apellidos') ? ' is-invalid' : '' }}" placeholder="Apellidos" value="{{ old('apellidos') }}">
            <div class="input-group-append">
                <span class="fa fa-user input-group-text"></span>
            </div>
          @if ($errors->has('apellidos'))
              <div class="invalid-feedback">{{ $errors->first('apellidos') }}</div>
          @endif
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo electrónico" value="{{ old('email') }}">
          <div class="input-group-append">
              <span class="fa fa-envelope input-group-text"></span>
          </div>
          @if ($errors->has('email'))
              <div class="invalid-feedback">{{ $errors->first('email') }}</div>
          @endif
        </div>
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
          <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Repetir contraseña">
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="text" name="direccion" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" placeholder="Dirección" value="{{ old('direccion') }}">
          <div class="input-group-append">
              <span class="fa fa-address-book-o input-group-text"></span>
          </div>
          @if ($errors->has('direccion'))
              <div class="invalid-feedback">{{ $errors->first('direccion') }}</div>
          @endif
        </div>
        <div class="input-group mb-3">
        <input type="text" name="telefono" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="Teléfono" value="{{ old('telefono') }}">
          <div class="input-group-append">
              <span class="fa fa-phone input-group-text"></span>
          </div>
          @if ($errors->has('telefono'))
              <div class="invalid-feedback">{{ $errors->first('telefono') }}</div>
          @endif
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="/login">¿Ya tienes una cuenta?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>
</html>

