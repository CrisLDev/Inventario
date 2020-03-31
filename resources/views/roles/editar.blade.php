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
                        <form onsubmit="disable()" method="POST" action="{{route('roles.update', $role->id)}}">
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
                                >{{$role->description}}</textarea>
                            </div>
                            @can('isadmin')
                            <h5>Permiso Especial</h5>
                            <div class="form-group">
                                <ul class="list-unstyled  d-flex justify-content-between" id="radiob">
                                <label>
                                <input type="radio" name="special" id="special" value="all-access"   @if($role->special == 'all-access') checked=checked @endif>
                                    Acceso Total
                                </label>
                                <label>
                                <input type="radio" name="special" id="special" value="no-access"  @if($role->special == 'no-access') checked=checked @endif>
                                    Sin acceso
                                </label>
                                <label><a class="btn btn-success btn-sm text-white uncheckb">Desmarcar</a></label>
                                </ul>
                            </div>
                            <hr>
                            @endcan
                            <div class="form-group">
                                <ul class="list-unstyled">
                                @foreach ($permissions as $permission)
                                    <label>
                                        <input name="permissions[]" type="checkbox" value="{{$permission->id}}"  @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                        <em>{{$permission->description}}</em>
                                    </label><br>
                            @endforeach
                        </ul>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-warning btn-block" id="button-prevent-multiple-submits" type="submit">
                                    <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                    <span id="btex">Editar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#radiob').on('click', '.uncheckb', function(){
            $('input[type="radio"]').prop('checked', false); 
        });
    });
</script>
@endsection