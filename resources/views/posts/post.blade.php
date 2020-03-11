@extends('layouts.app')

@section('content')
<div class="container">
    @if ( session('mensaje') )
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>{{$post->ps_nombre}}</span>
                            <a href="/posts/crear" class="btn btn-primary btn-sm">Nuevo Post</a>
                        </div>
        
                        <div class="card-body">
                            <img src="{{$post->ps_path}}" class="d-block w-100" style="height: 50vh !important;" alt="...">
                            <p>{{$post->ps_descripcion}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Comentarios</span>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#comentariosModal">Agregar Comentario</button>
                            <!-- Modal -->
                            <div class="modal fade" id="comentariosModal" tabindex="-1" role="dialog" aria-labelledby="comentariosModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="comentariosModalLabel">Agregar un nuevo comentario.</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" onsubmit="disable()" id="form-prevent-multiple-submits" action="{{route('comentarios.crear', $post->id)}}">
                                            @csrf
                                            <textarea
                                            name="descripcion"
                                            placeholder="Escribe algo."
                                            class="form-control mb-2"
                                            value="{{old('descripcion')}}"
                                            ></textarea>
                                            <button class="btn btn-primary btn-block" id="button-prevent-multiple-submits" type="submit">
                                                <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                                <span id="btex">Publicar</span></button>
                                          </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="card-body pb-0">
                            <p>
                            <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Mostrar Comentarios
                              </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body pb-0">
                                  @foreach ($comentarios as $comentario)
                                      <div class="card card-body mb-3 pb-0">
                                          <div class="d-flex justify-content-between">
                                            <label>{{$comentario->name}}</label>
                                            <label>{{$comentario->rango}}</label>
                                          </div>
                                          <p>{{$comentario->pcom_texto}}</p>
                                      </div>
                                  @endforeach
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection