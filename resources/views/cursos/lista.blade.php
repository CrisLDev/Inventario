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
              <label for="" class="font-weight-bold">Curso:</label>
            <label for="" id="curso" class="cls"></label>
          </div>
          <div>
            <label for="" class="font-weight-bold">Descripcion:</label>
              <label for="" id="descripcion" class="cls"></label>
          </div>
        </div>
        <div class="modal-footer d-block">
          <div class="d-flex justify-content-between botones">
            @can('cursos.editar')
              <a href="" class="btn btn-warning text-white" id="editar">Editar</a>
            @endcan
            @can('cursos.eliminar')
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
                    @can('cursos.crear')
                    <a id="crear" href="{{route('cursos.create')}}" class="btn btn-primary btn-sm text-white">Nuevo Item</a>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-hover-cursor">
                        <thead>
                            <tr>
                                <th scope="col" class="text-truncate">#</th>
                                <th scope="col" class="text-truncate">Curso y Paralelo</th>
                                <th scope="col" class="text-truncate">Descripción</th>
                                <th scope="col" class="text-truncate">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($cursos as $curso)
                                <tr>
                                    <th scope="row">{{$curso->id}}</th>
                                <td><label>{{$curso->curso}} {{$curso->paralelo}}</label></td>
                                    <td class="text-truncate"><label>{{$curso->descripcion}}</label></td>
                                <td class="text-truncate text-center"><a data-toggle="modal" data-target="#verModal" data-id="{{$curso->id}}" class="btn btn-primary text-white btn-sm verMas">Ver Más</a>
                              </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$cursos->links()}}
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
            type: "GET",
            data: {'cnic':cnic},
            dataType: 'json',
            url: "cursos/ver",
            success: function(data){
                $("#curso").append(data.curso+" "+data.paralelo);
                $("#descripcion").append(data.descripcion);
                $('.cls').addClass('cls'+data.id);
                $('#editar').attr('href',window.location.href+"/"+data.id+'/edit');
                $('.d-inline').attr('action', window.location.href + "/" +data.id);
            }
        });
    });
    });
    </script>
@endsection