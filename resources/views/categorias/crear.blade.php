@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Categoria</span>
                    <a href="/categorias" class="btn btn-primary btn-sm">Volver a lista de categorias...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
        <div class="alert alert-success">{{ session('mensaje') }}</div>
        @endif
        @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
        @endif
                  <form method="POST" onsubmit="disable()" id="form-prevent-multiple-submits" action="/categorias">
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
                    <button class="btn btn-primary btn-block" id="button-prevent-multiple-submits" type="submit">
                      <span class="spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>    
                      <span id="btex">Agregar</span>
                    </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection