@extends('layouts.app')

@section('content')
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
            <a data-target="#editarModal" data-dismiss="modal" class="btn btn-warning text-white" id="editar" data-toggle="modal">Editar</a>
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
      <div class="alert alert-danger collapse hidden" id="danger-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Items</span>
                    <a class="btn btn-warning text-white btn-sm" href="{{ route('items.export_exl') }}"><i class="fas fa-file-excel"></i> Excel</a>
                    <a class="btn btn-success btn-sm" href="{{ route('items.export_pdf') }}"><i class="fas fa-file-pdf"></i> PDF</a>
                    <a href="{{route('items.create')}}" class="btn btn-primary btn-sm text-white">Nuevo Item</a>
                </div>

                <div class="card-body">
                    <table class="table" id="tablaI">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha Creación</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($items as $item)
                                <tr class="item{{$item->id}}tr">
                                    <th scope="row"><div id="nid">{{$item->id}}</div></th>
                                    <td><label for="" class="item{{$item->id}}">{{$item->nombre}}</label></td>
                                    <td><label for="" class="item{{$item->id}}d">{{$item->descripcion}}</label></td>
                                <td><a data-toggle="modal" data-target="#verModal" data-id="{{$item->id}}" class="btn btn-primary text-white btn-sm verMas">Ver Más</a>
                                <a href="{{route('items.edit', $item->id)}}" data-id="{{$item->id}}" class="btn btn-warning text-white btn-sm verMas">Editar</a>
                                <form action="{{route('items.destroy', $item->id)}}" method="POST" class="d-inline">
                                  @method('DELETE')
                                  @csrf
                                  <button class="btn btn-danger btn-sm" type="submit">
                                      Eliminar
                                  </button>
                              </form>
                              </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
    $(".verMas").click(function(){
        $('.cls').empty();
        $('.cls').removeClass().addClass('cls');
        $('.modalE').show();
        cnic = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            data: {'cnic':cnic},
            dataType: 'json',
            url: "items/ver",
            success: function(data){
                $("#nombre").append(data.nombre);
                $("#descripcion").append(data.descripcion);
                $("#curso").append(data.curso);
                $('.cls').addClass('cls'+data.id);
            }
        });
    });
});
    </script>
@endsection