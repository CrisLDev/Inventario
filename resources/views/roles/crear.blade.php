@extends('layouts.app')

@section('content')
    <div class="container">
        @if ( session('mensaje') )
        <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Nuevo Rol
                    </div>
                    <div class="card-body">
                        <form id="form-prevent-multiple-submits" method="POST" action="{{route('roles.guardar')}}">
                            <input name="invisible" type="hidden" id="idE">
                            <div class="form-group">
                                <label for="nombreE">Nombre del Rol</label>
                                <input
                                type="text"
                                name="name"
                                id="nombreE"
                                placeholder="Nombre del Rol"
                                class="form-control mb-2"
                                />
                            </div>
                            <div class="form-group">
                                <label for="Url">Url Amigable</label>
                                <input
                                type="text"
                                name="slug"
                                id="Url"
                                placeholder="Url Amigable"
                                class="form-control mb-2"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcionE">Descripción del Rol</label>
                                <input
                                type="text"
                                name="description"
                                id="descripcionE"
                                placeholder="Descripcion"
                                class="form-control mb-2"
                                />
                            </div>
                            <hr>
                            <h5>Permiso Especial</h5>
                            <div class="form-group">
                                <input type="radio" name="special" id="specialE">
                                <label class="form-check-label" for="exampleRadios1">
                                    Acceso Total
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="no-access" id="specialE">
                                <label class="form-check-label" for="exampleRadios1">
                                    Sin acceso
                                </label>
                            </div>
                            <hr>
                            <div class="form-group">
                                @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" name="permisos" type="checkbox" value="{{$permission->id}}" id="defaultCheck1">
                                    <label class="form-check-label">
                                        {{$permission->description}}
                                    </label>
                                </div>
                            @endforeach
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="crear-prevent-multiple-submits" type="submit">
                                    <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                    <span id="btex">Publicar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection