@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            @foreach ($perfiles as $perfil)
            <div class="col-md-12 mb-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-xl-2 col-md-3 col-sm-4 mbc-3">
                            <div class="text-center">
                                <img class="img-thumbnail imgperfil" src="{{$perfil->imgurl}}" alt="imagen">
                            </div>
                        </div>
                    <div class="col-xl-8 col-md-8 col-sm-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <label class="font-weight-bold">Nombres:</label> <label> {{ $perfil->nombres }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label class="font-weight-bold">Apellidos:</label> <label> {{ $perfil->apellidos }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label class="font-weight-bold">Edad:</label> <label> {{ $perfil->edad }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label class="font-weight-bold">Dirección:</label> <label> {{ $perfil->direccion }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <label class="font-weight-bold">N#_Teléfono:</label> <label> {{ $perfil->ntelefono }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection