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
            @if(sizeof($productos) > 0)
                @foreach($productos as $index => $producto)
                    @if($index%4 == 0)
                        <div class="row">
                    @endif
                    <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card" style="width: 100%; margin-bottom:5px; margin-bottom:5px">
                        <img src="{{ $producto->img_url }}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title card-title-custom">{{ $producto->nombre }}</h5>
                            <h5 class="card-text card-text-custom">Q. {{ $producto->precio }}</h5>
                            <a href="/detalle-producto/{{ $producto->id }}" class="btn btn-primary btn-block">Ver detalle</a>
                        </div>
                        </div>
                    </div>
                    @if(($index+1)%4 == 0)   
                        </div>  
                    @endif  
                @endforeach
            @else
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">No se encontraron resultados, intenta nuevamente</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection