@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4>Categorías</h4>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary float-right">Nuevo</a>
                        </div>
                    </div>
                    <table id="listar" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                            <th style="width:15%; text-align: center">No.</th>
                            <th>Nombre</th>                                        
                            <th></th>
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
            'url': '/categorias/show',
            'type': 'GET'
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          "columns":[
              {'data': 'id'},
              {'data': 'nombre'},
              {'defaultContent':'<button type="button" class="editar btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil"></i></button>&nbsp<button type="button" class="eliminar btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Borrar registro"><i class="fa fa-trash"></i></button>', "orderable":false}
          ],
          "language": idioma_spanish,

          "order": [[ 0, "asc" ]]

    });
    obtener_data_editar("#listar tbody",table);
  }

  var obtener_data_editar = function(tbody,table){
      $(tbody).on("click","button.editar",function(){
        var data = table.row($(this).parents("tr")).data();
        
        var id = data.id;
        
        window.location.href = "/categorias/" + id + "/edit";

      });

      $(tbody).on("click","button.borrar",function(){
        var data = table.row($(this).parents("tr")).data();
        
        var id = data.id;
        
        //borrar_registro(id);

      });
    }
</script>
@endsection