@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">Dashboard</div>
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
                                    <div class="card-header">Items Activos</div>
                                    <div class="card-body">
                                      <h2 class="card-title mb-0 mt-0">{{$items_inactivos}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acciones</div>

                <div class="card-body">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary btn-block" href="items" role="button">Todo</a>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-secondary btn-block" href="items/crear" role="button">Nuevo</a>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-dark btn-block" href="#" role="button">Link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection