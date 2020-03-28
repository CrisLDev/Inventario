@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Editar Rol
                    </div>
                    <div class="card-body">
                        <form id="form-prevent-multiple-submits" method="POST" action="{{route('roles.update', $role->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Nombre del Rol</label>
                                <input
                                type="text"
                                name="name"
                                id="nombre"
                                placeholder="Nombre del Rol"
                                class="form-control mb-2"
                                value="{{$role->name}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="codigo">Nombre del Acrónimo</label>
                                <input
                                type="text"
                                name="slug"
                                id="codigo"
                                placeholder="Ingresa un código."
                                class="form-control mb-2"
                                value="{{$role->slug}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción del Rol</label>
                                <textarea
                                type="text"
                                name="description"
                                id="descripcion"
                                placeholder="Descripcion"
                                class="form-control mb-2"
                                >{{$role->descripcion}}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="special" id="specialE" {{ $role->special == 'all-access' ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleRadios1">
                                    Acceso Total
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="no-access" id="specialE" {{ $role->special == 'no-access' ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleRadios1">
                                    Sin acceso
                                </label>
                            </div>
                            <hr>
                            <div class="form-group">
                                <ul class="list-unstyled">
                                @foreach ($permissions as $permission)
                                {{$role}}
                                    <label>
                                        <input name="permissions[]" type="checkbox" value="{{$permission->id}}"  @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                        <em>{{$permission->description}}</em>
                                    </label><br>
                            @endforeach
                        </ul>
                            </div>
                            <hr>
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