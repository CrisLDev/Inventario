@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Nuevo Curso</h3>
                    </div>
                    <div class="card-body">
                        <form onsubmit="disable()" method="POST" action="{{route('cursos.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Curso</label>
                                <input
                                type="number"
                                name="curso"
                                id="curso"
                                placeholder="Curso"
                                class="form-control mb-2"
                                value="{{old('curso')}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="nombre">Paralelo</label>
                                <input
                                type="text"
                                name="paralelo"
                                id="paralelo"
                                placeholder="Paralelo"
                                class="form-control mb-2"
                                value="{{old('paralelo')}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input
                                type="text"
                                name="descripcion"
                                id="descripcion"
                                placeholder="descripcion"
                                class="form-control mb-2"
                                value="{{old('descripcion')}}"
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