@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Nuevo Rol
                    </div>
                    <div class="card-body">
                        <form id="form-prevent-multiple-submits" method="POST" action="{{route('roles.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="nombreE">Nombre del Rol</label>
                                <input
                                type="text"
                                name="name"
                                id="nombre"
                                placeholder="Nombre del Rol"
                                class="form-control mb-2"
                                value="{{old('name')}}"
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
                                value="{{old('slug')}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcionE">Descripción del Rol</label>
                                <input
                                type="text"
                                name="description"
                                id="descripcion"
                                placeholder="Descripcion"
                                class="form-control mb-2"
                                value="{{old('description')}}"
                                />
                            </div>
                            <hr>
                            <h5>Permiso Especial</h5>
                            <div class="form-group">
                                <input type="radio" name="special" value="all-access">
                                <label class="form-check-label" for="exampleRadios1">
                                    Acceso Total
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="special" value="no-access">
                                <label class="form-check-label" for="exampleRadios1">
                                    Sin acceso
                                </label>
                            </div>
                            <hr>
                            <div class="form-group">
                                <ul class="list-unstyled">
                                    @foreach ($permissions as $permission)
                                        <label>
                                            <input name="permissions[]" type="checkbox" value="{{$permission->id}}">
                                            <em>{{$permission->description}}</em>
                                        </label><br>
                                @endforeach
                            </ul>
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