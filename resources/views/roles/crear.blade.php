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
                                <label>Nombre del Rol</label>
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
                            @can('isadmin')
                            <h5>Permiso Especial</h5>
                            <div class="form-group">
                                <ul class="list-unstyled  d-flex justify-content-between" id="radiob">
                                    <label>
                                    <input type="radio" name="special" value="all-access">
                                        Acceso Total
                                    </label>
                                    <label>
                                    <input type="radio" name="special" value="no-access">
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
                                            <input name="permissions[]" type="checkbox" value="{{$permission->id}}">
                                            <em>{{$permission->description}}</em>
                                        </label><br>
                                @endforeach
                            </ul>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="crear-prevent-multiple-submits" type="submit">
                                    <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                                    <span id="btex">Guardar</span></button>
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