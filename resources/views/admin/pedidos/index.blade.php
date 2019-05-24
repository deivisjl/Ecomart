@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4>Solicitud de pedidos</h4>
                        </div>
                        <div class="col-6">
                            <a href="/pedido-descargar" class="btn btn-primary float-right" target="_blank">Descargar pedidos</a>
                        </div>
                    </div>
                        <table id="listar" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width:15%; text-align: center">No.</th>
                                    <th>Usuario</th>                                        
                                    <th>Monto total</th>                                        
                                    <th>Fecha de creación</th>                                        
                                    <th>Detalle</th>                                                                            
                                </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
     $(function(){
            listar();
        });

   var  listar = function(){
    var table = $("#listar").DataTable({
      "processing": true,
            "serverSide": true,
            "destroy":true,
            "ajax":{
            'url': '/pedidos/show',
            'type': 'GET'
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          "columns":[
              {'data': 'id'},
              {'data': 'nombre'},
              {'data': 'total', "render":function ( data, type, row, meta ) {
                                return '<span>Q.'+" "+data+'</span>';
                               }, "orderable":false
              }, 
              {'data': 'fecha'},
              {'defaultContent':'<button type="button" class="detalle btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Detalle registro"><i class="fa fa-external-link"></i></button>', "orderable":false}
          ],
          "language": idioma_spanish,

          "order": [[ 0, "asc" ]]

    });
    obtener_data_editar("#listar tbody",table);
  }

  var obtener_data_editar = function(tbody,table){
      $(tbody).on("click","button.detalle",function(){
        var data = table.row($(this).parents("tr")).data();
        
        var id = data.id;
        
        window.location.href = "/pedido-detalle/" + id;

      });

      $(tbody).on("click","button.procesar",function(){
        var data = table.row($(this).parents("tr")).data();
        
        var id = data.id;
        
        // actualizar_registro(id);

      });
    }
</script>
@endsection