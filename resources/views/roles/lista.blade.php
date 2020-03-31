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
              <label class="font-weight-bold">Nombre:</label>
            <label id="nombre" class="cls"></label>
          </div>
          <div>
            <label class="font-weight-bold">Acrónimo:</label>
              <label id="acronimo" class="cls"></label>
          </div>
          <div>
            <label class="font-weight-bold">Descripción:</label>
              <label id="descripcion" class="cls"></label>
          </div>
        </div>
        <div class="modal-footer d-block">
          <div class="d-flex justify-content-between">
            @can('roles.editar')
              <a href="" class="btn btn-warning text-white" id="editar">Editar</a>
            @endcan
            @can('roles.eliminar')
            <form action="" method="POST" class="d-inline">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger" type="submit">
                  Eliminar
              </button>
          </form>
            @endcan
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 mb-3">
        <div class="card">
          <div class="card-body pb-0">
            <form action="" method="get">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" placeholder="Nombre" name="nombre" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" placeholder="Url Amigable" name="urla" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" placeholder="Descripción" name="descripcion" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-default btn-block">Buscar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Roles</span>
                    @can('roles.crear')
                    <a href="{{route('roles.create')}}" class="btn btn-primary btn-sm text-white">Nuevo rol</a>
                    @endcan
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-hover-cursor">
                        <thead>
                            <tr>
                                <th scope="col" class="text-truncate">#</th>
                                <th scope="col" class="text-truncate">Nombre</th>
                                <th scope="col" class="text-truncate">Acrónimo</th>
                                <th scope="col" class="text-truncate">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($roles as $rol)
                                <tr >
                                    <th class="text-truncate" scope="row">{{$rol->id}}</th>
                                    <td class="text-truncate"><label>{{$rol->name}}</label></td>
                                    <td class="text-truncate"><label>{{$rol->slug}}</label></td>
                                <td class="text-truncate text-center"><a data-toggle="modal" data-target="#verModal" data-id="{{$rol->id}}" class="btn btn-primary text-white btn-sm verMas">Ver Más</a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
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
    $(".verMas").click(function(){
        $('.cls').empty();
        $('.cls').removeClass().addClass('cls');
        $('.modalE').show();
        cnic = $(this).attr('data-id');
        $.ajax({
            type: "post",
            data: {'_token': $('input[name=_token]').val(),'cnic':cnic},
            url: "/roles/ver",
            success: function(data){
                $("#nombre").append(data.name);
                $("#descripcion").append(data.description);
                $("#acronimo").append(data.slug);
                $('.cls').addClass('cls'+data.id);
                $('#editar').attr('href',window.location.href+"/"+data.id+'/edit');
                $('.d-inline').attr('action', window.location.href + "/" +data.id);
            }
        });
    });
});
    </script>
@endsection