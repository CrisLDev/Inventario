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
              <label class="font-weight-bold">Curso:</label>
            <label id="curso" class="cls"></label>
          </div>
          <div>
            <label class="font-weight-bold">Descripcion:</label>
              <label id="descripcion" class="cls"></label>
          </div>
          <div>
            <label class="font-weight-bold">Fecha de creación:</label>
              <label id="creacion" class="cls"></label>
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
    <div class="row justify-content-center">
      <div class="col-md-8 mb-3">
        <div class="card">
          <div class="card-body pb-0">
            <form action="" method="get">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" placeholder="Curso o Paralelo" name="curso" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" placeholder="Paralelo o Curso" name="paralelo" class="form-control">
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
                  <h3 class="mb-0">Lista de Cursos</h3>
                    @can('cursos.crear')
                    <a id="crear" href="{{route('cursos.create')}}" class="btn btn-primary btn-sm text-white">Nuevo Curso</a>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive-xl">
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
                                    <td class="text-truncate" style="max-width:15px;"><label>{{$curso->descripcion}}</label></td>
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
<script src="{{ asset('js/inventario1.js') }}"></script>
@endsection