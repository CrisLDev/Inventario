@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Nota</span>
                    <a href="/posts" class="btn btn-primary btn-sm">Volver a lista de posts...</a>
                </div>
                <div class="card-body">     
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  @if ( session('error') )
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form method="POST" action="/posts" enctype="multipart/form-data">
                    @csrf
                    <input
                      type="text"
                      name="nombre"
                      placeholder="Nombre"
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripcion"
                      class="form-control mb-2"
                    />
                    <input
                      type="file"
                      name="avatar"
                      placeholder="Tu imagen"
                      class="form-control mb-2"
                    />
                    <button class="btn btn-primary btn-block" type="submit">Publicar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection