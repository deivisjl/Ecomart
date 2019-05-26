@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4>Mi empresa</h4>
                        </div>
                        <div class="col-6">
                            <a href="/mi-empresa-nuevo" class="btn btn-primary float-right">Nuevo</a>
                        </div>
                    </div>
                    <table id="listar" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                            <th style="width:5%; text-align: center">No.</th>
                            <th style="width:15%;">Nombre</th>                                        
                            <th style="width:20%; text-align: justify; overflow:hidden">Visión</th>
                            <th style="width:20%; text-align: justify; overflow:hidden">Misión</th>
                            <th style="width:20%; text-align: justify; overflow:hidden">Dirección</th>
                            <th style="width:10%;">Estado</th>
                            <th style="width:10%;"></th>
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
            'url': '/mi-empresa/show',
            'type': 'GET'
          },
          "dom":"<'row'<'col-sm-12'tr>><'row'<'col-sm-4'l><'col-sm-3'f><'col-sm-5'p>>",
          "columns":[
              {'data': 'id'},
              {'data': 'empresa',"orderable":false},
              {'data': 'vision',"orderable":false}, 
              {'data': 'mision',"orderable":false},
              {'data': 'direccion',"orderable":false},
              {'data': 'activo', "render":function ( data, type, row, meta ) {
                                if(data == 1){
                                    return '<a href="#" class="activar btn btn-success">Activo</a>';
                                }else{
                                    return '<a href="#" class="activar btn btn-danger">Inactivo</a>';
                                }
                                
                               }, "orderable":false
              }, 
              {'defaultContent':'<button type="button" class="editar btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Editar registro"><i class="fa fa-pencil"></i></button>', "orderable":false}
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
        
        window.location.href = "/mi-empresa/" + id + "/edit";

      });

      $(tbody).on("click","a.activar",function(){
        var data = table.row($(this).parents("tr")).data();
        
        var id = data.id;
        
        editar_estado(id);

      });
    }

    var editar_estado= function(id)
    {
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          
          $.ajax({
           url: '/mi-empresa-activar/'+id,
           type: 'GET',
           dataType: 'json',             
           success: function(res){
            //   loading.classList.remove('block-loading');
               $('#listar').DataTable().ajax.reload();
               toastr.success(res.data);
           },
           error: function(e){
            //   loading.classList.remove('block-loading');
                  switch(e.status)
                  {
                    case 422:
                      toastr.error(e.responseJSON.error,'');
                    break;
                    default:
                      toastr.error('Error: ' + e.statusText,'');
                    break;
                  }
               $('#listar').DataTable().ajax.reload();
           }
        });
    }
</script>
@endsection