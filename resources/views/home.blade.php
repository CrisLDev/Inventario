@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">Items</div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white text-center bg-primary mb-3">
                                    <div class="card-header">Items Totales</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$items}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center bg-secondary mb-3">
                                    <div class="card-header">Items Activos</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$items_activos}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white text-center bg-dark mb-3">
                                    <div class="card-header">Items Eliminados</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$items_inactivos}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">Cursos</div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white text-center bg-primary mb-3">
                                    <div class="card-header">Cursos Totales</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$cursos}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center bg-secondary mb-3">
                                    <div class="card-header">Cursos Activos</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$cursos_activos}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white text-center bg-dark mb-3">
                                    <div class="card-header">Cursos Eliminados</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$cursos_inactivos}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white text-center bg-primary mb-3">
                                    <div class="card-header">Users Totales</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$users}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center bg-secondary mb-3">
                                    <div class="card-header">Users Activos</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$users_activos}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white text-center bg-dark mb-3">
                                    <div class="card-header">Users Eliminados</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$users_inactivos}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection