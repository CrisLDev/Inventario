@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Nuevo Item</h3>
                    </div>
                    <div class="card-body">
                        <form onsubmit="disable()" method="POST" action="{{route('items.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre Item</label>
                                <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                placeholder="Nombre del Item"
                                class="form-control mb-2"
                                value="{{old('nombre')}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="curso">Curso del Item</label>
                                <select class="form-control mb-2" name="curso" id="curso">
                                    @if (count($cursos) === 0){
                                      <option value="wdd">No hay cursos.</option>
                                    }
                                        
                                    @endif
                                  @foreach ($cursos as $curso)
                                    <option value="{{$curso->id}}">{{$curso->curso}} {{$curso->paralelo}}</option>
                                  @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción del Item</label>
                                <textarea
                                type="text"
                                name="descripcion"
                                id="descripcion"
                                placeholder="Descripcion"
                                class="form-control mb-2"
                                >{{old('descripcion')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="codigo">Codigo del Item</label><br>
                                <input
                                type="text"
                                name="codigo"
                                id="codigo"
                                placeholder="Ingresa un código sin espacios."
                                class="form-control mb-2"
                                value="{{old('codigo')}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Cantidad de items</label>
                                <input
                                type="number"
                                name="cantidad"
                                id="cantidad"
                                placeholder="Cantidad del Item"
                                class="form-control mb-2"
                                value="{{old('cantidad')}}"
                                />
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="button-prevent-multiple-submits" type="submit">
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