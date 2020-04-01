@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Editar Item</h3>
                    </div>
                    <div class="card-body">
                        <form onsubmit="disable()" method="POST" action="{{route('items.update', $items->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Nombre Item</label>
                                <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                placeholder="Nombre del Rol"
                                class="form-control mb-2"
                                value="{{$items->nombre}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="curso">Curso del Item</label>
                                <select class="form-control mb-2" name="curso" id="curso">
                                    @if (count($cursos) === 0){
                                      <option value="wdd">No hay categorias.</option>
                                    }
                                        
                                    @endif
                                  @foreach ($cursos as $curso)
                                    <option value="{{$curso->id}}" {{ $items->cu_id == $curso->id ? 'selected' : '' }}>{{$curso->curso}} {{$curso->paralelo}}</option>
                                  @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción del Item</label>
                                <textarea
                                type="text"
                                name="descripcion"
                                id="descripcion"
                                placeholder="descripcion"
                                class="form-control mb-2"
                                >{{$items->descripcion}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="codigo">Codigo del Item</label>
                                <input
                                type="text"
                                name="codigo"
                                id="codigo"
                                placeholder="Ingresa un código."
                                class="form-control mb-2"
                                value="{{$items->codigo}}"
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
                                value="{{$items->cantidad}}"
                                />
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