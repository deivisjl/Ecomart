@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4>Editar categoría</h4>
                        </div>
                    </div>
                    <form action="{{ url('categorias', [$categoria->id]) }}" method="POST">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ $categoria->nombre }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
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