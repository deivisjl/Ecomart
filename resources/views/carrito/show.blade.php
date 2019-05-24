@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4>Carrito de compras</h4>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                        @if(count($carrito) > 0)
                        <div class="row text-center">
                            <div class="col-12">
                                <a href="/carrito/vaciar" class="btn btn-danger"><i class="fa fa-cart-arrow-down"></i> Vaciar carrito</a>
                            </div>
                        </div>
                        <hr/>
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>    
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carrito as $item)
                                        <tr>
                                            <td><img src="{{ $item->img_url}}" alt="" style="width: 50px; display:block; margin:auto"></td>
                                            <td>{{ $item->nombre }}</td>
                                            <td>Q. {{ $item->precio }}</td>
                                            <td><input type="number" id="producto_{{ $item->id }}" value="{{ $item->cantidad }}" min="1" max="100"><a href="#" class="btn btn-primary btn-sm btn-update" data-id="{{ $item->id }}" data-href="/carrito/actualizar/{{ $item->slug }}" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="bottom" title="Actualizar cantidad"><i class="fa fa-undo"></i></a></td>
                                            <td>Q. {{ number_format($item->precio * $item->cantidad, 2) }}</td>
                                            <td>
                                                <a href="/carrito/quitar/{{ $item->slug }}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar de carrito">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h3><span class="badge badge-success">Total: Q. {{ number_format($total,2) }}</span></h3>
                            <hr />
                            <div class="row text-center">
                                <div class="col-12">
                                    <a href="/" class="btn btn-info"><i class="fa fa-chevron-left"></i> Seguir comprando</a>
                                    <a href="/detalle-pedido" class="btn btn-info"><i class="fa fa-money"></i> Confirmar compra</a>
                                </div>
                            </div>
                        @else
                            <h4>No hay productos, agrega <a href="/">uno</a>!</h4>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(".btn-update").on('click', function(e){
				e.preventDefault();
				var id = $(this).data('id');
				var href = $(this).data('href');
				var cantidad = $('#producto_' + id).val();
				window.location.href = href + "/" + cantidad;
			});
</script>
@endsection