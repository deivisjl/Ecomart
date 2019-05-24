@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4>Editar producto</h4>
                        </div>
                    </div>
                    <form  action="{{ url('productos', [$producto->id]) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $producto->nombre }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="text" name="precio" class="form-control {{ $errors->has('precio') ? ' is-invalid' : '' }}" value="{{ $producto->precio }}">
                        @if ($errors->has('precio'))
                            <div class="invalid-feedback">{{ $errors->first('precio') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <select name="categoria" class="form-control {{ $errors->has('categoria') ? ' is-invalid' : '' }}">
                             <option value="0">-- Seleccione una opción --</option>
                             @foreach($categorias as $item)
                             <option value="{{ $item->id }}"
                             @if($item->id == $producto->categoria_id)
                                selected = 'selected'
                             @endif
                             >{{ $item->nombre }}</option>
                             @endforeach
                        </select>
                        @if ($errors->has('categoria'))
                            <div class="invalid-feedback">{{ $errors->first('categoria') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}">{{ $producto->descripcion }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">{{ $errors->first('descripcion') }}</div>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('imagen') ? ' is-invalid' : '' }}">
                        <label class="control-label">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                        @if ($errors->has('imagen'))
                            <div class="invalid-feedback">{{ $errors->first('imagen') }}</div>
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
	    CKEDITOR.replace('descripcion')
	    $('.textarea').wysihtml5()
	  })	  
</script>
@endsection