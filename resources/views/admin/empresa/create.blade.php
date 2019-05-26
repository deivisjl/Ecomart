@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4>Nueva descripción de empresa</h4>
                        </div>
                    </div>
                    <form action="/mi-empresa-guardar" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nombre de empresa</label>
                        <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Quiénes somos</label>
                        <textarea name="quien" class="form-control {{ $errors->has('quien') ? ' is-invalid' : '' }}">{{ old('quien') }}</textarea>
                        @if ($errors->has('quien'))
                            <div class="invalid-feedback">{{ $errors->first('quien') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Visión</label>
                        <textarea name="vision" class="form-control {{ $errors->has('vision') ? ' is-invalid' : '' }}">{{ old('vision') }}</textarea>
                        @if ($errors->has('vision'))
                            <div class="invalid-feedback">{{ $errors->first('vision') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Misión</label>
                        <textarea name="mision" class="form-control {{ $errors->has('mision') ? ' is-invalid' : '' }}">{{ old('mision') }}</textarea>
                        @if ($errors->has('mision'))
                            <div class="invalid-feedback">{{ $errors->first('mision') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Valores</label>
                        <textarea name="valores" id="valores" class="form-control {{ $errors->has('valores') ? ' is-invalid' : '' }}">{{ old('valores') }}</textarea>
                        @if ($errors->has('valores'))
                            <div class="invalid-feedback">{{ $errors->first('valores') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{ old('telefono') }}">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">{{ $errors->first('telefono') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <textarea name="direccion" name="direccion" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}">{{ old('direccion') }}</textarea>
                        @if ($errors->has('direccion'))
                            <div class="invalid-feedback">{{ $errors->first('direccion') }}</div>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
	  $(function () {
	    CKEDITOR.replace('valores')
	    $('.textarea').wysihtml5()
	  })	  
</script>
@endsection