@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                            </ol>
                        </nav>
                        <input type="hidden" value="{{ $id }}" id="pedido">
                        <table id="listar" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width:15%; text-align: center">No.</th>
                                    <th>Producto</th>                                        
                                    <th>Precio</th>                                        
                                    <th>Cantidad</th>                                        
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
     $(function(){
        var id = $('#pedido').val();
        var param = new Array();
        var obj = {'id':id};
        param.push(obj);
        listar(param);        
    });

   var  listar = function(param){
    var table = $("#listar").DataTable({
      "processing": true,
            "serverSide": true,
            "destroy":true,
            "ajax":{
            'url': '/pedido-obtener/show',
            'type': 'GET',
            'data': {
                   'buscar': param
            }
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          "columns":[
              {'data': 'id'},
              {'data': 'producto'},
              {'data': 'precio', "render":function ( data, type, row, meta ) {
                                return '<span>Q.'+" "+data+'</span>';
                               }
              },
              {'data': 'cantidad'},
              {'data': 'precio', "render":function ( data, type, row, meta ) {
                                var subtotal = (data * row['cantidad'])
                                return '<span>Q.'+" "+subtotal.toFixed(2)+'</span>';
                               }, "orderable":false
              }
          ],
          "language": idioma_spanish,

          "order": [[ 0, "asc" ]]

    });    
  }
</script>
@endsection