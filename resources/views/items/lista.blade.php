@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarModalLabel">Items</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                        <div class="card modalE">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Items Accion</span>
                            </div>
                            <div class="card-body">  
                                <div id="Modal">
                                    <form id="form-prevent-multiple-submits" action="#">
                                        <input name="invisible" type="hidden" id="idE">
                                        <input
                                          type="text"
                                          name="nombre"
                                          id="nombreE"
                                          placeholder="Nombre"
                                          class="form-control mb-2"
                                        />
                                        <input
                                          type="text"
                                          name="descripcion"
                                          id="descripcionE"
                                          placeholder="Descripcion"
                                          class="form-control mb-2"
                                        />
                                        <select class="form-control mb-2" name="categoria" id="categoriaE">
                                            @if (count($categorias) === 0){
                                              <option value="wdd">No hay categorias.</option>
                                            }
                                                
                                            @endif
                                          @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->icat_nombre}}">{{$categoria->icat_nombre}}</option>
                                          @endforeach
                                          </select>
                                          <div class="crearModal">
                                            <button class="btn btn-primary btn-block" id="crear-prevent-multiple-submits" type="submit">
                                                <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                                <span id="btex">Publicar</span></button>
                                              </button>
                                        </div>
                                        <div class="editarModal">
                                            <button class="btn btn-warning btn-block" id="editar-prevent-multiple-submits" type="submit">
                                                <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                                <span id="btex">Editar</span>
                                              </button>
                                        </div>
                                      </form>
                                </div>
                            </div>
                        </div>
                        <div id="eliminarModal">
                          <div class="container text-center">
                            <div class="row">
                              <div class="col-md-12">
                                <i class="fas fa-exclamation-triangle"></i>
                              </div>
                              <div class="col-md-12">
                                ¿Esta seguro que quiere eliminar este Item?
                              </div>
                            </div>
                          </div>
                        </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-12">
            <button type="button" data-dismiss="modal" id="eliminar-prevent-multiple-submits" class="btn btn-danger btn-block">Eliminar</button>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerE">Close</button>
          <button type="button" class="btn btn-primary" data-target="#verModal" data-dismiss="modal" data-toggle="modal" id="verE">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="verModal" tabindex="-1" role="dialog" aria-labelledby="verModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="verModalLabel">Informacion Completa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
              <label for="" class="font-weight-bold">Nombre:</label>
            <label for="" id="nombre" class="cls"></label>
          </div>
          <div>
            <label for="" class="font-weight-bold">Descripcion:</label>
              <label for="" id="descripcion" class="cls"></label>
          </div>
          <div>
            <label for="" class="font-weight-bold">Curso:</label>
              <label for="" id="categoria" class="cls"></label>
          </div>
        </div>
        <div class="modal-footer d-block">
          <div class="d-flex justify-content-between">
            <a id="editar" data-target="#editarModal" data-dismiss="modal" class="btn btn-warning text-white" onclick="actualizarDatos()" data-toggle="modal">Editar</a>
            <a data-target="#editarModal" data-dismiss="modal" class="btn btn-danger text-white" id="eliminar" data-toggle="modal">Eliminar</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container">
    <div class="alert alert-success collapse" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Success! </strong> Product have added to your wishlist.
      </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Items</span>
                    <a onclick="guardarDatos()" id="crear" data-target="#editarModal" data-dismiss="modal" data-toggle="modal" class="btn btn-primary btn-sm text-white">Nuevo Item</a>
                </div>

                <div class="card-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha Creación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
      $('#datatable').DataTable();
    /*  
    $('#success-alert').addClass('show').hide();

    $('#crear').click(function(){
      $('#eliminarModal').hide();
      $('#eliminar-prevent-multiple-submits').hide();
      $('#cerE').show();
      $('#verE').hide();
      $('.modalE').show();
        $('.crearModal').show();
        $('.editarModal').hide();
        $('#form-prevent-multiple-submits').trigger("reset");
      });

      $('#editar').click(function(){
      $('.modalE').show();
      $('#eliminar-prevent-multiple-submits').hide();
        $('.editarModal').show();
        $('#eliminarModal').hide();
        $('.crearModal').hide();
        $('#verE').show();
      });

      $('#eliminar').click(function(){
      $('.modalE').hide();
      $('#eliminarModal').show();
      $('#verE').hide();
      $('#cerE').hide();
      $('#eliminar-prevent-multiple-submits').show();
    });

    /*
    $(".verMas").click(function(){
        $('.cls').empty();
        $('.cls').removeClass().addClass('cls');
        $("#idE").val();
        $('.modalE').show();
        cnic = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            data: {'cnic':cnic},
            dataType: 'json',
            url: "getgi",
            success: function(data){
                $("#nombre").append(data.it_nombre);
                $("#idE").val(data.id);
                $("#nombreE").val(data.it_nombre);
                $("#descripcion").append(data.it_descripcion);
                $("#descripcionE").val(data.it_descripcion);
                $("#categoria").append(data.it_categoria);
                $("#categoriaE").val(data.it_categoria);
                $('.cls').addClass('cls'+data.id);
            }
        });
    });
  
        $('#form-prevent-multiple-submits').submit(function(e){
        e.preventDefault();
        var Ename = $('#nombreE').val();
        var Edescripcion = $('#descripcionE').val();
        var id = $('#idE').val();
        $.ajax({
           type: "POST",
           url:  "hola",
           data: {'_token': $('input[name=_token]').val(),'id':id,'name': $('#nombreE').val(), 'descripcion': $('#descripcionE').val(),
            'categoria': $('#categoriaE').val()},
           beforeSend: function(){
            $('#editar-prevent-multiple-submits').attr("disabled", true);
           },
           success: function(data){
            $('.cls').empty();
            $('#editar-prevent-multiple-submits').attr("disabled", false); 
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
            });
            $("#nombre").append(data.it_nombre);
            $("#descripcion").append(data.it_descripcion);
            $('.item' + data.id).text(data.it_nombre);
            $('.item' + data.id+ 'd').text(data.it_descripcion);
            $("#categoria").append(data.it_categoria);
            $("#categoriaE").val(data.it_categoria);
        }
        });
    });
        
      
      $("#crear-prevent-multiple-submits").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'hola2',
            data: {'_token': $('input[name=_token]').val(),    
            'it_nombre': $('#nombreE').val(), 
            'descripcion': $('#descripcionE').val(),
            'categoria': $('#categoriaE').val()
        },
        beforeSend: function(){
            $('#crear-prevent-multiple-submits').attr("disabled", true);
           },
            success: function(data) {
                $('.cls').empty();
                $('#crear-prevent-multiple-submits').attr("disabled", false);
                $('#success-alert').text('Se ha agregado correctamente.');
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
                });
                $('#tablaI').append("<tr class='item"+data.id+"tr'><th scope='row'><div id='nid'>" + data.id + "</div></th><td><label class='item"+data.id+"'>" + data.it_nombre + "</label></td><td><label for='' class='item"+data.id+"d'>" + data.it_descripcion + "</label></td><td><a data-toggle='modal' data-target='#verModal' data-id='"+ data.id +"' class='btn btn-primary text-white btn-sm verMas'>Ver Más</a></tr>");
                $("#nombre").append(data.it_nombre);
                $('#idE').val(data.id);
                $("#descripcion").append(data.it_descripcion);
                $('.item' + data.id).text(data.it_nombre);
                $('.item' + data.id+ 'd').text(data.it_descripcion);
                $("#categoria").append(data.it_categoria);
                $("#categoriaE").val(data.it_categoria);
                $('#verE').show();
                }
        });
    });

      $('#eliminar-prevent-multiple-submits').on('click',function(){
        var id = $('#idE').val();
        $.ajax({
          type:'POST',
          url:'eliminar',
          data:{
            '_token': $('input[name=_token]').val(),
            'id': id
          },success: function(data){
            $('.item' + data.id + 'tr').remove();
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });
            
          }
        });
      });
*/






