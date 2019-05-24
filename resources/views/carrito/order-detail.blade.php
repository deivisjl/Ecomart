@extends('layouts.app')

@section('content')
<div class="row text-center">
    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-body">
                <h3>Detalle del pedido</h3>
                <hr/>
                <h4>Datos del usuario</h4>
                <table class="table table-striped table-hover table-bordered">
					<tr><td>Nombre: </td><td>{{ Auth::user()->nombres . ' ' . Auth::user()->apellidos }}</td></tr>
					<tr><td>Correo: </td><td>{{ Auth::user()->email }}</td></tr>
					<tr><td>Dirección: </td><td>{{ Auth::user()->direccion }}</td></tr>
				</table>
                <h4>Datos del pedido</h4>
                <table class="table table-striped table-hover table-bordered">
					<tr>
						<th class="text-center">Producto</th>
						<th class="text-center">Precio</th>
						<th class="text-center">Cantidad</th>
						<th class="text-center">Subtotal</th>
					</tr>
					@foreach ($carrito as $item)
						<tr>
							<td>{{ $item->nombre }}</td>
							<td>{{ number_format($item->precio, 2) }}</td>
							<td>{{ $item->cantidad }}</td>
							<td>{{ number_format($item->precio * $item->cantidad, 2) }}</td>
						</tr>
					@endforeach
				</table><hr/>                
				<h3>
					<span class="badge badge-success">
						Total: Q. {{ number_format($total , 2)}}
					</span>
				</h3>
                <div class="row text-center">
                    <div class="col-12">
                        <a href="/carrito/mostrar" class="btn btn-info"><i class="fa fa-chevron-left"></i> Regresar</a>
                        <a href="/confirmar" class="btn btn-info"><i class="fa fa-money"></i> Confirmar</a>
                    </div>
                </div>
                <!-- <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
@endsection