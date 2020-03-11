@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Item</span>
                    <a href="/items" class="btn btn-primary btn-sm">Volver a lista de items...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form method="POST" onsubmit="disable()" id="form-prevent-multiple-submits" action="/items">
                    @csrf
                    <input
                      type="text"
                      name="nombre"
                      placeholder="Nombre"
                      class="form-control mb-2"
                      value="{{old('nombre')}}"
                    />
                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripcion"
                      class="form-control mb-2"
                      value="{{old('descripcion')}}"
                    />
                    <select class="form-control mb-2" name="categoria">
                      @if (count($categorias) === 0){
                        <option value="wdd">No hay categorias.</option>
                      }
                          
                      @endif
                    @foreach ($categorias as $categoria)
                      <option value="{{$categoria->icat_nombre}}">{{$categoria->icat_nombre}}</option>
                    @endforeach
                    </select>
                    <button class="btn btn-primary btn-block" id="button-prevent-multiple-submits" type="submit">
                      <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                      <span id="btex">Publicar</span></button>
                    </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection