@extends('layouts.app')

@section('content')
<div class="container">
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
                                        <form method="POST" action="/posts" enctype="multipart/form-data">
                                            @csrf
                                            <textarea
                                            name="descripcion"
                                            placeholder="Escribe algo."
                                            class="form-control mb-2"
                                            ></textarea>
                                            <button class="btn btn-primary btn-block" type="submit">Publicar</button>
                                          </form>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Publicar</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="card-body">
                            <p>
                            <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Mostrar Comentarios
                              </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
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