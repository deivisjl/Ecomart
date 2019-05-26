@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4>Editar descripción de empresa</h4>
                        </div>
                    </div>
                    <form action="{{ url('mi-empresa', [$info->id]) }}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nombre de empresa</label>
                        <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $info->empresa }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Quiénes somos</label>
                        <textarea name="quien" class="form-control {{ $errors->has('quien') ? ' is-invalid' : '' }}">{{ $info->quienes_somos }}</textarea>
                        @if ($errors->has('quien'))
                            <div class="invalid-feedback">{{ $errors->first('quien') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Visión</label>
                        <textarea name="vision" class="form-control {{ $errors->has('vision') ? ' is-invalid' : '' }}">{{ $info->vision }}</textarea>
                        @if ($errors->has('vision'))
                            <div class="invalid-feedback">{{ $errors->first('vision') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Misión</label>
                        <textarea name="mision" class="form-control {{ $errors->has('mision') ? ' is-invalid' : '' }}">{{ $info->mision }}</textarea>
                        @if ($errors->has('mision'))
                            <div class="invalid-feedback">{{ $errors->first('mision') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Valores</label>
                        <textarea name="valores" id="valores" class="form-control {{ $errors->has('valores') ? ' is-invalid' : '' }}">{!! $info->valores !!}</textarea>
                        @if ($errors->has('valores'))
                            <div class="invalid-feedback">{{ $errors->first('valores') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{ $info->telefono }}">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">{{ $errors->first('telefono') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $info->correo }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <textarea name="direccion" name="direccion" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}">{{ $info->direccion }}</textarea>
                        @if ($errors->has('direccion'))
                            <div class="invalid-feedback">{{ $errors->first('direccion') }}</div>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-success">Editar</button>
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