$.ajaxSetup({
  headers:{
    'X-CSRF-TOKEN': $('meta[name="csfr-token"]').attr('content')
  }
});

function verDatos(){
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "/ver",
    success: function(response){
      var rows = "";
      $.each(response, function(key, value){
        rows = rows + "<tr>";
        rows = rows + "<td>"+value.id+"</id>"
        rows = rows + "<td>"+value.it_nombre +"</id>"
        rows = rows + "<td>"+value.it_descripcion+"</id>"
        rows = rows + "<td>";
        rows = rows + "<a onClick='editarDatos("+value.id+","+value.it_nombre+","+value.it_descripcion+","+value.categoria+")' data-toggle='modal' data-target='#verModal' class='btn btn-warning text-white btn-sm'>Ver Más</a>"
        rows = rows + "<a onClick='eliminarDatos("+value.id+")' data-toggle='modal' data-target='#verModal' class='btn btn-danger text-white btn-sm'>Eliminar</a>"
        rows = rows + "</td></tr>";
      });
      $('tbody').html(rows);
    }
  })
}

verDatos();

function guardarDatos(){
  var nombre = $('#nombreE').val('');
  var descripcion = $('#descripcionE').val('');
  var categoria = $('#categoriaE').val('');;
  $.ajax({
    type:"POST",
    dataType: "json",
    url: "/ver"
    data: {nombre: nombre, descripcion:descripcion, categoria:categoria},
    success: function(response){
      viewData();
      clearData();
      $('#guardar').show();
    }
  })
}

function limpiarDatos(){
  $('#idE').val('');
  $('#nombreE').val('');
  $('#descripcionE').val('');
  $('#categoriaE').val('');
}

function editarDatos(idE, nombreE, descripcionE, categoriaE){
  
}

function actualizarDatos(){
  
}

function eliminarDatos(id){
  
}












});
    </script>
@endsection
