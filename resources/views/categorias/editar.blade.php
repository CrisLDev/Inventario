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
                <form method="POST" action="{{route('categorias.update',$categoria->id)}}">
                    @method('PUT')
                    @csrf
                    <input
                      type="text"
                      name="nombre"
                      placeholder="Nombre"
                      class="form-control mb-2"
                      value="{{$categoria->icat_nombre}}"
                    />
                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripcion"
                      class="form-control mb-2"
                      value="{{$categoria->icat_descripcion}}"
                    />
                    <button class="btn btn-warning btn-block" type="submit">Editar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection