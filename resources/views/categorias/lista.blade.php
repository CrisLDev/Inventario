@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Categorias</span>
                    <a href="/categorias/crear" class="btn btn-primary btn-sm">Nueva Categoria</a>
                </div>

                <div class="card-body">      
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                            <tr>
                                <th scope="row">{{ $categoria->id }}</th>
                                <td>{{ $categoria->icat_nombre }}</td>
                                <td>{{ $categoria->icat_descripcion }}</td>
                            <td><a href="{{ route('categorias.edit', $categoria->id)}}" class="btn btn-warning btn-sm">Editar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection