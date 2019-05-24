@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">
                    <h5><b>Filtrar por categoría</b></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                    @foreach($categorias as $categoria)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="/categoria/{{ $categoria->slug }}">{{ $categoria->nombre }}</a>
                            <span class="badge badge-primary badge-pill">{{ $categoria->total }}</span>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-12"><h2>{{ $producto->nombre }}</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $producto->img_url}}" class="img-fluid" style="display:block; margin:auto">
                        </div>
                        <div class="col-md-8">
                            <span>{!!$producto->descripcion!!}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <a href="/carrito/agregar/{{ $producto->slug }}" class="btn btn-outline-primary btn-block btn-lg">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="card" style="width: 100%; margin-bottom:5px; margin-bottom:5px">
                <div class="card-body text-center">
                    <h5 class="card-title card-title-custom">{{ $producto->nombre }}</h5>
                    <h5 class="card-text card-text-custom">Q. {{ $producto->precio }}</h5>
                    <a href="/detalle-producto/{{ $producto->id }}" class="btn btn-primary btn-block">Ver detalle</a>
                </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection